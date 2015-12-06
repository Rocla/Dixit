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
                <div class="panel-heading">{{ trans('board.heading') }} Test</div>

                <div class="panel-body">
                    Administration panel:
                     <div class="well" float="left">
                        <button type='button' id="edit_game" class="btn btn-primary">Edit</button>
                        <button type='button' id="start_game" class="btn btn-primary" disabled>Start</button>
                    </div>
                     Game Status:
                    <div class="well" float="left">
  
                        <p id="game_status"></p>
                    </div>
                    
                    <div>
                        <div>
                            <div class="card_on_board" id="spot_card_12">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%">
                            </div>
                            <div class="card_on_board" id="spot_card_11">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%">
                            </div>
                            <div class="card_on_board" id="spot_card_10">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%">
                            </div>
                            <div class="card_on_board" id="spot_card_9">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%">
                            </div>
                            <div class="card_on_board" id="spot_card_8">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%">
                            </div>
                            <div class="card_on_board" id="spot_card_7">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%">
                            </div>
                        </div>

                        <img src="{{asset('/images/boards/theme_odyssey.jpg')}}" width="100%">

                        <div>
                            <div class="card_on_board" id="spot_card_1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                            <div class="card_on_board" id="spot_card_2">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%">
                            </div>
                            <div class="card_on_board" id="spot_card_3">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%">
                            </div>
                            <div class="card_on_board" id="spot_card_4">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%">
                            </div>
                            <div class="card_on_board" id="spot_card_5">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%">
                            </div>
                            <div class="card_on_board" id="spot_card_6">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%">
                            </div>
                        </div>
                    </div>
                    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                    Hand:
                    <div class="well">
                        <div class="hand"><center>
                            <img id="drag_card_1" src="{{asset('/images/cards/official/')}}/carte_1.png" width="100%" draggable="true" ondragstart="drag(event)">
                            <img id="drag_card_2" src="{{asset('/images/cards/official/')}}/carte_2.png" width="100%" draggable="true" ondragstart="drag(event)">
                            <img id="drag_card_3" src="{{asset('/images/cards/official/')}}/carte_3.png" width="100%" draggable="true" ondragstart="drag(event)">
                            <img id="drag_card_4" src="{{asset('/images/cards/official/')}}/carte_4.png" width="100%" draggable="true" ondragstart="drag(event)">
                            <img id="drag_card_5" src="{{asset('/images/cards/official/')}}/carte_5.png" width="100%" draggable="true" ondragstart="drag(event)">
                            <img id="drag_card_6" src="{{asset('/images/cards/official/')}}/carte_6.png" width="100%" draggable="true" ondragstart="drag(event)">
                        </center></div>
                    </div>
                    Actions:
                    <div class="well" float="left">
                        Timer: <p id="timer_turn"></p>
                        You are the Storyteller:
                        <center>
                            <textarea id="story"></textarea><br/>
                            <button type='button' id="create_new_turn" class="btn btn-primary" disabled>Validate new turn</button>
                            <button type='button' id="validate_card" class="btn btn-primary" disabled>Validate card</button>
                            <button type='button' id="reset_hand" class="btn btn-primary">Reset hand</button>
                        </center>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

#spot_card_1 {
    background-image: url("{{asset('/images/cards/drag_card_here.png')}}");
    background-size: 100% 100%;
}

</style>

<script type="text/javascript"> 

$(document).ready(function(){
    $imageRatio = 500/330;
    resize_height_cards();
    $( window ).resize(function() {
        resize_height_cards();
    });
});

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    // ev.target.appendChild(document.getElementById(data));
    // ev.target.removeChild(ev.target.childNodes[0]);
    ev.target.appendChild(document.getElementById(data));
}
  

function resize_height_cards(){
    $imageHeight = $(".card_on_board").width()*$imageRatio;
    $(".card_on_board").css('height', $imageHeight + 'px');
}

</script>

@endsection


