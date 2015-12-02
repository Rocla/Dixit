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
                <div class="panel-heading">{{ trans('rules.heading') }}</div>

                <div class="panel-body">
                    <center>
                        <img src="{{asset('/images/logos/dixit_logo.jpeg')}}"/>
                    </center>
                    <p><h3>{{ trans('rules.what_is_dixit_title') }}</h3></p>
                    <p>{{ trans('rules.what_is_dixit_text') }}</p>
                    <p><h3>{{ trans('rules.rules_title') }}</h3></p>
                    <p>{{ trans('rules.rules_text') }}</p>
                    <p><h3>{{ trans('rules.scoring_title') }}</h3></p>
                    <p>{{ trans('rules.scoring_text') }}</p>
                    <p><h3>{{ trans('rules.end_of_game_title') }}</h3></p>
                    <p>{{ trans('rules.end_of_game_text') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


