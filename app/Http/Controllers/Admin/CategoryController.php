<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::headerCategories();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $data['name'] = $request->name;
        $data['parent_id'] = $request->parent_id;
        Category::create($data);
        Cache::forget('header_categories');
        session()->flash('success', __('site.category_created'));
        return redirect()->route('admin.categories.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category)
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.categories.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data['name'] = $request->name;
        $data['parent_id'] = $request->parent_id;
        $category->update($data);
        Cache::forget('header_categories');
        session()->flash('success', __('site.category_updated'));
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy($category)
    {
        Category::destroy($category);
        Cache::forget('header_categories');
        session()->flash('success', __('site.category_deleted'));
        return redirect()->route('admin.categories.index');
    }
}
