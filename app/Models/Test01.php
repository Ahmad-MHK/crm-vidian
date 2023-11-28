<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test01 extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        "Bedrijf_user",
        "Domain",
    ];
}
