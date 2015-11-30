@extends('base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">

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
                <div class="panel-heading">{{ trans('profile-edit.heading') }}</div>
                
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/profile-edit') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('profile-edit.username') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('profile-edit.email') }}</label>
                            <div class="col-md-6">
                                <input type="email" disabled class="form-control" name="email" value="{{ Auth::user()->email }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('profile-edit.password') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('profile-edit.password_confim') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('profile-edit.question') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="question" value="{{ Auth::user()->question }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('profile-edit.answer') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="answer">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('profile-edit.answer_confirm') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="answer_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('profile-edit.modify') }}
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


