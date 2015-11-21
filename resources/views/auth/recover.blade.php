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
								<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
								<button type='button' id="validateEmail" class="btn btn-secondary" disabled>
									Verify
								</button>
							</div>
							
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Your question</label>
							<div class="col-md-6">
								<input id="question" disabled type="text" class="form-control" name="question">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Your answer</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="answer">
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

<script type="text/javascript">            
    $(document).ready(function(){
        var questionID = document.getElementById("question");
		questionID.value = "Enter a correct email to see the question";

		var emailID = document.getElementById("email");

		$('#email').on('input', function() { 
			if(isEmail($(this).val())){
				questionID.value = "You entered an email, click validate to retrive the question"
				document.getElementById("validateEmail").removeAttribute('disabled')
			}
		});

		$("#validateEmail").click(function(){
            document.getElementById("validateEmail").setAttribute('disabled')
            $.ajax({
				url: 'testEmail',
				type: "post",
				data: {
					'email':$(emailID).val(),
					'_token': $('input[name=_token]').val()
				},
			success: function(data){
				questionID.value = data;
				}
			});
        });

    });
    function isEmail(email){
  		var regex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.)+([a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
  		return regex.test(email);
	}
</script>

@endsection
