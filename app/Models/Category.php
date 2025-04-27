<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'status',
    ];
    public function expense()
    {
        return $this->hasMany(Expense::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
