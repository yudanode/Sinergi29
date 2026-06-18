<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(PortfolioCategory::class, 'category_id');
    }

    public function files()
    {
        return $this->hasMany(PortfolioFile::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
