<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model {
    use HasFactory;

    protected $table = "todos";

    protected $guarded = [
        'id',
        'timestamps'
    ];

    public function diffStatus(){
        if(Carbon::parse($this->deadline)->isToday() && Carbon::parse($this->deadline)->gt(Carbon::now())){
            return 'today';
        }else if(Carbon::parse($this->deadline)->gt(Carbon::now())){
            return 'future';
        } else {
            return 'past';
        }
    }
    
    public function diff() {
        if (is_null($this->deadline)) {
            return;
        }
        if(Carbon::parse($this->deadline)->isToday()){
            return "Today, " . Carbon::createFromTimestamp(strtotime($this->deadline))->diffForHumans();

        }else if(Carbon::parse($this->deadline)->isTomorrow()){
            $tomorrows_time = Carbon::createFromTimestamp(strtotime($this->deadline));
            $tomorrows_time->settings([
                'toStringFormat' => 'g:i A'
            ]);
            return "Tomorrow, " . $tomorrows_time;
            
        }else if(Carbon::parse($this->deadline)->isYesterday()){
            $yesterdays_time = Carbon::createFromTimestamp(strtotime($this->deadline));
            $yesterdays_time->settings([
                'toStringFormat' => 'g:i A'
            ]);
            return "Yesterday, " . $yesterdays_time;
        }
        return Carbon::createFromTimestamp(strtotime($this->deadline))->diffForHumans();
    }

    public function todolist() {
        return $this->belongsTo(Todolist::class);
    }
}
