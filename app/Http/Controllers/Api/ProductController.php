<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\Tag;
use App\Traits\FileMethods;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    use FileMethods;

    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function index(Request $request)
    {
        return Product::filter($request->query())->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'store_id' => 'nullable|exists:stores,id',
                'category_id' => 'nullable|exists:categories,id',
                'name' => 'required|string|max:255|unique:products,name',
                'description' => 'nullable|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'price' => 'required|numeric|min:0',
                'compare_price' => 'nullable|numeric|gt:price', //greater than price
                'options' => 'nullable|json',
                'rating' => 'numeric|min:0|max:5',
                'featured' => 'boolean',
                'status' => 'required|in:active,archived,draft',
            ]);
            $data = array_merge($request->except('image', 'tags'), ['slug' => Str::slug($request->name)]);
            $imagePath = $request->file('image') ? $request->file('image')->storeAs('ProductPhotos', $data['slug'] . "Product" . $request->file('image')->getClientOriginalName(), 'public') : '';
            $product = $this->productRepository->createProduct(array_merge($data, ['image' => $imagePath]));

            $tags = explode(',', $request->tags);
            $tag_ids = [];
            foreach ($tags as $tag_name) {
                $slug = Str::slug($tag_name);
                $tag = Tag::updateOrCreate([
                    'name' => $tag_name,
                    'slug' => $slug
                ]);
                $tag_ids[] = $tag->id;
            }
            $product->tags()->attach($tag_ids);
            return response()->json(['message' => 'Data saved successfully', 'data' => $product], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to save data', 'message' => $e->getMessage()], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
