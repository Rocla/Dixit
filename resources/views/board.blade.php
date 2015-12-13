@extends('base')

@section('content')

<div class="container">
    <div class="row" id="loading_spot">
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
                <div class="panel-heading" id="title_name"></div>

                <div class="panel-body">
                    <div id="administration_panel">
                    Administration panel:
                         <div class="well" float="left">
                            <button type='button' id="edit_game" class="btn btn-primary" disabled>Edit</button>
                            <button type='button' id="create_game" class="btn btn-primary">Create Game</button>
                            <button type='button' id="start_game" class="btn btn-primary" disabled>Start Game</button>
                            <button type='button' id="start_turn" class="btn btn-primary" disabled>Start Turn</button>
                        </div>
                    </div>
                     Game Status:
                    <div class="well" float="left">
                        <p id="game_status"></p>
                    </div>
                    <div id="turn_status">
                    Turn Status:
                        <div class="well" float="left">
                            <p id="turn_number"></p>
                            <p id="turn_story"></p>
                        </div>
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
                        <div id="game_board_main">
                            <img src="{{asset('/images/boards/theme_odyssey.jpg')}}" width="100%" id="game_board_image">
                        </div>

                        <div id="bottom_cards_set">
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
                            </div>
                        </div>
                    </div>
                    <div id="bottom_game_actions">
                        Actions:
                        <div class="well" float="left">
                            <div id="timer">
                                Timer: <p id="timer_turn"></p>
                            </div>
                            <div id="storyteller_menu">
                                You are the Storyteller, describe your card:<br/>
                                <textarea id="story"></textarea><br/>
                                <button type='button' id="validate_new_turn" class="btn btn-primary" disabled>Validate Card & Story</button>
                            </div>
                                <button type='button' id="validate_card" class="btn btn-primary" disabled>Validate turn</button>
                                <button type='button' id="validate_vote" class="btn btn-primary">Validate vote</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript"> 

var user_id = {{ Auth::user()->id }};

// For debug purpuse
var game_id = 0;
var player_id = 0;
var player_number = 0;
var play_spot = "";
var player_cards_number = 6;
var players_tmp = 0;
var players = [];
var player_owner = 2;
var player_storyteller = 0;
var storyteller_number = 0;
var player_played = [];
var cards_played = [];
var cards_played_tmp = [];
var game_status = "Unknown";
var game_started = false;
var game_created = false;
var game_playing = false;
var game_voting = false;
var timer = 0;
var player_hand = [];
var player_hand_tmp = [];
var storyteller_wait = false;
var turn_number = 0;
var turn_story = "";
var start_turn = false;
var player_hand_numbers = [];
var voted_card = 0;
var cards_played_by_id = [];

// Retrived data from live server
// listen on game_status
// listen on game_started
// listen on game_created
// listen on player_played
// listen on player_storyteller

function first_level_ajax()
{
    $.when(
    $.get( "/play/data/game/"+user_id, function(data) {
        game_id = parseInt(data);
        }),
    $.get( "/play/data/player/"+user_id, function(data) {
        player_id = parseInt(data);
        })
).then(second_level_ajax());
}

function second_level_ajax()
{
    $.when(
        $.get( "/play/data/players/"+game_id, function(data) {
            players_tmp = data;
            }),
        $.get( "/play/data/turn/status/"+game_id, function(data) {
            game_status = data;
            set_game_status(parseInt(game_status));
            }),
        $.get( "/play/data/game/status/"+game_id, function(data) {
            game_created = (parseInt(data)==1);
            })
    ).then(third_level_ajax);
}

