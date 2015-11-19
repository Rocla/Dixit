@extends('base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                    @if(count($games)!=1)                         
                        <div class="panel-heading">Create new game</div>
                        <div class="panel-body">                          
                                <form action="games">                                    
                                    Give a name:
                                    <input type="text" name="name" value="test">
                                    Choose the language of the game: 
                                    <select name="lang">
                                        <option value="Fr">Franch</option>
                                        <option value="En">English</option>
                                        <option value="Dr">Deuch</option>
                                    </select>
                                    <input type="submit" value="Send">
                                </form>    
                                                          
                        </div>                        
                    @else
                        <div class="panel-heading">List of games:</div>
                        <div class="panel-body">List of games
                            
                        </div>
                    @endif                   
               
            </div>
        </div>
    </div>
</div>

@endsection
