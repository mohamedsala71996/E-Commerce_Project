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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    use FileMethods;

    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;

        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        return Product::with('store:id,name', 'category:id,name', 'tags:id,name')->filter($request->query())->get();
    }

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
            $user = $request->user();
            if (!$user->tokenCan('products.store')) {
                return response()->json(['message' => 'user not allowed'], 403);
            }
            $data = array_merge($request->except('image', 'tags'), ['slug' => Str::slug($request->name)]);
            $imagePath = $request->file('image') ? $request->file('image')->storeAs('ProductPhotos', $data['slug'] . "Product" . $request->file('image')->getClientOriginalName(), 'public') : '';
            $product = $this->productRepository->createProduct(array_merge($data, ['image' => $imagePath]));
            $tags = explode(',', $request->tags);
            $tag_ids = [];
            foreach ($tags as $tag_name) {
                $slug = Str::slug($tag_name);
                $tag = Tag::updateOrCreate(['name' => $tag_name, 'slug' => $slug]);
                $tag_ids[] = $tag->id;
            }
            $product->tags()->attach($tag_ids);
            return response()->json(['message' => 'Data saved successfully', 'data' => $product], 201, [
                'location' => route('products.show', $product->id)
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to save data', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(Product $product)
    {
        return $product->load('store:id,name', 'category:id,name', 'tags:id,name');
    }

    public function update(Request $request, Product $product): JsonResponse
    {
        try {
            $request->validate([
                'store_id' => 'nullable|exists:stores,id',
                'category_id' => 'nullable|exists:categories,id',
                'name' => 'sometimes|required|string|max:255|unique:products,name,' . $product->id,
                'description' => 'nullable|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'price' => 'sometimes|required|numeric|min:0',
                'compare_price' => 'nullable|numeric|gt:price', //greater than price
                'options' => 'nullable|json',
                'rating' => 'numeric|min:0|max:5',
                'featured' => 'boolean',
                'status' => 'sometimes|required|in:active,archived,draft',
            ]);
            $user = $request->user();
            if (!$user->tokenCan('products.update')) {
                return response()->json(['message' => 'user not allowed'], 403);
            }
            $data = array_merge($request->except('image', 'tags'), ['slug' => Str::slug($request->name)]);
            if ($request->hasFile('image')) {
                $this->deleteFile($product->image);
                $imagePath = $request->file('image')->storeAs('ProductPhotos', $data['slug'] . "_Product_" . $request->file('image')->getClientOriginalName(), 'public');
            } elseif (!$request->hasFile('image') && $product->image) {
                $imagePath = $product->image;
            } else {
                $imagePath = '';
            }
            $product->update(array_merge($data, ['image' => $imagePath]));
            $tags = explode(',', $request->tags);
            $tag_ids = [];
            $saved_tags = Tag::all();
            foreach ($tags as $tag_name) {
                $slug = Str::slug($tag_name);
                $tag = $saved_tags->where('slug', $slug)->first();
                if (!$tag) {
                    $tag = Tag::create(['name' => $tag_name, 'slug' => $slug]);
                }
                $tag_ids[] = $tag->id;
            }
            $product->tags()->sync($tag_ids);
            return response()->json(['message' => 'Data updated successfully', 'data' => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update data', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Product $product): JsonResponse
    {
        try {
            $user = Auth::guard('sanctum')->user();
            if (!$user->tokenCan('products.destroy')) {
                return response()->json(['message' => 'user not allowed'], 403);
            }
            $product->delete();
            $this->deleteFile($product->image);
            return response()->json(['message' => 'Data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete data', 'message' => $e->getMessage()], 500);
        }
    }
}
