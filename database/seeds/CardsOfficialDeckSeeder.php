<?php

use Illuminate\Database\Seeder;
use Dixit\Card;
use Dixit\Deck;

class CardsOfficialDeckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $deck = new Deck();
        $deck->name = 'official';
        $deck->save();
                        
        $file =__DIR__.'/../../public/images/cards/official/';
        
        foreach( new DirectoryIterator($file) as $file) {
            if( $file->isFile() === TRUE && $file->getFilename() != ".DS_Store" && $file->getFilename() != ".Thumbs" ) {    
                $this->command->info($file->getFilename());            
                $card = new Card();
                $card->fk_decks = $deck->pk_id;
                $card->name = htmlentities($file->getFilename());
                $card->save();
            }
        }
    }
}
