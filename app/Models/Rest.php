<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    protected $guarded = [
        'id_r',
        'created_at',
        'start_break',
        'end_break',
    ];

    protected $fillable = [
        'update_at',
    ];

    public function attendance()
    {
        return $this->belongsTo('App\Models\User');
    }
}
