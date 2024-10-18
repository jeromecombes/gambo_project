<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'option_id',
    ];

    public function scopeWithOptions($query)
    {
        $query->leftjoin('options', 'options.id', '=', 'project_options.option_id')
            ->addSelect([
                'options.id as id',
                'options.order as option_order',
                'options.value as option_value'
            ]);
    }

}
