<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DemoRole extends Model
{
    protected $fillable = [

              'name'         
    ];

    public function demoPermission(){

        return $this->hasMany(DemoPermission::class);
    }
}