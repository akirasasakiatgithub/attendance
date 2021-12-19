<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [
        'id_a',
        'created_at',
        'date',
        'start_working',
        'end_working',
    ];

    protected $fillable = [
        'update_at',
    ];

    /*public function user(){
        return $this->belongsTo('App\Models\User');
    }*/
}
