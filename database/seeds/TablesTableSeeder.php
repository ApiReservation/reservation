<?php

use Illuminate\Database\Seeder;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     public function run()
    {
          
	    DB::table('tables')->insert([ 
					           	    ['table_no'    => '1',
				                     'table_desc'  => '6 seats are available'
					           	    ],

			    			     	['table_no'    => '2',
				                     'table_desc'  => '4 seats are available'
					           	    ],
									
									['table_no'    => '3',
				                     'table_desc'  => '8 seats are available'
					           	    ]]

		        				   );
	}

}
