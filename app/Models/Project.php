<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case 0 : return 'open';
            case 1 : return 'closed';
            default : return 'unknown';
        }
    }

    public function getProductAttribute()
    {
        return Product::findOrNew($this->product_id)->name;
    }
}
