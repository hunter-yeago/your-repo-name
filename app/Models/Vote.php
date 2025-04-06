<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    // The table associated with the model (if different from the plural form of the model name)
    protected $table = 'votes';

    // The attributes that are mass assignable
    protected $fillable = ['option_name', 'vote_count'];
}
