<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use JWTAuth;

class EventController extends Controller
{
    protected $user;
 
	public function __construct()
	{
	    $this->user = JWTAuth::parseToken()->authenticate();
	}

	public function index()
	{ 

			$event = Event::all(); 
			
		    if (empty($event))  
		       
		        return response()->json([ 'success' => false,
							              'message' => 'Sorry, there are no available events'
							       		], 400);
		    
		 
		    return response()->json([$event]);
		 
	}
}