function third_level_ajax()
{
    if(game_voting)
    {
        $.when(
            $.get( "/play/data/turn/board/"+game_id, function(data) {
                cards_played_tmp = data;
                }),
            $.get( "/play/data/story/teller/"+game_id, function(data) {
                player_storyteller = parseInt(data);
                }),
            $.get( "/play/data/story/"+game_id, function(data) {
                turn_story = data;
                })
        ).then(forth_level_ajax());
        
    }
    else if(storyteller_wait)
    {
        $.when(
            $.get( "/play/data/story/teller/"+game_id, function(data) {
                player_storyteller = parseInt(data);
                })
        ).then(game_created_level_ajax());
    }
    else if(game_playing)
    {
        $.when(
            $.get( "/play/data/story/"+game_id, function(data) {
                turn_story = data;
                })
        ).then(game_created_level_ajax());
    }
    else if(game_created)
    {
        game_created_level_ajax();
    }
    else
    {
        load_board();
    }
    
}

function forth_level_ajax()
{
    $.each(cards_played_tmp, function(key, value)
    {
        cards_played_by_id.push(value['fk_cards']);
    });

    var ajaxList = [];

    $.each(cards_played_by_id, function(local_card_id)
        {
            ajaxList.push($.get( "/play/data/cards/name/"+local_card_id, function(data) {
                cards_played.push(data);
            }));
        });

    $.when(ajaxList).then(game_created_level_ajax());
    
}

function game_created_level_ajax()
{
    $.when(
        $.get( "/play/data/player/hand/"+game_id+"/"+player_id, function(data) {
            player_hand_tmp = data;
            }),
        $.get( "/play/data/turn/number/"+game_id, function(data) {
            turn_number = parseInt(data);
            })
    ).then(load_board);
}

