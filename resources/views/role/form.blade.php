@csrf
<div class="form-group">
    <label for="username">Role name</label>
    <input type="text" name="name" id="name" value="{{ $role->name ?? '' }}" class="form-control" autocomplete="off" autofocus>
</div>

@if(isset($permissions)) 
	@if(!empty($permissions[0]))
		<div class="form-group">
			<label for="password">Assign Permissions</label>
			@php $permissionId = (isset($role)) ? collect($role->permissions->pluck('id'))->toArray() : [0]; @endphp
			@foreach ($permissions as $permission)
			    <div class="checkbox">
			        <label>
			            <input type="checkbox" name="permissions[]" <?php echo (in_array($permission->id, $permissionId)) ? 'checked': ''; ?> value="{{ $permission->id }}"> 
			            {{ $permission->name }}
			        </label>
			    </div>
		    @endforeach
		</div>
	@endif
@endif