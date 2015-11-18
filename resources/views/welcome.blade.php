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
                        <image src="images/cards/official/{!!$cards[0]->name!!}" id="image"/><br/><br/>
                        <button type="button" id="next">NEXT</button>
                        <p id="test">test text is here</p>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">            
    $(document).ready(function(){
        var i = 0;
        $("#test").text("cards[" + i + "]");
        $("#next").click(function(){
            i++;
            $("#image").attr('src', "images/cards/official/{!!$cards[1]->name!!}");
            $("#test").text("cards[" + i + "]");
            // Romain: J'arrive pas à creer une requete incrementalle avec {!!$cards[n+1]
        });
    });
</script>
@endsection


