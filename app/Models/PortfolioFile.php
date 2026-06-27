<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class PortfolioFile extends Model
{
    protected $table = 'portfolio_files';

    protected $fillable = ['portfolio_id', 'file_path', 'file_type'];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
