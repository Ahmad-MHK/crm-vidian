<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test01 extends Model
{
    use HasFactory;

    protected $fillable = [
        'bedrijfsNaam',
        'debiteurnaam',
        "Bedrijf_user",
        "Kvk",
        "Btw",
        "Db",
        'Email',
        'Domain',
        'Phone',
        'UserName',
        'Password',
        'InlogNaam',
        "Notes",
        "Note",
        'Algemeen',
        'LogBoek',
        'inlogGegevens',
        'Contactpersonen',
    ];

    protected $casts = [
        'inlogGegevens' => 'json',
        'Note' => 'json',
    ];

}
