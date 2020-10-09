@csrf
@role('ministry')
<div class="form-group">
    <label for="username">Province name</label>
    <select name="province_id" data-url="{{ url('/') }}/province/select2" class="form-control" style="width: 100%">
		@if(isset($user) && !empty($user->province))
			<option value="{{ $user->province->id }}">{{ $user->province->name }}</option>
		@endif
	</select>
</div>
@endrole

@role('province')
	<div class="form-group">
	    <label for="username">District name</label>
	    <select name="district_id" data-url="{{ url('/') }}/district/select2" class="form-control" style="width: 100%">
	    	@if(isset($user) && !empty($user->district))
	    		<option value="{{ $user->district->id }}">{{ $user->district->name }}</option>
	    	@endif
		</select>
	</div>
@endrole

<div class="form-group">
    <label for="username">User name</label>
    <input type="text" name="name" id="name" value="{{ $user->name ?? '' }}" class="form-control" autocomplete="off">
</div>

@if(!isset($user))
	<div class="form-group">
	    <label for="password">Password</label>
	    <input type="password" name="password" id="password" class="form-control" autocomplete="off" required>
	</div>
@endif

@if(isset($roles)) 
	@if(!empty($roles[0]))
		<div class="form-group">
			<label>Assign Roles to User</label>
			@php $roleId = (isset($user)) ? collect($user->roles->pluck('id'))->toArray() : [0]; @endphp
			@foreach ($roles as $role)
			    <div class="checkbox">
			        <label>
			            <input type="checkbox" name="roles[]" <?php echo (in_array($role->id, $roleId)) ? 'checked': ''; ?> value="{{ $role->id }}" /> {{ ucfirst($role->name) }}
			        </label>
			    </div>
		    @endforeach
		</div>
	@endif
@endif