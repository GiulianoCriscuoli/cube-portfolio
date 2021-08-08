<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PortfolioGroup;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'active',
        'short_description',
        'url',
        'image'
    ];
}
