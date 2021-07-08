<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CocoaBatch extends Model
{
    use HasFactory;

    const PROVIDERS = [
        'rzm_kakau' => 'RZM Kakau', 
        'rzm_organic' => 'RZM Organic', 
        'rzm_foods_brasil' => 'RZM Foods Brazil'
    ];
    
    const ORIGINS = [
        'organic' => 'Organic', 
        'preprocessed' => 'Preprocessed'
    ];

    protected $fillable = ['description', 'provider', 'origin'];

    public function chocolate_bars()
    {
        return $this->belongsToMany(ChocolateBar::class)->withPivot('grams')->withTimestamps();
    }
}
