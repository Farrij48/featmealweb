<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    public $table = "kelasonline.pasien";

    protected $fillable = [
        'email',
        'password',
        'name',
        'status',
        'gender',
        'phone',
        'nik',
        'address',
        'gejala',
        'diagnosis',
        'avatar'
    ];
}