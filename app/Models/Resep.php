<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resep extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = "kelasonline.resep";

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'description',
        'group',
        'kalori',
        'thumbnail',
        'deleted_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}