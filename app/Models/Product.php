<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    // use Sluggable;

    protected $fillable = [
        'title', 
        'slug', 
        'code', 
        'price', 
        'discount', 
        'smallDescription', 
        'description', 
        'imageOne', 
        'imageTwo', 
        'imageThree'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // public function cart()
    // {
    //     return $this->belongsTo(Cart::class);
    // }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function scopeWithFilters($query)
    {
        return $query->when(count(request()->input('categories', [])), function ($query) {
            $query->whereIn('category.id', request()->input('categories'));
        });
    }
    
}
