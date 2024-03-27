<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\CartRepositoryInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private CartRepositoryInterface $cartRepository;
    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    public function index()
    {
        $items = $this->cartRepository->get();
        $total = $this->cartRepository->total();
        return view('front.cart.index', compact('items', 'total'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $this->cartRepository->add($request->product_id, $request->quantity);
        return redirect()->route('carts.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        $this->cartRepository->update($id, $request->quantity);
        return redirect()->route('carts.index');
    }

    public function destroy($id)
    {
        $this->cartRepository->delete($id);
    }
}
