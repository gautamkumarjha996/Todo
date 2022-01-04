<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasklist extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'status',
       
    ];
    public function user(){
        return $this->hasOne(User::class,'id','user_id');//Eloquent orm base  join
    }
}
