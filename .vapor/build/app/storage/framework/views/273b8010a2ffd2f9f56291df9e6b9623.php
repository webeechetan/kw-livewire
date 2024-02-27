<div class="column-box h-100 p-3">
    <div class="files-head column-head d-flex flex-wrap align-items-center">
        <div>
            <h5 class="mb-0">Files & Folders</h5>
            <div class="text-light"><span class="text-primary"><i class='bx bx-folder' ></i></span> <?php echo e($directories_count); ?> <span class="px-2">|</span> <span class="text-secondary"><i class='bx bx-file-blank' ></i></span> <?php echo e($files_count); ?> <span class="px-2">|</span> <?php echo e($used_storage_size_in_mb); ?>MB Used / 100MB</div>
        </div>
        <div class="files-options ms-auto">
            <div class="btn-list align-items-center gap-10">
                <a wire:click="downloadSelected" class="btn btn-sm btn-border-success 
                <?php if(empty($selected_files)): ?> disabled <?php endif; ?>
                " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Here">
                    <span><i class='bx bx-download' ></i></span>
                </a>
                <a data-bs-toggle="modal" data-bs-target="#add-new-file" class="btn-border btn-border-primary"><span><i class='bx bx-plus'></i></span></a>
                <a data-bs-toggle="modal" data-bs-target="#add-new-link" class="btn-border btn-border-secondary"><span><i class='bx bx-link'></i></span></a>
                <a wire:click="deleteSelected" class="btn btn-sm btn-border-danger <?php if(empty($selected_files) && empty($selected_directories) && empty($selected_links)): ?> disabled <?php endif; ?> "><span><i class='bx bx-trash' ></i></span></a>
            </div>
        </div>
    </div>
    <div class="files-body">
        <!-- wire:loading -->
        <!-- <div class="spinner-border text-primary " role="status" >
            <span class="sr-only"></span>
        </div> -->
        <div class="loader_cus loader_column w-100" wire:loading.delay>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 25%"></div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col mb-3">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb mb-0">
                        <?php $__currentLoopData = $path_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $path_for_folder_open = '';
                                foreach($path_array as $path_key => $path_value){
                                    if($path_key <= $loop->index){
                                        $path_for_folder_open .= $path_value.'/';
                                    }
                                }

                            ?>
                            <li class="breadcrumb-item" wire:click="openFolder('<?php echo e($path_for_folder_open); ?>')"><a><?php echo e($p); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </nav>
            </div>
            <div class="col text-end">
                <div class="d-flex align-items-center flex-wrap justify-content-end"><span class="text-primary d-flex"><i class='bx bx-folder me-1' ></i></span> <?php echo e(count($selected_directories)); ?> <span class="px-2">|</span> <span class="text-secondary d-flex"><i class='bx bx-file-blank me-1' ></i></span> <?php echo e(count($selected_files)); ?> Selected</div>
            </div>
        </div>
        <div class="files-list">
            <?php $__currentLoopData = $directories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $directory_name => $directory_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="files-folder select_directory <?php if(in_array($directory_data['directory_path'], $selected_directories)): ?> selected <?php endif; ?>" data-directory="<?php echo e($directory_data['directory_path']); ?>" wire:dblclick="openFolder('<?php echo e($directory_data['directory_path']); ?>')">
                    <span class="files-folder-icon"><i class='bx bx-folder'></i></span>
                    <div class="files-folder-title"><?php echo e($directory_name); ?></div>
                    <div class="text-light"><span class="text-primary"><i class='bx bx-folder' ></i></span> <?php echo e($directory_data['directories_count']); ?> <span class="px-2">|</span> <span class="text-secondary"><i class='bx bx-file-blank' ></i></span> <?php echo e($directory_data['files_count']); ?></div>
                    
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            

            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="files-item select_link
                <?php if(in_array($l->id, $selected_links)): ?> selected <?php endif; ?>" data-link="<?php echo e($l->id); ?>">
                    <div class="files-item-icon">
                        <?php
                            $og_data = json_decode($l->og_data);
                        ?>
                        <?php if($l->og_data && $l->og_data != 'null' && $l->og_data != '[]' && $l->og_data != '{}' && $l->og_data != ''): ?>
                            <?php if($og_data->image ): ?>
                                <span><img src="<?php echo e($og_data->image); ?>" alt=""></span>
                            <?php endif; ?>
                        <?php else: ?>
                        <span><i class='bx bx-link'></i></span>
                        <?php endif; ?>
                    </div>
                    <div class="files-item-content">
                        <a href="<?php echo e($l->link); ?>" target="_blank" class="files-item-content-title">
                            <?php if($l->link_alias): ?>
                                <?php echo e($l->link_alias); ?>

                            <?php elseif($l->og_data && $l->og_data != 'null' && $l->og_data != '[]' && $l->og_data != '{}' && $l->og_data != ''): ?>
                                <?php echo e($og_data->title); ?>

                            <?php else: ?>
                                <?php echo e($l->link); ?>

                            <?php endif; ?>
                        </a>
                        <b>External Link</b>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="files-folder files-folder-add_new" data-bs-toggle="modal" data-bs-target="#add-new-directory" >
                <span class="files-folder-icon"><i class='bx bx-plus' ></i></span>
                <div class="files-folder-title">Add Folder</div>
            </div>
        </div>
        <div class="files-items-wrap">
            <div class="files-items-head column-head mb-4">
                <h5 class="title-sm mb-0">Recent Files</h5>
                <!-- <form class="ms-auto" action="">
                    <div class="search-box">
                        <input class="form-control" type="text" placeholder="Search File...">
                        <span class="search-box-icon"><i class='bx bx-search' ></i></span>   
                    </div>
                </form> -->
            </div>
           
            <div class="files-items">
                <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file_name => $file_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="files-item select_file <?php if(in_array($file_data['file_path'], $selected_files)): ?> selected <?php endif; ?>" data-file="<?php echo e($file_data['file_path']); ?>">
                        <div class="files-item-icon">
                            <?php if($this->createThumbnailFromFileName($file_name)): ?>
                                <span><img src="<?php echo e($this->createThumbnailFromFileName($file_name)); ?>" alt=""></span>
                            <?php else: ?>
                                <span><i class='bx bx-file'></i></span>
                            <?php endif; ?>
                        </div>
                        <div class="files-item-content">
                            <div class="files-item-content-title"><?php echo e($file_name); ?></div>
                            <div class="files-item-content-des"><?php echo e($file_data['size']); ?> KB | <?php echo e($file_data['last_modified']); ?></div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="files-folder files-folder-add_new" data-bs-toggle="modal" data-bs-target="#add-new-file">
                    <span class="files-folder-icon"><i class='bx bx-plus' ></i></span>
                    <div class="files-folder-title">Add Files</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New File modal -->
    <div wire:ignore class="modal fade" id="add-new-file" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title">
                        <span class="btn-icon btn-icon-primary me-1"><i class='bx bx-file'></i></span> 
                        Add New File
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="addNewFile" enctype="multipart/form-data">
                        <div class="modal-form-body">
                            
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Add File</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="form-file_upload form-file_upload-logo">
                                        <input type="file" id="formFile" wire:model="new_file" >
                                        <div class="form-file_upload-box">
                                            <div class="form-file_upload-box-icon"><i class='bx bx-image'></i></div>
                                            <div class="form-file_upload-box-text">Add File</div>
                                        </div>
                                        <div class="form-file_upload-valText">Allowed *.jpeg, *.jpg, *.png, *.gif max size of 3 Mb</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">File Name</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="new_file_name" type="text" class="form-style" placeholder="File Name Here...">
                                </div>
                            </div>
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary">Save File</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add New Folder -->
    <div wire:ignore class="modal fade" id="add-new-directory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title">
                        <span class="btn-icon btn-icon-primary me-1"><i class='bx bx-file'></i></span> 
                        Add New Folder
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="addNewDirectory" enctype="multipart/form-data">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Folder Name</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="new_directory_name" type="text" class="form-style" placeholder="Folder Name Here...">
                                </div>
                            </div>
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary">Create Folder</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Link -->
    <div wire:ignore class="modal fade" id="add-new-link" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title">
                        <span class="btn-icon btn-icon-primary me-1"><i class='bx bx-link'></i></span> 
                        Save Link
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="saveLink" enctype="multipart/form-data">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Link</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="link_name" type="text" class="form-style" placeholder="Paste Link Here...">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Link Alias</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="link_alias" type="text" class="form-style" placeholder="Link Alias Name Here...">
                                </div>
                            </div>
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary">Save Link</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
   document.addEventListener('fileAdded', event => {
        $('#add-new-file').modal('hide');
    })

    document.addEventListener('directoryAdded', event => {
        $('#add-new-directory').modal('hide');
    })

    document.addEventListener('linkAdded', event => {
        $('#add-new-link').modal('hide');
    })
    

    $(document).ready(function(){

        setInterval(() => {
            let progress = $(".progress-bar").width();
            if(progress >= 100){
                $(".progress").width(0);
            }
            $(".progress").width(progress + 100);

        }, 100);

        $(document).on("click", ".select_file", function(event){
            let file_path = $(this).data("file");
            if(event.ctrlKey){
                $(this).toggleClass("selected");
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').selectFile(file_path,'multipe');
                return;
            }
            window.Livewire.find('<?php echo e($_instance->getId()); ?>').selectFile(file_path,'single');
            $(".select_file").removeClass("selected");
            $(this).addClass("selected");
        });

        let clickedOnce = false;

        $(document).on("click", ".select_directory", function(event){
            if (!clickedOnce) {
                // Set a delay to detect double-click
                setTimeout(function() {

                    // if (!clickedOnce) {
                        // Single-click action
                        let directory_path = $(this).data("directory");
                        if (event.ctrlKey) {
                            $(this).toggleClass("selected");
                            window.Livewire.find('<?php echo e($_instance->getId()); ?>').selectDirectory(directory_path, 'multipe');
                            return;
                        }
                        console.log('single clicked');
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').selectDirectory(directory_path, 'single');
                        $(".select_directory").removeClass("selected");
                        $(this).addClass("selected");
                    // }
                    clickedOnce = false;
                }.bind(this), 300); // Adjust the delay as needed (300 milliseconds in this case)

                clickedOnce = true;
                event.preventDefault(); // Prevent default action
                return false;
            }
        });

        $(document).on("dblclick", ".select_directory", function(event){
            // If double-clicked, return false to prevent further action
            console.log('double clicked');
            event.preventDefault();
            return false;
        });


        $(document).on("click", ".select_link", function(event){
            let link_path = $(this).data("link");
            if(event.ctrlKey){
                $(this).toggleClass("selected");
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').selectLink(link_path,'multipe');
                return;
            }
            window.Livewire.find('<?php echo e($_instance->getId()); ?>').selectLink(link_path,'single');
            $(".select_link").removeClass("selected");
            $(this).addClass("selected");
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\livewire\components\file-manager.blade.php ENDPATH**/ ?>