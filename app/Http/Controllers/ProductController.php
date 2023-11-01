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
            $products[] = ['id' => $activeProduct->id, 'articul' => $activeProduct->articul, 'name' => $activeProduct->name, 'color' => $color, 'size' => $size];
        }

        return view('dashboard', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!Product::where('articul', $data['articul'])->exists()) {
            $product = new Product();
            $product->articul = $data['articul'];
            $product->name = $data['name'];
            $product->data = json_encode(['color' => $data['color'], 'size' => $data['size']]);
            $isSaved = $product->save();

            if ($isSaved) {
                return [
                    'result' => 1,
                    'id' => $product->id,
                    'articul' => $data['articul'],
                    'name' => $data['name'],
                    'color' => $data['color'],
                    'size' => $data['size']];
            } else {
                return ['result' => 0, 'descrition' => 'серверная ошибка сохранения'];
            }
        } else {
            return ['result' => 0, 'description' => 'артикул существует'];
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->all()['id'];
        $isDeleted = Product::find($id)->delete();

        return ['result' => $isDeleted ? 1 : 0];
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
}
