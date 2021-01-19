<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Lead extends Model
{
    protected $fillable = [
        'title',
        'clientName',
        'clientEmail',
        'leadSource',
        'leadStatus',
        'generatedBy',
        'salesPerson',
        'address',
        'country',
        'phone',
        'organization',
        'leadType',
        'description',
        'city',
        'state',
                
    ];
}
