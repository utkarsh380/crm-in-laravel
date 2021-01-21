<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DemoPermission extends Model
{
    protected $fillable = [
        'name'
                       
    ];

    public function demoRole(){
            return $this->belongsTo(DemoRole::class);
    }
}