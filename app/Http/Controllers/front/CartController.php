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
       $items= $this->cartRepository->get();
       $total= $this->cartRepository->total();
       return view('front.cart.index',compact('items','total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id', 
            'quantity' => 'required|integer|min:1', 
        ]);
        $this->cartRepository->add($request->product_id,$request->quantity);
        return redirect()->route('carts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1', 
        ]);
        $this->cartRepository->update($id,$request->quantity);
        return redirect()->route('carts.index');   
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->cartRepository->delete($id);
    }
}
