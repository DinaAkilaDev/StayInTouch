<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'date',
        'text',
        'type',
        'video',
        'user_id'
    ];
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function Contacts()
    {
        return $this->belongsToMany(Contact::class, 'event_contacts');
    }
}
