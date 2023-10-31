<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = [];
        foreach (Product::activeProducts() as $activeProduct) {
            $data = json_decode($activeProduct->data);
            $color = $data->color;
            $size = $data->size;
            $products[] = ['id' => $activeProduct->id, 'article' => $activeProduct->article, 'name' => $activeProduct->name, 'color' => $color, 'size' => $size];
        }

        return view('dashboard', ['products' => $products]);
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
