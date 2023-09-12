<?php

namespace App\Http\Managers;

use App\Models\Cart;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;



class CartManager
{
    public static function addItemToCart(int $user_id, array $product_ids) : bool
    {
        $insertableData = [];
        foreach($product_ids as $product_id) {
            //checks if product already added to the cart for a particular user
            $checkCart = Cart::where('user_id', $user_id)->where('product_id', $product_id)->first();
            if (!$checkCart){
                $insertableData[] = [
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
           
        }
        if (count($insertableData) > 0) {
            Cart::insert($insertableData);
            return true;
        }
        return false;
    }

    public static function delete($user_id) : bool
    {
       return (bool) Cart::where('user_id', $user_id)->delete();
    }
}