<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::get();
        return view('category.index', ['categories' => $categories]);
    }
}
