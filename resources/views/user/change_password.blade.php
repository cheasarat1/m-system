<form role="form" id="form_user" action="{{ route('user.change-password', $id) }}" method="POST">
	@csrf
    <div class="form-group">
	    <label for="password">Password</label>
	    <input type="password" name="password" id="password" value="" class="form-control">
	    <span class="help-block error-message"></span>
	</div>
</form>