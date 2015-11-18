@extends('base')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Recover password</div>
				<div class="panel-body">
					@if (count($errors) > 0)
	                <div class="alert alert-danger">
	                    Don't worry, be happy <strong>It's not 404!</strong> but something went wrong.<br/><br/>
	                    <table>
	                        @foreach ($errors->all() as $error)
	                            <tr><td><li>{{ $error }}</li></td></tr>
	                        @endforeach
	                    </table>
	                </div>
	                @endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/recover-password') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Your E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Your public key</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="public_key">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Your private key</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="private_key">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">New password (min 6 characters)</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm your new password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Modify your password
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
