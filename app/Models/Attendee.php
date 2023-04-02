<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Attendee extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'attendees';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'attendee_id',
        'attendee_email',
        'meeting_id',
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



    public function meeting(){
        return $this->belongsTo(Meeting::class, 'meeting_id', 'id');
    }
    
    public function user(){
        return $this->belongsTo(User::class, 'attendee_id', 'id');
    }
}
