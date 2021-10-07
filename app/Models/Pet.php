<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'area',
        'fix',
        'description',
        'age',
        'user_id',
    ];

    /**
     * 取得動物刊登者
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    /**
     * 取得收藏
     */
    public function wishlist()
    {
        return $this->belongsToMany('App\Models\User', 'wishlist')->withTimestamps();
    }
}
