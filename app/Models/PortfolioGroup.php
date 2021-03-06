<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Portfolio;

class PortfolioGroup extends Model
{
    use HasFactory;
    protected $table = 'groups_portfolios';

    protected $fillable = [
        'title',
        'active'
    ];

    public function portfolios() {

        return $this->belongsToMany(Portfolio::class);
    }
}
