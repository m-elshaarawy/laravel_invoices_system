<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sections extends Model
{
    use HasFactory;
    protected $fillable=[
        'section_name',
        'description',
        'created_by',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Products::class,'section_id');
    }
}
