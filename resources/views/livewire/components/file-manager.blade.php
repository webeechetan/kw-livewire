<div class="column-box p-3" style="margin-bottom:150px;">
    <div class="files-head column-head d-flex flex-wrap align-items-center">
        <div>
            <h5 class="column-title">Files & Folders</h5>
            <div class="text-light"><span class="text-secondary"><i class='bx bx-file-blank' ></i></span> {{$files_count}} <span class="px-2">|</span> <span class="text-primary"><i class='bx bx-folder' ></i></span> {{ $directories_count }} <span class="px-2">|</span> <span class="text-primary"><i class='bx bx-link-alt' ></i></span> {{ $directories_count }} <span class="px-2">|</span> {{$used_storage_size_in_mb}}MB Used / 100MB</div>
        </div>
        <div class="files-options ms-auto">
            <div class="btn-list align-items-center gap-10">
                <a wire:click="downloadSelected" class="btn btn-sm btn-border-success 
                @if(empty($selected_files)) disabled @endif
                " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Here">
                    <span><i class='bx bx-download' ></i></span>
                </a>
                <a data-bs-toggle="modal" data-bs-target="#add-new-file" class="btn-border btn-border-primary"><span><i class='bx bx-plus'></i></span></a>
                <a data-bs-toggle="modal" data-bs-target="#add-new-link" class="btn-border btn-border-secondary"><span><i class='bx bx-link'></i></span></a>
                <a wire:click="deleteSelected" class="btn btn-sm btn-border-danger @if(empty($selected_files) && empty($selected_directories) && empty($selected_links)) disabled @endif "><span><i class='bx bx-trash' ></i></span></a>
            </div>
        </div>
    </div>
    <div class="files-body">
        <!-- wire:loading -->
        <!-- <div class="spinner-border text-primary " role="status" >
            <span class="sr-only"></span>
        </div> -->
        <div class="row pt-3">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb mb-0">
                        @foreach($path_array as $p )
                            @php
                                $path_for_folder_open = '';
                                foreach($path_array as $path_key => $path_value){
                                    if($path_key <= $loop->index){
                                        $path_for_folder_open .= $path_value.'/';
                                    }
                                }

                            @endphp
                            <li class="breadcrumb-item" wire:click="openFolder('{{$path_for_folder_open}}')"><a>{{ $p }}</a></li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Loader -->
        <div class="loader_cus loader_column w-100" wire:loading.delay>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 25%"></div>
            </div>
        </div> 

        <!-- Add Files & Folders -->
        <div class="row mt-3">
            <div class="col-md-4">
                <div class="files-folder files-folder-add_new files-folder-primary" data-bs-toggle="modal" data-bs-target="#add-new-file">
                    <span class="files-folder-icon"><i class='bx bx-file-blank' ></i></span>
                    <div class="files-folder-title ms-1">Add File</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="files-folder files-folder-add_new files-folder-warning" data-bs-toggle="modal" data-bs-target="#add-new-directory">
                    <span class="files-folder-icon"><i class='bx bx-folder' ></i></span>
                    <div class="files-folder-title ms-1">Add Folder</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="files-folder files-folder-add_new files-folder-secondary" data-bs-toggle="modal" data-bs-target="#add-new-link">
                    <span class="files-folder-icon"><i class='bx bx-link-alt' ></i></span>
                    <div class="files-folder-title ms-1">Add Link</div>
                </div>
            </div>
        </div>

        <!-- File & Folder Wrap -->
        <div class="files-items-wrap mt-4 mb-3">
            <div class="column-head column-head-light d-flex flex-wrap align-items-center">
                <div>
                    <h5 class="title-sm mb-2"></h5>
                    <div><i class='bx bx-data text-primary' ></i> {{ $directories_count }} Attachments <span class="px-2">|</span> {{$used_storage_size_in_mb}}MB Used / 100MB</div>
                </div>
                <form class="search-box search-box-float-style ms-auto" action="">
                    <span class="search-box-float-icon"><i class="bx bx-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search">
                </form>
            </div>
        </div>

        <!-- Filters -->
        <div class="btn-list mb-3">
            <a href="#" class="btn-border btn-border-success"><i class='bx bx-data'></i> All {{ count($selected_files) }}</a>
            <a href="#" class="btn-border btn-border-primary"><i class='bx bx-file-blank' ></i> Files {{ count($selected_files) }}</a>
            <a href="#" class="btn-border btn-border-warning"><i class='bx bx-folder me-1' ></i> Folders {{ count($selected_directories) }}</a>
            <a href="#" class="btn-border btn-border-secondary"><i class='bx bx-link-alt' ></i> Links {{ count($selected_links) }}</a>
        </div>

        <div class="files-list">
            {{-- Folders --}}
            @foreach($directories as $directory_name => $directory_data)
                <div class="files-folder files-item select_directory @if(in_array($directory_data['directory_path'], $selected_directories)) selected @endif" data-directory="{{$directory_data['directory_path']}}" wire:dblclick="openFolder('{{$directory_data['directory_path']}}')">
                    <span class="files-folder-icon"><i class='bx bx-folder'></i></span>
                    <div class="files-folder-title">{{ $directory_name }}</div>
                    <div class="text-light"><span class="text-primary"><i class='bx bx-folder' ></i></span> {{ $directory_data['directories_count'] }} <span class="px-2">|</span> <span class="text-secondary"><i class='bx bx-file-blank' ></i></span> {{ $directory_data['files_count'] }}</div>
                </div>
            @endforeach
            {{-- Files --}}
            @foreach($files as $file_name => $file_data)
                <div class="files-item select_file @if(in_array($file_data['file_path'], $selected_files)) selected @endif" data-file="{{ $file_data['file_path'] }}">
                    <div class="files-size">{{ $file_data['size'] }} KB | {{ $file_data['last_modified'] }}</div>
                    
                    <div class="files-item-icon">
                        @if($this->createThumbnailFromFileName($file_name))
                            <span><img src="{{ $this->createThumbnailFromFileName($file_name) }}" alt=""></span>
                        @else
                            <span><i class='bx bx-file'></i></span>
                        @endif
                    </div>
                    <div class="files-item-content">
                        <div class="files-item-content-title mb-2">{{$file_name}}</div>
                    </div>
                </div>
            @endforeach
            {{-- Links --}}
            @foreach($links as $l)
                <div class="files-item select_link @if(in_array($l->id, $selected_links)) selected @endif" data-link="{{ $l->id }}">
                    <div class="files-item-icon">
                        @php
                            $og_data = json_decode($l->og_data);
                        @endphp
                        @if($l->og_data && $l->og_data != 'null' && $l->og_data != '[]' && $l->og_data != '{}' && $l->og_data != '')
                            @if($og_data->image )
                                <span><img src="{{ $og_data->image }}" alt=""></span>
                            @endif
                        @else
                        <span><i class='bx bx-link'></i></span>
                        @endif
                    </div>
                    <div class="files-item-content">
                        <a href="{{ $l->link }}" target="_blank" class="files-item-content-title">
                            @if($l->link_alias)
                                {{ $l->link_alias }}
                            @elseif($l->og_data && $l->og_data != 'null' && $l->og_data != '[]' && $l->og_data != '{}' && $l->og_data != '')
                                {{ $og_data->title }}
                            @else
                                {{ $l->link }}
                            @endif
                        </a>
                        <b>External Link</b>
                    </div>
                </div>
            @endforeach
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

@push('scripts')
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
                @this.selectFile(file_path,'multipe');
                return;
            }
            @this.selectFile(file_path,'single');
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
                            @this.selectDirectory(directory_path, 'multipe');
                            return;
                        }
                        console.log('single clicked');
                        @this.selectDirectory(directory_path, 'single');
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
                @this.selectLink(link_path,'multipe');
                return;
            }
            @this.selectLink(link_path,'single');
            $(".select_link").removeClass("selected");
            $(this).addClass("selected");
        });
    });
</script>
@endpush
