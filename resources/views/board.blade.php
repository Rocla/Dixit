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
                    <div id="top_game_actions"></div>
                    <div id="top_game_hand"></div>
                    <div>
                        <div>
                            <div class="card_on_board">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%" id="spot_card_12">
                            </div>
                            <div class="card_on_board">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%" id="spot_card_11">
                            </div>
                            <div class="card_on_board">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%" id="spot_card_10">
                            </div>
                            <div class="card_on_board">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%" id="spot_card_9">
                            </div>
                            <div class="card_on_board">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%" id="spot_card_8">
                            </div>
                            <div class="card_on_board">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%" id="spot_card_7">
                            </div>
                        </div>

                        <img src="{{asset('/images/boards/theme_odyssey.jpg')}}" width="100%">

                        <div>
                            <div class="card_on_board">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%" id="spot_card_1">
                            </div>
                            <div class="card_on_board">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%"  id="spot_card_2">
                            </div>
                            <div class="card_on_board">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%" id="spot_card_3">
                            </div>
                            <div class="card_on_board">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%" id="spot_card_4">
                            </div>
                            <div class="card_on_board">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%" id="spot_card_5">
                            </div>
                            <div class="card_on_board">
                                <img src="{{asset('/images/default_avatar/waiting_light_blue.png')}}" width="100%" id="spot_card_6">
                            </div>
                        </div>
                    </div>
                    
                    <div id="bottom_game_hand">
                    Hand:
                        <div class="well">
                            <div class="hand" id="hand_set">
                                <img id="drag_card_1" src="{{asset('/images/cards/official/')}}/carte_1.png" width="100%" draggable="true" ondragstart="drag(event)">
                                <img id="drag_card_2" src="{{asset('/images/cards/official/')}}/carte_2.png" width="100%" draggable="true" ondragstart="drag(event)">
                                <img id="drag_card_3" src="{{asset('/images/cards/official/')}}/carte_3.png" width="100%" draggable="true" ondragstart="drag(event)">
                                <img id="drag_card_4" src="{{asset('/images/cards/official/')}}/carte_4.png" width="100%" draggable="true" ondragstart="drag(event)">
                                <img id="drag_card_5" src="{{asset('/images/cards/official/')}}/carte_5.png" width="100%" draggable="true" ondragstart="drag(event)">
                                <img id="drag_card_6" src="{{asset('/images/cards/official/')}}/carte_6.png" width="100%" draggable="true" ondragstart="drag(event)">
                            </div>
                        </div>
                    </div>
                    <div id="bottom_game_actions">
                        Actions:
                        <div class="well" float="left">
                            Timer: <p id="timer_turn"></p>
                            You are the Storyteller:
                                <textarea id="story"></textarea><br/>
                                <button type='button' id="create_new_turn" class="btn btn-primary" disabled>Validate new turn</button>
                                <button type='button' id="validate_card" class="btn btn-primary" disabled>Validate card</button>
                                <button type='button' id="reset_hand" class="btn btn-primary">Reset hand</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript"> 

// Retrived data from controller at loading
var player_spot_number = 5;
var player_cards_number = 6;
var validated_players = [];
var players_playing = [];
var player_owner = 1;
var player_storyteller = 1;


// Retrived data from live server
var game_status = "";
var game_started = false;
var player_played = [];

// Computated data
var play_spot = "spot_card_" + player_spot_number;


// On page load
$(document).ready(function(){
    $imageRatio = 500/330;
    resize_height_cards();
    $( window ).resize(function() {
        resize_height_cards();
    });

    $("#"+play_spot).attr('src', "{{asset('/images/cards/drag_card_here.png')}}");
    $("#"+play_spot).attr('ondrop', 'drop(event)');
    $("#"+play_spot).attr('ondragover', 'allowDrop(event)');

    if(player_spot_number > 6)
    {
        document.getElementById('top_game_hand').appendChild(document.getElementById('bottom_game_hand'));
        document.getElementById('top_game_actions').appendChild(document.getElementById('bottom_game_actions'));
    }
});

// Drag and drop for player
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("id", ev.target.getAttribute('id'));
    ev.dataTransfer.setData("src", ev.target.getAttribute('src'));
}

function drop(ev) {
    ev.preventDefault();

    var data = ev.dataTransfer.getData("id");
    var data_url = ev.dataTransfer.getData("src");

    if ($('#hand_set').children().length < player_cards_number)
    {
        document.getElementById(data).src = ev.target.getAttribute('src');
    }
    else
    {
        document.getElementById(data).remove();
    }

    document.getElementById(play_spot).src = data_url;

}
  
// Design of the cards on board
function resize_height_cards(){
    $imageHeight = $(".card_on_board").width()*$imageRatio;
    $(".card_on_board").css('height', $imageHeight + 'px');
}

</script>

@endsection


