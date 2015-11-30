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
                <div class="panel-heading">{{ trans('welcome.heading') }}</div>

                <div class="panel-body">
                    <p>{{ trans('welcome.what_is_dixit') }}</p>
                    <p>{{ trans('welcome.what_is_dixit_online') }}</p>
                    <p>{{ trans('welcome.how_to_play') }}</p>
                    <center>
                        <p>{{ trans('welcome.cards_show') }}</p>
                        <button type="button" id="previous" class="btn btn-lg btn-primary">{{ trans('welcome.previous') }}</button>
                        <button type="button" id="next" class="btn btn-lg btn-primary">{{ trans('welcome.next') }}</button>
                        <br/><br/>
                        <image id="cardImage"/>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">            
    $(document).ready(function(){
        var i = 0;

        $.ajax({
                url: 'cards/imageByID',
                type: "post",
                data: {
                    'id':i,
                    '_token': $('input[name=_token]').val()
                },
            success: function(data){
                $("#cardName").text(data);
                $("#cardImage").attr('src', "{{asset('/images/cards/official')}}"+"/"+data);
                }
            });

        $("#next").click(function(){
            i++;
            $.ajax({
                url: 'cards/imageByID',
                type: "post",
                data: {
                    'id':i,
                    '_token': $('input[name=_token]').val()
                },
            success: function(data){
                $("#cardName").text(data);
                $("#cardImage").attr('src', "{{asset('/images/cards/official')}}"+"/"+data);
                }
            });
        });

        $("#previous").click(function(){
            i--;
            $.ajax({
                url: 'cards/imageByID',
                type: "post",
                data: {
                    'id':i,
                    '_token': $('input[name=_token]').val()
                },
            success: function(data){
                $("#cardName").text(data);
                $("#cardImage").attr('src', "{{asset('/images/cards/official')}}"+"/"+data);
                }
            });
        });
    });
</script>
@endsection


