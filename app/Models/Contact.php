<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'email',
        'photo',
        'name',
'user_id'
    ];
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function Events()
    {
        return $this->belongsToMany(Event::class, 'event_contacts');
    }
}
