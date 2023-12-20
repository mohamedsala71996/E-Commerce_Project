<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class CategoryController extends Controller
{

    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index(Request $request)
    {

        // if ($request->name && $request->status!=1) {
        //     $categories=Category::where('name',$request->name)->where('status',$request->status)->paginate(10);
        // }elseif ($request->name && $request->status==1) {
        //     $categories=Category::where('name',$request->name)->paginate(10);
        // }else{
        //     $categories=$this->categoryRepository->getAllCategories();
        // }

        $query=$this->categoryRepository->getAllCategories();
        if ($request->name) {
            $query->where('name','LIKE',"%{$request->name}%");
        }
        if ($request->status) {
            $query->where('status',$request->status);
        }
        $categories=$query->paginate(10);

        return view("dashboard.category.index", compact("categories"));
    }


    public function create()
    {
        $category = new Category();
        $parents = $this->categoryRepository->getAllCategories();
        return view("dashboard.category.create", compact("parents", "category"));
    }

    public function store(CategoryRequest $request)
    {
        $data = array_merge(
            $request->except('image'),
            ['slug' => Str::slug($request->name)]
        );
        $imagePath = $request->file('image')
            ? $request->file('image')->storeAs('CategoryPhotos', $data['slug'] ."_Category_". $request->file('image')->getClientOriginalName(), 'public')
            : '';
        $this->categoryRepository->createCategory(array_merge($data, ['image' => $imagePath]));

        return redirect()->route('categories.index')->with('success', 'Data saved successfully');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit($CategoryId)
    {
        $category = $this->categoryRepository->getCategoryById($CategoryId);
        $parents = Category::where('id', '!=', $CategoryId)
            ->where(function ($query) use ($CategoryId) {
                $query->where('parent_id', '!=', $CategoryId)
                    ->orWhereNull('parent_id');
            })
            ->get();
        return view("dashboard.category.edit", compact("category", "parents"));
    }

    public function update(CategoryRequest $request, $CategoryId)
    {
        $data = array_merge($request->except('image','_token','_method','id'), ['slug' => Str::slug($request->name)]);
        $category = $this->categoryRepository->getCategoryById($CategoryId);
        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('image')->storeAs('CategoryPhotos',$data['slug']."_Category_".$request->file('image')->getClientOriginalName(), 'public');
        } elseif (!$request->hasFile('image') && $category->image) {
            $imagePath = $category->image;
        } else {
            $imagePath = '';
        }
        $this->categoryRepository->updateCategory($CategoryId, array_merge($data, ['image' => $imagePath]));
        return redirect()->route("categories.index")->with("success", "Data saved successfully");
    }

    public function destroy($CategoryId)
    {
        $imagePath = Category::findOrFail($CategoryId)->image;
        $this->categoryRepository->deleteCategory($CategoryId);
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
        return redirect()->back()->with("success", "Data deleted successfully");
    }
}
