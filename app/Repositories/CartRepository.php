<?php

namespace App\Repositories;

use App\Interfaces\CartRepositoryInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartRepository implements CartRepositoryInterface
{

  protected $items;

  public function __construct()
  {
    $this->items = collect([]);
  }
  public function get(): Collection
  {
    if (!$this->items->count()) {
      $this->items = Cart::with('product')->get();
    }
    return  $this->items;
  }
  public function add($product_id, $quantity = 1)
  {
    $item = Cart::where('product_id', $product_id)->first();
    if (!$item) {
      $cart = Cart::create([
        'user_id' => Auth::id(),
        'product_id' => $product_id,
        'quantity' => $quantity,
      ]);
      $this->get()->push($cart);
      return $cart;
    }
    return $item->increment('quantity', $quantity);
  }

  public function update($id, $quantity = 1)
  {
    Cart::where('id', $id)
      ->update([
        'quantity' => $quantity,
      ]);
  }

  public function delete($id)
  {
    Cart::where('id', $id)
      ->delete();
  }

  public function empty()
  {
    Cart::query()->delete();
  }

  public function total(): float
  {
    return $this->get()->sum(function ($items) {
      return $items->quantity * $items->product->price;
    });
  }

  protected function getCookieId()
  {
    $cookie_id = Cookie::get('cart_id');
    if (!$cookie_id) {
      $cookie_id = Str::uuid();
      Cookie::queue('cart_id', $cookie_id, 30 * 24 * 60);
    }
    return  $cookie_id;
  }
}
