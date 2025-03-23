<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';
    
    public $timestamps = false;

    protected $fillable = [
        'titol',
        'cos',
        'image',
        'creado_el',
        'modificado_el',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
