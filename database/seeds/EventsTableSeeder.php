<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	     DB::table('events')->insert([
 						           	    ['name'   => 'October Fest',
  					                     'date'   => '28-10-2019',
 			  		                     'artist' => 'U2'  
 						           	    ],
 
 				    			     	['name'   => 'Halloween',
 						                 'date'   => '31-10-2019',
 				  		                 'artist' => 'Red Hot Chili Peppers'  
 						           		],
 
 						           		['name'   => 'Thanksgiving',
 						                 'date'   => '28-11-2019',
 				  		                 'artist' => 'Cold Play'  
 						           		]
 						           	]);

    }
}
