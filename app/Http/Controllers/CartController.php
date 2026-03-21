<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charger;

class CartController extends Controller
{
    public function add(Request $request, Charger $charger)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if(isset($cart[$charger->id])) {
            $cart[$charger->id]['quantity'] += $quantity;
        } else {
            $cart[$charger->id] = [
                "id" => $charger->id,
                "name" => $charger->name,
                "quantity" => $quantity,
                "price" => (float)str_replace(['RM', ',', ' '], '', $charger->price),
                "image" => $charger->image_url ?: asset('storage/ev_charger_product_1773856128972.png')
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!')->with('open_cart', true);
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, $request->input('quantity', 1));
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Cart updated successfully!')->with('open_cart', true);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Product removed from cart successfully!')->with('open_cart', true);
    }
}
