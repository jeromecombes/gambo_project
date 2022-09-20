<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'order', 'date', 'start', 'end'];

    public static function getCurrents() {

        global $semester;
        $semester = substr(session('semester'), -4) . (substr(session('semester'), 0, 6) == 'Spring' ? 1 : 2);

        return Partner::where('start', '<=', $semester)
            ->where(function ($query) {
                $query->where('end', '=', 0)
                    ->orWhere('end', '>=', $GLOBALS['semester']);
           })
           ->orderBy('order')
	   ->get();
    }
}
