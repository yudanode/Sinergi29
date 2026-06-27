<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{
    protected $table = 'portfolio_categories';

    protected $fillable = ['category_name'];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class, 'category_id');
    }
}
