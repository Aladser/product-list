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
            // валидация
            $validateResult = $this->validateFields($data);
            if ($validateResult['result'] == 0) {
                return $validateResult;
            }

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
                return ['result' => 0, 'description' => 'серверная ошибка сохранения'];
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

    public function update(Request $request)
    {
        $data = $request->all();

        $validateResult = $this->validateFields($data);
        if ($validateResult['result'] == 0) {
            return $validateResult;
        }

        $product = Product::find($data['id']);
        $product->articul = $data['articul'];
        $product->name = $data['name'];
        $product->data = json_encode(['color' => $data['color'], 'size' => $data['size']]);
        $isSaved = $product->save();

        return ['result' => $isSaved ? 1 : 0];
    }

    // валидация полей
    private function validateFields($data)
    {
        // валидация длины имени
        if (strlen($data['name']) < 10) {
            return ['result' => 0, 'description' => 'Длина имени не менее 10 символов'];
        }
        // проверка артикула
        $chr = 'a-zA-Z0-9';
        if (!preg_match("/^[$chr]+$/", $data['articul'])) {
            return ['result' => 0, 'description' => 'Неверный артикул: только латинские буквы и цифры'];
        }

        return ['result' => 1];
    }
}
