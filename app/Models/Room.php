<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable=[
        'title','description'
    ];
    public function roomFacilities(){
        return $this->hasMany(RoomFacility::class,'room_id','id');
    }
}
