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
                <div class="panel-heading">Welcome page for Guests</div>

                <div class="panel-body">
                    <center>
                        <image src="{{asset('/images/cards/official')}}/{!!$cards[0]->name!!}" id="cardImage"/><br/><br/>
                        <button type="button" id="previous">Previous</button>
                        <button type="button" id="next">Next</button>
                        <p id="cardName"></p>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">            
    $(document).ready(function(){
        var i = 0;

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


