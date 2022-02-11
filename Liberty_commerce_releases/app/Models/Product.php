<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'user_id',
        'picture',
        'product_description',
        'product_price',
        'product_type',
        'product_quantity',
    ];
    /**
     * Get the phone associated with the user.
     */
    public function seller()
    {
        return $this->belongsto(User::class, 'user_id');
    }
}
