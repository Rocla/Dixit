@extends('base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-primary">
                    @if($games->isEmpty())                         
                        <div class="panel-heading">{{ trans('gamelist.heading') }}</div>

                            <div class="panel-body">                          
                                <form action="{{ url('/games') }}" method="POST"> 
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{ trans('gamelist.gamename') }}:</label>					                                    
                                        <input type="text" name="name" value="test">                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{ trans('gamelist.language') }}:</label>					                                    
                                        <select name="language">
                                            <option value="fr">{{ trans('gamelist.french') }}</option>
                                            <option value="en">{{ trans('gamelist.english') }}</option>
                                            <option value="de">{{ trans('gamelist.german') }}</option>
                                        </select>                                       
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{ trans('gamelist.player_number') }}:</label>					                                    
                                        <input type="number" name="no_players" value="3" min="3" max="12">                                   
                                    </div>  
                                    <input class="btn btn-primary pull-right" type="submit" value="{{ trans('gamelist.send') }}">
                                </form>                                                      
                            </div>                        
                    @else

                        <div class="panel-heading">List of games:</div>                           
                            @foreach($games as $game) 
                                <div class="panel-body">
                                    <div class="col-md-8 col-md-offset-5"> <strong>Game: {{$game->name}}</strong> </div>
                                    <div class="col-md-8 col-md-offset-4">Language: {{$game->language }},    
                                        <strong>  {{$game->no_players }}  </strong> players required
                                    </div> 
                                    <div class="col-md-8 col-md-offset-5">
                                        <input id="join" class="btn btn-primary" type="submit"  value="{{trans('gamelist.join')}}" onClick="" >
                                    </div>  
                                </div>
                            @endforeach                 
                        </div>                       


                    @endif                   
               
            </div>
        </div>
    </div>
<script type="text/javascript">
    
</script>
@endsection
