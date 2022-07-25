<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class application extends Model
{
    use HasFactory;
    protected $table="applications";
    protected $fillable=[
        'id',
        'Nom_application',
        'AppCode'
    ];
}
