<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;

use Validator;
Use App\Table; 
Use App\Reservation; 
Use App\Event; 


class TableController extends Controller
{

	protected $user;
 
	public function __construct()
	{
	    $this->user = JWTAuth::parseToken()->authenticate();
	}

    public function getAvailableTables(Request $request) {

        

		 $validator = Validator::make($request->all(), [ 
		        'event' => 'required|integer', 
		        'date'  => 'required'
        ]);
		if ($validator->fails()) { 
    		 return response()->json($validator->errors(), 422); 
        }

		$whereData   = ['event_id'=>$request->event ,'date'=>$request->date];

		$event= Event::where('id','=',$request->event)
										 ->where('date','=',$request->date)
										 ->first();

		if(empty($event)){

			 return response()->json([ 'success' => false,
				                       'message' => 'No events fount'
				       			 ]);
		}

		
		$reservation = Reservation::select('table_id')->where('event_id','=',$request->event)
												->where('date','=',$request->date)->get();
		
        $tables = Table::select('id', 'table_no','table_desc')->whereNotIn('id', $reservation)->get();
		
     	
        
          if($tables)  
          	return response()->json([ 'success' => true,
				                      'tables' => $tables
				       				]);
           else 
           	return response()->json([ 'success' => false,
				                      'tables' => 'There are no available tables'
				       				], 400);
		
 
	 
    }
}
