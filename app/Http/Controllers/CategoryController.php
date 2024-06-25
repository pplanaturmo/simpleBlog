<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

//funcion para mostrar la lista de categorías y los posts de la elegida
    public function showPostsByCategory($categoryId)
    {
        if ($categoryId === 'all') {
            $posts = collect();
        } else {
            $category = Category::findOrFail($categoryId);
            $posts = $category->posts->sortByDesc('created_at');
        }

        $categories = Category::orderBy('name')->get();

        return view('categories.index', compact('posts', 'categories', 'categoryId'));
    }

//funcion para crear categoría
    public function create()
    {
        return view('categories.create');
    }

    //funcion para almacenar la categoría
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category($validatedData);
        $category->save();

        return redirect()->route('categories.index', ['categoryId' => 'all'])->with('info', 'Category created successfully!');
    }

    //funcion para editar categoría
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $categories = Category::all();

        return view('categories.edit', compact('category', 'categories'));
    }

    //funcion para alterar la categoría editada
    public function update(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::where('slug', $slug)->firstOrFail();
        if ($validatedData['name'] !== $category->name) {
            $category->slug = Str::slug($validatedData['name']);
        }

        $category->update([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('categories.index', ['categoryId' => 'all'])->with('info', 'Category updated successfully');
    }

    //funcion para destruir categoría
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $category->delete();

        return redirect()->route('categories.index', ['categoryId' => 'all'])->with('info', 'Category deleted successfully!');
    }
}
