<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.dashboard.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('admin.dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $file=$request->photo;
        $filename="null";
        if ($file){
            $filename=$file->getClientOriginalName().'category.'.$file->getClientOriginalExtension();
            $request->photo->move('Category',$filename);
        }

        
        $category = Category::create([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.dashboard.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $validatedData['name'],
            'paintings' => 'required|unique:categories|max:255',
            'sculptures' => 'required|unique:categories|max:255',
            'photography' => 'required|unique:categories|max:255',
            'digital_art' => 'required|unique:categories|max:255',
            'conceptual' => 'required|unique:categories|max:255',
            'drawings' => 'required|unique:categories|max:255',
        ]);

        $id = $request->id;
        $data = Category::find($id);
        $data->paintings = $request->paintings;
        $data->sculptures = $request->sculptures;
        $data->photography = $request->photography;
        $data->digital_art = $request->digital_art;
        $data->conceptual = $request->conceptual;
        $data->drawings = $request->drawings;


        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
    
    public function status($id){
            $data = Category::find($id);
            if ($data->active == true) {
                $data->active = false;
            } else {
                $data->active = true;
            }
            $data->save();
            return redirect()
                ->route('category.index')
                ->with('success', 'Category status update successfully.');
    }

}



