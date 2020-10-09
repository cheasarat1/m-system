@csrf
<div class="form-group">
    <label for="username">Permission name</label>
    <input type="text" name="name" id="name" value="{{ $permission->name ?? '' }}" class="form-control" autocomplete="off" autofocus>
</div>

@if(isset($roles))
	@if(!empty($roles[0])) 
		<div class="form-group">
			<label>Assign Permission to Roles</label>
			@foreach ($roles as $role)
			    <div class="checkbox">
			        <label>
			            <input type="checkbox" name="roles[]" value="{{ $role->id }}"> {{ $role->name }}
			        </label>
			    </div>
		    @endforeach
		</div>
	@endif
@endif