<div class="container">
   <div class="row">
       <div class="col-md-6 offset-3">
           <div class="card">
               <h5 class="card-header">Update Team</h5>
               <div class="card-body">
                   <div class="row">
                       <form wire:submit="updateTeam" method="POST" enctype="multipart/form-data">
                           <div class="col-md-12">
                               <label for="name">Team Name</label>
                               <input type="text" wire:model="name" name="name" class="form-control" placeholder="Enter Team Name">
                               @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                           </div>

                           <div class="col-md-12 mt-3">
                               <label for="description">Team Description</label>
                               <textarea wire:model="description" name="description" class="form-control" placeholder="Enter Team Description"></textarea>
                               @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                           </div>

                           <div class="col-md-12 mt-3" wire:ignore>
                               <label for="users">Users</label>
                               <select class="form-control users" multiple>
                                   <option value="">Select User</option>
                                   @foreach($users as $user)
                                       @if(in_array($user->id, $selectedUsers))
                                          <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                       @else
                                          <option value="{{ $user->id }}">{{ $user->name }}</option>
                                       @endif
                                   @endforeach
                               </select>
                           </div>

                           <div class="mt-3">
                               <button type="submit" class="btn btn-primary">Update Team</button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>

@push('scripts')
   <script>
       $('.users').select2();

       $('.users').on('change', function(e){
           var users = $('.users');
           var selected_users = users.val();
           @this.set('user_ids', selected_users);
       });
   </script>
@endpush




