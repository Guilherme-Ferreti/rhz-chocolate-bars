<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChocolateBar extends Model
{
    use HasFactory;

    protected $fillable = ['weight', 'code'];

    public function cocoa_batches()
    {
        return $this->belongsToMany(CocoaBatch::class)
                    ->withPivot('grams')
                    ->withTimestamps();
    }
}
