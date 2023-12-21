<?php
namespace App\Helpers;

use Laravolt\Avatar\Avatar;


class Helper
{

    public static function createAvatar($name,$folder){
        $avtar_bg_colors = [
            '#f44336',
            '#e91e63',
            '#9c27b0',
            '#673ab7',
            '#3f51b5',
            '#2196f3',
            '#00bcd4',
            '#009688',
            '#4caf50',
            '#ff9800',
            '#ff5722',
            '#795548',
            '#607d8b',
        ];
        $avtar = new Avatar();
        $avtar->create($name)->toBase64();
        $avtar->setBackground($avtar_bg_colors[rand(0,12)]);
        $avtar->save(storage_path('app/public/images/'.$folder.'/'.$name.'.png'));
        return 'images/'.$folder.'/'.$name.'.png';
    }
}
?>