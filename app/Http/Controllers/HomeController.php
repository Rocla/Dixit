<?php 

namespace Dixit\Http\Controllers;

use Dixit\Card;

/**
 * Description of HomeController
 *
 * @author claudiag.gheorghe
 */

class HomeController extends Controller
{
    protected $cards;
    
    public function __construct(Card $cards)
    {     
        $this->cards=$cards;
        $this->middleware('auth');
    }   
    
    public function getIndex()
    {       
        return view('welcome')->with('cards', $this->cards->all());
        
    }
    
}
