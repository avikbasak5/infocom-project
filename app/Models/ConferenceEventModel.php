<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceEventModel extends Model
{
    protected $table = 'event';
    protected $fillable = ['conference_id','event_date','event_day','event_title','event_venue','rank'];
}