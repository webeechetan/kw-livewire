<!-- resources/views/livewire/tasks/list-task.blade.php -->

<div class="container">
    <div class="row">
        <div class="col text-end">
            <div class="pull-right">
                <button class="btn btn-primary" wire:click="addTask">Add Task</button>
            </div>
        </div>
    </div>
    <div class="tab-view mt-4">
        <div class="tab-pane" id="board" role="tabpanel" aria-labelledby="board-tab">
            <div class="row flex-row flex-nowrap scrolling-wrapper mt-4">
                <div class="column" id="pending-column" data-status="pending">
                    <h5>Pending</h5>
                    @foreach($tasks['pending'] as $task)
                        <div class="task" wire:key="pending-{{$task['id']}}" data-task="{{$task['id']}}">
                            {{ $task['name'] }}
                        </div>
                    @endforeach
                </div>
                <div class="column" id="completed-cloumn" data-status="completed">
                    <h5>Completed</h5>
                    @foreach($tasks['completed'] as $task)
                        <div class="task" wire:key="pending-{{$task['id']}}" data-task="{{$task['id']}}">
                            {{ $task['name'] }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
        $(".task").draggable({
            revert: true,
            revertDuration: 0,
            cursor: "move",
            zIndex: 100,
            appendTo: "body",
            helper: "clone",
            start: function(event, ui) {
                $(this).addClass("dragging");
            },
            stop: function(event, ui) {
                $(this).removeClass("dragging");
            }
        });

        $(".column").droppable({
            accept: ".task",
            drop: function(event, ui) {
                var task_id = ui.draggable.attr("data-task");
                var status = $(this).attr("data-status");
                console.log(task_id, status);
                @this.updateTaskStatus(task_id, status);
            }
        });

        // add event listener if task updated re init the drag and drop 
        document.addEventListener("task-updated", function(e) {
            $(".task").draggable({
                revert: true,
                revertDuration: 0,
                cursor: "move",
                zIndex: 100,
                appendTo: "body",
                helper: "clone",
                start: function(event, ui) {
                    $(this).addClass("dragging");
                },
                stop: function(event, ui) {
                    $(this).removeClass("dragging");
                }
            });

            $(".column").droppable({
                accept: ".task",
                drop: function(event, ui) {
                    var task_id = ui.draggable.attr("data-task");
                    var status = $(this).attr("data-status");
                    console.log(task_id, status);
                    @this.updateTaskStatus(task_id, status);
                }
            });
        });
    </script>
@endpush
