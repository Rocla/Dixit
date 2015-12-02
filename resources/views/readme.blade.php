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
                <div class="panel-heading">{{ trans('readme.heading') }}</div>

                <div class="panel-body">
                    <center>
                        <img src="{{asset('/images/logos/logo-composer-transparent.png')}}"/>
                    </center>
                    <p><h3>{{ trans('readme.what_is_it') }}</h3></p>
                    <p>{{ trans('readme.what_is_it_more') }}</p>
                    <p><a href="https://github.com/Rocla/Dixit">{{ trans('readme.github_repo') }}</a></p>
                    <p><h3>{{ trans('readme.brief_description') }}</h3></p>
                    <p>
                        <ul>
                            <li>{{ trans('readme.brief_description_text_1') }}</li>
                            <li>{{ trans('readme.brief_description_text_2') }}</li>
                            <li>{{ trans('readme.brief_description_text_3') }}</li>
                            <li>
                                {{ trans('readme.brief_description_text_4') }}
                                <ul>
                                    <li>{{ trans('readme.brief_description_text_4_1') }}</li>
                                </ul>
                            </li>
                        </ul>
                    </p>
                    <p><a href="https://github.com/Rocla/Dixit/wiki">{{ trans('readme.wiki') }}</a></p>
                    <p><h3>{{ trans('readme.license') }}</h3></p>
                    <p>
                        <ul>
                            <li>{{ trans('readme.license_1') }}</li>
                            <li>{{ trans('readme.license_2') }}</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


