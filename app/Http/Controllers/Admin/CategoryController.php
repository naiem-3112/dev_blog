<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Post;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.category.index')->with('message', 'category inserted successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrfail($id);
        return view('admin.category.edit', compact('category'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name,'.$request->id,
        ]);
        $category = Category::findOrfail($id);
        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.category.index')->with('message', 'category updated successfully');

    }

    public function show()
    {

    }

    public function delete($id)
    {
        $category = Category::findOrfail($id);
        $category->delete();
        return redirect()->route('admin.category.index')->with('message', 'category deleted successfully');

    }

}
