<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Traits\FileMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;




class CategoryController extends Controller
{
    use FileMethods;

    private CategoryRepositoryInterface $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Category::class);
        $categories = Category::leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'

            ])
            ->withCount('products')
            ->Filter($request->query())
            ->paginate(10);
        return view("dashboard.categories.index", compact("categories"));
    }


    public function create()
    {
        $this->authorize('create', Category::class);
        $category = new Category();
        $parents = $this->categoryRepository->getAllCategories();
        return view("dashboard.categories.create", compact("parents", "category"));
    }

    public function store(CategoryRequest $request)
    {
        $this->authorize('create', Category::class);
        $data = array_merge(
            $request->except('image'),
            ['slug' => Str::slug($request->name)]
        );
        $imagePath = $request->file('image')
            ? $request->file('image')->storeAs('CategoryPhotos', $data['slug'] . "_Category_" . $request->file('image')->getClientOriginalName(), 'public')
            : '';
        $this->categoryRepository->createCategory(array_merge($data, ['image' => $imagePath]));

        return redirect()->route('categories.index')->with('success', 'Data saved successfully');
    }

    public function show(Category $category)
    {
        $this->authorize('view', $category); //policy
        return view("dashboard.categories.show", compact("category"));
    }

    public function edit($CategoryId)
    {
        $this->authorize('update', Category::find($CategoryId));
        $category = $this->categoryRepository->getCategoryById($CategoryId);
        $parents = Category::where('id', '!=', $CategoryId)
            ->where(function ($query) use ($CategoryId) {
                $query->where('parent_id', '!=', $CategoryId)
                    ->orWhereNull('parent_id');
            })
            ->get();
        return view("dashboard.categories.edit", compact("category", "parents"));
    }

    public function update(CategoryRequest $request, $CategoryId)
    {
        $this->authorize('update', Category::find($CategoryId));
        $data = array_merge($request->except('image', '_token', '_method', 'id'), ['slug' => Str::slug($request->name)]);
        $category = $this->categoryRepository->getCategoryById($CategoryId);
        if ($request->hasFile('image')) {
            $this->deleteFile($category->image);
            $imagePath = $request->file('image')->storeAs('CategoryPhotos', $data['slug'] . "_Category_" . $request->file('image')->getClientOriginalName(), 'public');
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
        $this->authorize('delete', Category::find($CategoryId));
        $this->categoryRepository->deleteCategory($CategoryId);
        return redirect()->back()->with("success", "Data trashed successfully");
    }

    public function viewTrashes(Request $request)
    {
        $categories = Category::Filter($request)->onlyTrashed()->paginate(10);
        return view('dashboard.categories.trashes', compact('categories'));
    }

    public function forceDelete($CategoryId)

    {
        $imagePath = Category::onlyTrashed()->findOrFail($CategoryId)->image;
        $this->categoryRepository->forceDeleteCategory($CategoryId);
        $this->deleteFile($imagePath);
        return redirect()->back()->with("success", "Data deleted successfully");
    }

    public function restoreTrashes($CategoryId)
    {
        $this->categoryRepository->restoreTrashesCategory($CategoryId);
        return redirect()->back()->with("success", "Data restored successfully");
    }
}
