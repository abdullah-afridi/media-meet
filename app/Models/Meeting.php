<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Meeting extends Model
{
    protected $table = 'meetings';
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'subject',
        'date_time',
        'created_by_id',
        'updated_by_id',
    ];

    protected static function boot()
    {
        parent::boot();

        // Create a new record in the database when the model is created
        static::creating(function ($model) {
            $model->created_by_id = auth()->user()->id;
        });

        // Update an existing record in the database when the model is updated
        static::updating(function ($model) {
            $model->updated_by_id = auth()->user()->id;
        });
    }


    public function user(){
        return $this->hasOne(User::class, 'id', 'created_by_id');
    }
    public function attendees(){
        return $this->hasMany(Attendee::class, 'meeting_id', 'id');
    }
}