function load_board()
{
    
    // Computated data
    for (var key in players_tmp) {
        $.each(players_tmp[key], function(key, value) {
          players.push(parseInt(value));
        });
    }
    players.reverse();
    player_number = players.indexOf(player_id);
    play_spot = "spot_card_" + (player_number+1);

    player_owner = players.indexOf(player_owner);

    $.each(player_hand_tmp, function(key, value)
    {
        player_hand.push(value["name"]);
    });

    $.each(player_hand_tmp, function(key, value)
    {
        player_hand_numbers.push(value["pivot"]['fk_cards']);
    });

    //console.log(cards_played)

    // Settup the game board
    $("#title_name").text("{{ trans('board.heading') }} "+turn_number+" as player: "+(player_number+1));
    $("#turn_number").text("Turn Number: "+turn_number);
    $("#turn_story").text("Turn Story: "+turn_story);

    $("#validate_vote").hide();

    for (card in player_hand)
    {
        var hand_card = document.createElement('img');
        var card_id = 'drag_card_'+(parseInt(card)+1);
        hand_card.setAttribute('id',card_id);
        hand_card.setAttribute('src',"{{asset('/images/cards/official/')}}/"+player_hand[card]);
        hand_card.setAttribute('draggable',"true");
        hand_card.setAttribute('ondragstart',"drag(event)");
        document.getElementById('hand_set').appendChild(hand_card); 
    } 

    if((player_number+1) > 6)
    {
        document.getElementById('top_game_hand').appendChild(document.getElementById('bottom_game_hand'));
        document.getElementById('top_game_actions').appendChild(document.getElementById('bottom_game_actions'));
    }

    for(var i=0; i<players.length;i++)
    {
        if((player_number) != i)
        {
            $("#spot_card_"+(i+1)).attr('src', "{{asset('/images/default_avatar/online_green.png')}}");
        }
    }

    if(storyteller_wait || game_voting)
    {
        storyteller_number = players.indexOf(player_storyteller);
        var storyteller_spot = "spot_card_" + (storyteller_number+1); 
        $("#"+storyteller_spot).attr('src', "{{asset('/images/default_avatar/storyteller.png')}}");
    }
    if(game_playing)
    {
        $("#"+play_spot).attr('src', "{{asset('/images/cards/drag_card_here.png')}}");
        $("#"+play_spot).attr('ondrop', 'drop(event)');
        $("#"+play_spot).attr('ondragover', 'allowDrop(event)');

    }
    else if(game_created)
    {
        $("#"+play_spot).attr('src', "{{asset('/images/default_avatar/self.png')}}");

        for(var i=players.length+1; i<=12; i++)
        {
            $("#spot_card_"+i).attr('src', "{{asset('/images/default_avatar/offline_red.png')}}");
        }

        $("#edit_game").attr('disabled',"true");
        $("#create_game").attr('disabled',"true");
        if(!storyteller_wait)
        {
            $("#start_game").removeAttr('disabled');
        }
        $("#top_game_hand").hide();
        $("#bottom_game_hand").hide();
        $("#top_game_actions").hide();
        $("#bottom_game_actions").hide();
        $("#turn_story").hide();
        // $("#start_turn").removeAttr('disabled');
    }
    
    else
    {
        $("#"+play_spot).attr('src', "{{asset('/images/default_avatar/self.png')}}");
        $("#top_game_hand").hide();
        $("#bottom_game_hand").hide();
        $("#top_game_actions").hide();
        $("#bottom_game_actions").hide();
        $("#turn_status").hide();
    }

    if(game_voting)
    {        
        // for(var i=0; i<players.length;i++)
        // {
        //     $("#spot_card_"+(i+1)).attr('src', "{{asset('/images/cards/official')}}"+"/"+cards_played[i]);
        // }

        var game_board_div = document.getElementById("game_board_main");
        game_board_div.setAttribute('style',"position: relative; left: 0; top: 0;");

        var game_board_image_div = document.getElementById("game_board_image");
        game_board_image_div.setAttribute('style',"position: relative; top: 0; left: 0;");
        
        var width_cards = 100/cards_played.length;
        var top_cards = width_cards-10;
        var left_cards = 0;

        for (card in cards_played)
        {
            var vote_card = document.createElement('img');
            var vote_card_id = 'vote_card_'+(parseInt(card)+1);
            vote_card.setAttribute('id',vote_card_id);
            vote_card.setAttribute('src',"{{asset('/images/cards/official/')}}/"+cards_played[card]);
            if(parseInt(storyteller_number) != parseInt(player_number))
            {
                vote_card.setAttribute('onclick',"vote_card_selected("+ card + ", " + width_cards + ", " +top_cards + ", " +left_cards +")");
            }    
            vote_card.setAttribute('style',"position: absolute; top: "+top_cards+"%; left: "+left_cards+"%; width: "+width_cards+"%; margin-left: -1%; cursor:pointer;");
            document.getElementById('game_board_main').appendChild(vote_card); 
            left_cards += (width_cards+1);
        } 

        if(parseInt(storyteller_number) == parseInt(player_number))
        {
            $("#game_status").text("You are the storyteller, players must vote a carte based on your story.");
        }
        else
        {
            var vote_card_selection = document.createElement('img');
            vote_card_selection.setAttribute('id',"vote_card_selection");
            vote_card_selection.setAttribute('src',"{{asset('/images/cards/')}}/"+"selected_card.png");
            document.getElementById('game_board_main').appendChild(vote_card_selection); 
            $("#vote_card_selection").hide();
        }

    }

    // console.log(storyteller_number);
    // console.log(player_number);

    if((parseInt(storyteller_number) != parseInt(player_number)) || (game_status != 10))
    {
        $("#turn_story").show();
        $("#storyteller_menu").hide();
    }
    else
    {
        $("#"+play_spot).attr('src', "{{asset('/images/cards/drag_card_here.png')}}");
        $("#"+play_spot).attr('ondrop', 'drop(event)');
        $("#"+play_spot).attr('ondragover', 'allowDrop(event)');
        $("#top_game_hand").show();
        $("#bottom_game_hand").show();
        $("#top_game_actions").show();
        $("#bottom_game_actions").show();
        $("#validate_card").hide();
    }

    if(player_number != player_owner)
    {
        $("#administration_panel").hide();
    }


    if(timer == 0)
    {
        $("#timer").hide();
    }

    $('#loading').remove();

}


