<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'post';
    protected $primaryKey = 'idpost';
    protected $keyType = 'integer';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'content',
        'date',
        'username'
    ];
    protected $appends = [
        'date_f',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function getDateFAttribute()
    {
        return date('d M Y', strtotime($this->date));
    }
}
