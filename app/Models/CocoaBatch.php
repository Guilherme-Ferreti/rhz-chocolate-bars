<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CocoaBatch extends Model
{
    use HasFactory;

    const PROVIDERS = ['RZM Kakau', 'RZM Organic', 'RZM Foods Brazil'];
    const ORIGINS = ['Organic', 'Preprocessed'];

    protected $fillable = ['description', 'provider', 'origin'];
}