// On page load
$(document).ready(function(){ 
    $.ajaxSetup({async:false});
    first_level_ajax();  
    $imageRatio = 500/330;
    resize_height_cards();
    $( window ).resize(function() {
        resize_height_cards();
    });

    $("#create_game").click(function(){
        $.get( "/play/action/create/"+game_id, function(data) {
            location.reload();
        })
    });

    $("#start_game").click(function(){
        $.get( "/play/action/start/"+game_id, function(data) {
        }),
        $.get( "/play/action/new/turn/"+game_id, function(data) {
            location.reload();
        })
    });

    $("#start_turn").click(function(){
        $.get( "/play/action/new/turn/"+game_id, function(data) {
            location.reload();
        })
    });

    $("#validate_new_turn").click(function(){
        if($("#story").val() != "")
        {
            var source = document.getElementById(play_spot).src;
            source = source.replace("{{asset('/images/cards/official/')}}"+"/", ""); 
            var card_position = player_hand.indexOf(source);
            console.log(player_hand_numbers[card_position])
            $.get( "/play/action/tell/"+game_id+"/"+player_id+"/"+player_hand_numbers[card_position]+"/"+$("#story").val(), function(data) {
                location.reload();
            })
        }
    });

    $("#validate_card").click(function(){
        var source = document.getElementById(play_spot).src;
        source = source.replace("{{asset('/images/cards/official/')}}"+"/", ""); 
        var card_position = player_hand.indexOf(source);
        console.log(player_hand_numbers[card_position])
        $.get( "/play/action/choose/card/"+game_id+"/"+player_id+"/"+player_hand_numbers[card_position]+"/"+$("#story").val(), function(data) {
            location.reload();
        })
    });

    $("#validate_vote").click(function(){
        var source = document.getElementById(play_spot).src;
        source = source.replace("{{asset('/images/cards/official/')}}"+"/", ""); 
        var card_position = player_hand.indexOf(source);
        $.get( "/play/action/vote/"+game_id+"/"+player_id+"/"+cards_played_by_id[voted_card], function(data) {
            $("#validate_vote").hide();
            $("#validate_vote").hide();
            $("#bottom_game_actions").hide();
            $("#game_status").text("We are waiting on the other players to vote.");
        })
    });

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

    $("#validate_card").removeAttr('disabled');
    $("#validate_new_turn").removeAttr('disabled');

}
  
// Design of the cards on board
function resize_height_cards(){
    $imageHeight = $(".card_on_board").width()*$imageRatio;
    $(".card_on_board").css('height', $imageHeight + 'px');
}

function game_loader(){
    var loading = document.createElement('div');
    var loading_id = "loading";
    loading.setAttribute('id',loading_id);
    document.getElementById('loading_spot').appendChild(loading);
}

function vote_card_selected(vote_card_id, width_cards, top_cards, left_cards){
    voted_card = vote_card_id;
    $("#vote_card_selection").show();
    vote_card_selection.setAttribute('style',"position: absolute; top: "+top_cards+"%; left: "+left_cards+"%; width: "+width_cards+"%; margin-left: -1%; cursor:pointer; z-index: 3");
    $("#bottom_game_actions").show();
    $("#validate_vote").show();
    $("#validate_card").hide();
    
}

function set_game_status(game_state){
    //console.log(game_state);
    switch (game_state)
    {
        case 10:
            $("#game_status").text("We are waiting on the storyteller.");
            storyteller_wait = true;
            // console.log("");
            break;

        case 20:
            $("#game_status").text("Players must choose a card based on the story.");
            game_playing = true;
            // console.log("");
            break;

        case 30:
            $("#game_status").text("Players must vote a carte based on the story. Cards have been shuffle. ;)");
            game_voting = true;
            // console.log("");
            break;

        case 40:
            $("#game_status").text("Points have been updated.");
            game_playing = true;
            // console.log("");
            break;

        default:
            console.log("Game is not created or started");
    }
}

</script>

@endsection


