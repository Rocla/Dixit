@extends('base')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">{{ trans('register.heading') }}</div>
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

	                <center>
						<img src="{{asset('/images/other/register.png')}}"/>
					</center>
					<br/>

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('register.username') }}</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="username" value="{{ old('username') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('register.email') }}</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('register.password') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('register.password_confirm') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('register.question') }}</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="question">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('register.answer') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="answer">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('register.answer_confirm') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="answer_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-5">
								<button type="submit" class="btn btn-primary">
									{{ trans('register.register') }}
								</button>
							</div>
						</div>
						</form>

						<br/>

						<div>
							<center><label>{{ trans('register.powered_by') }} <a href="http://www.hoax-slayer.com/images/privacy.jpg">iDontCareWhoYouAre.org</a></label></center>
							<center><label>{{ trans('register.notice_encryption') }}</label></center>
						</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
