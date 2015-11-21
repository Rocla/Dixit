@extends('base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    Don't worry, be happy <strong>It's not 404!</strong> but something went wrong.<br/><br/>
                    <table>
                        <tr>
                        @foreach ($errors->all() as $error)
                            <th>{{ $error }}</th>
                        @endforeach
                        </tr>
                    </table>
                </div>
                @endif
                <div class="panel-heading">Edit your Profile</div>

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/profile-edit') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Your username</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Your e-mail address</label>
                            <div class="col-md-6">
                                <input type="email" disabled class="form-control" name="email" value="{{ Auth::user()->email }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Your password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirm your password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Your question to recover your password</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="question" value="{{ Auth::user()->question }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Your answer to recover your password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="answer">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirm your answer</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="answer_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Modify
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

@endsection


