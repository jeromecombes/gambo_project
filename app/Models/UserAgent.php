<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAgent extends Model
{
    use HasFactory;

    public $table = "user_agents";

    protected $fillable = [
        'user_id',
        'ip',
        'agent',
        'updated_at',
    ];
}
