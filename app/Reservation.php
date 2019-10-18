<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Table;
use App\Event;

class Reservation extends Model
{
    
   protected $fillable = ['table_id' ,'event_id' ,'date'];

   
   // public function tables()
   // {
   //      return $this->hasMany(Table::class);
   // }

   // public function events()
   // {
   //      return $this->hasMany(Event::class);
   // }
}
