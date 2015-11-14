<?php 

namespace App\Http\Controllers;
use App\Card;

/**
 * Description of HomeController
 *
 * @author claudiag.gheorghe
 */

class HomeController extends Controller
{
    protected $cards;
    
    public function __construct(Card $_cards)
    {     
        $this->cards=$_cards;
    }   
    
    public function getIndex()
    {       
        return view('welcome')
               ->with('cards', $this->cards->all());
        \DebugBar::error("error");
    }
    
}
