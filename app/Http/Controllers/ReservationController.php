<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\Event;
use Validator;
use App\Reservation;

class ReservationController extends Controller
{
   protected $user;
 
	public function __construct()
	{
	    $this->user = JWTAuth::parseToken()->authenticate();
	}


	public function index()
	{ 
	    return $this->user
	        ->resevations()
	        ->get(['event_id' ,'date'])
	        ->toArray();
	}

	public function store(Request $request)
	{


		$validator = Validator::make($request->all(), [ 
	     							'table' => 'required|integer',
							        'event' => 'required|integer'
							        'date'  => 'required'
		         
        ]);

		if ($validator->fails()) { 
    		 return response()->json($validator->errors(), 422); 
        }

		$condition = ['id'=>$request->event];
	    $event     = Event::where($condition)->first();
		
	    
	    if(!$event) 
	    	return response()->json([ 'success' => false,
							          'message' => 'Sorry, event does not exist'
						       		], 500);


	    $reservation = Reservation::where('event_id','=',$request->event)
								   // ->where('date','=',$request->date)
								   ->where('table_id','=',$request->table)
								   ->first();

		if($reservation)  return response()->json([ 'success' => false,
							           'message' => 'Sorry, table no '.$request->table.' is booked already'
							         ], 500);

	    $reservation = Reservation::where('user_id','=',$this->user->id)
								   ->where('table_id','=',$request->date)
								   ->where('event_id','=',$request->event)
								   ->first();
	    
	    if(!empty($reservation)){
	    	 return response()->json([ 'success' => false,
							           'message' => 'Sorry, you already have made a reservation'
							         ], 500);
	    }

	    $reservation = new Reservation;
	    $reservation->table_id = $request->table;
	    $reservation->event_id = $request->event;
	    $reservation->date = $request->date;
	 
	    if ($this->user->reservations()->save($reservation))
	        return response()->json([
						            'success' => true,
						            'message' => 'Your reservation was successfully created!',
						            'reservation' => $reservation
						        	]);
	    else
	        return response()->json(['success' => false,
						             'message' => 'Sorry, you could not make a reservation'
						        	], 500);
	}

		
	public function destroy(Request $request){
		
		$validator = Validator::make($request->all(), 
					['event' => 'required|integer' ]);

		if ($validator->fails()) { 
    		 return response()->json($validator->errors(), 422); 
        }
 
	    $event = Event::where('id','=',$request->event)->first();
	    if(!$event) 
	    	return response()->json([ 'success' => false,
							          'message' => 'Sorry, event does not exist'
						       		], 500);
	    $reservation = Reservation::where('user_id','=',$this->user->id) 
								   ->where('event_id','=',$request->event)
								   ->first();
		if(!$reservation) 
	    	return response()->json([ 'success' => false,
							          'message' => "You don't have a reservation"
						       		], 500);
		else {

			$reservation->delete();
			return response()->json([ 'success' => true,
							          'message' => 'You reservation has been cancelled successfully '
						       		]);
		}				       								   


	}


}
