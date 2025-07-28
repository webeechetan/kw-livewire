<?php
namespace App\Imports;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;

class PostsImport implements ToModel, WithHeadingRow, WithEvents
{
    public $contentPlanId;
    public $projectId;

    protected $expectedHeaders = [
        'date', 'platform', 'format', 'content_bucket',
        'content_idea', 'creative_copy', 'visual_direction',
        'caption', 'status'
    ];

    public $report = [
        'success' => 0,
        'failed' => 0,
        'failures' => [],
        'header_error' => null,
    ];

    public function __construct($contentPlanId, $projectId)
    {
        $this->contentPlanId = $contentPlanId;
        $this->projectId = $projectId;
    }

    public static function headingRow(): int
    {
        return 1;
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                $sheet = $event->getReader()->getSheet(0);
                $headingRow = $sheet->toArray()[0] ?? [];

                $actual = array_map('strtolower', $headingRow);
                $missing = array_diff($this->expectedHeaders, $actual);

                if (!empty($missing)) {
                    $this->report['header_error'] = 'Missing column(s): ' . implode(', ', $missing);
                    throw new \Exception($this->report['header_error']);
                }
            },
        ];
    }

    public function model(array $row)
    {
        try {
            $post = new Post([
                'project_id'        => $this->projectId,
                'content_plan_id'   => $this->contentPlanId,
                'date'              => $this->parseDate($row['date'] ?? ''),
                'platform'          => $row['platform'] ?? '',
                'format'            => $row['format'] ?? '',
                'content_bucket'    => $row['content_bucket'] ?? '',
                'content_idea'      => $row['content_idea'] ?? '',
                'creative_copy'     => $row['creative_copy'] ?? '',
                'visual_direction'  => $row['visual_direction'] ?? '',
                'caption'           => $row['caption'] ?? '',
                'status'            => $row['status'] ?? 'pending',
            ]);
            $this->report['success']++;
            return $post;
        } catch (\Exception $e) {
            $this->report['failed']++;
            $this->report['failures'][] = [
                'row' => $row,
                'error' => $e->getMessage(),
            ];
            return null;
        }
    }

    protected function parseDate($dateString)
    {
        $formats = ['d/m/Y', 'd-m-Y', 'Y-m-d', 'm/d/Y', 'm-d-Y'];

        foreach ($formats as $format) {
            try {
                return Carbon::createFromFormat($format, $dateString)->format('Y-m-d');
            } catch (\Exception $e) {
                continue;
            }
        }

        try {
            return Carbon::parse($dateString)->format('Y-m-d');
        } catch (\Exception $e) {
            Log::error("Unrecognized date format: {$dateString}");
            throw new \Exception("Invalid date format: {$dateString}");
        }
    }

    public function getReport(): array
    {
        return $this->report;
    }
}
