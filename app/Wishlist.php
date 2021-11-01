<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wishlist extends Model
{
    use HasFactory;

    public static function countWishList($product_id){
        $countWishList = WishList::where(['user_id' => Auth::user()->id, 'product_id' => $product_id])->count();
        return $countWishList;
    }

    public static function userWishlistItems(){
        $userWishlistItems = Wishlist::with(['product' => function($query){
            $query->select('id', 'product_name', 'product_code', 'product_color', 'product_price', 'main_image');
        }])->where('user_id', Auth::user()->id)->orderBy('id', 'Desc')->get()->toArray();
        return $userWishlistItems;
    }

    public function product(){
        return $this->belongsTo('App\Product', 'product_id');
    }
}
