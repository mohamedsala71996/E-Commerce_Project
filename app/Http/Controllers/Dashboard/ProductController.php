<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Traits\FileMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    use FileMethods;

    private ProductRepositoryInterface $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $this->authorize('viewAny', Product::class); //policy
        $products = Product::with(["store", "category"])->paginate(10);
        return view("dashboard.products.index", compact("products"));
    }

    public function create()
    {
        $this->authorize('create', Product::class); //policy
        $product = new Product();
        $categories = Category::all();
        return view("dashboard.products.create", compact("product", 'categories'));
    }

    public function store(ProductRequest $request)
    {
        $this->authorize('create', Product::class); //policy
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
        return redirect()->route('products.index')->with('success', 'Data saved successfully');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product); //policy
        $categories = Category::all();
        $tags = implode(', ', $product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit', compact('product', 'categories', 'tags'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product); //policy
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
        //  collection give more performance than search at database
        $saved_tages = Tag::all();
        foreach ($tags as $tag_name) {
            $slug = Str::slug($tag_name);
            $tag = $saved_tages->where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::create(['name' => $tag_name, 'slug' => $slug]);
            }
            $tag_ids[] = $tag->id;
        }
        $product->tags()->sync($tag_ids);
        return redirect()->route('products.index')->with('success', 'Data saved successfully');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product); //policy
        $product->delete();
        $this->deleteFile($product->image);
        return redirect()->back()->with("success", "Data deleted successfully");
    }
}
