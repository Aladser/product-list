<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
GET|HEAD        product ...................... product.index › ProductController@index
  POST          product .......................product.store › ProductController@store
  GET|HEAD      product/create ................product.create › ProductController@create
  GET|HEAD      product/{product} .............product.show › ProductController@show
  PUT|PATCH     product/{product} .............product.update › ProductController@update
  DELETE        product/{product} .............product.destroy › ProductController@destroy
  GET|HEAD      product/{product}/edit ........product.edit › ProductController@edit
*/
class ProductController extends Controller
{
    // страница товаров
    public function index()
    {
        $products = [];
        foreach (Product::orderBy('articul', 'asc')->get() as $product) {
            $products[] = [
                'id' => $product->id,
                'articul' => $product->articul,
                'name' => $product->name,
                'status' => $product->status == 'available' ? 'Доступен' : 'Недоступен',
                'data' => json_decode($product->data),
            ];
        }

        return view('products', ['products' => $products]);
    }

    // сохранить новый товар
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
            $product->status = $data['status'];
            $product->data = $data['data'];
            $isSaved = $product->save();

            if ($isSaved) {
                // отправка письма
                SendEmailJob::dispatch($data['articul'], $data['name']);

                return [
                    'result' => 1,
                    'row' => [
                        'name' => $data['name'],
                        'articul' => $data['articul'],
                    ],
                ];
            } else {
                return ['result' => 0, 'description' => 'серверная ошибка сохранения'];
            }
        } else {
            return ['result' => 0, 'description' => 'артикул существует'];
        }
    }

    // форма создания нового товара
    public function create()
    {
        return view('create-product');
    }

    // карточка товара
    public function show(string $id)
    {
        $product = Product::find($id);
        $data = [];
        $data['id'] = $product->id;
        $data['articul'] = $product->articul;
        $data['name'] = $product->name;
        $data['status'] = $product->status === 'available' ? 'Доступен' : 'Недоступен';
        $data['data'] = json_decode($product->data);

        return view('show', ['product' => $data]);
    }

    // форма редактирования товара
    public function edit(string $id)
    {
        if (Auth::user()->is_admin) {
            config(['products.role' => 'admin']);
        } else {
            config(['products.role' => 'user']);
        }

        $product = Product::find($id);
        $data = [];
        $data['id'] = $product->id;
        $data['articul'] = $product->articul;
        $data['name'] = $product->name;
        $data['status'] = $product->status;
        $data['data'] = json_decode($product->data);

        return view('edit-product', ['product' => $data]);
    }

    public function update(Request $request, string $id)
    {
        return $request->all();
        $data = $request->all();

        $validateResult = $this->validateFields($data);
        if ($validateResult['result'] == 0) {
            return $validateResult;
        }

        $product = Product::find($data['id']);

        // проверка прав пользователя на сервере, что он может изменять артикул
        if (Auth::user()->is_admin) {
            $product->articul = $data['articul'];
        }

        $product->name = $data['name'];
        $product->status = $data['status'];
        $product->data = $data['data'];
        $isSaved = $product->save();

        if ($isSaved) {
            return ['result' => 1];
        } else {
            return ['result' => 0, 'description' => 'ошибка изменения данных'];
        }
    }

    public function destroy(string $id)
    {
        $isDeleted = Product::find($id)->delete();

        return ['result' => $isDeleted ? 1 : 0];
    }

    // валидация полей
    private function validateFields($data)
    {
        // валидация длины имени
        if (strlen($data['name']) < 10) {
            return ['result' => 0, 'description' => 'Длина имени не менее 10 символов'];
        }

        // проверка артикула
        if (array_key_exists('articul', $data)) {
            $chr = 'a-zA-Z0-9';
            if (!preg_match("/^[$chr]+$/", $data['articul'])) {
                return ['result' => 0, 'description' => 'Неверный артикул: только латинские буквы и цифры'];
            }
        }

        return ['result' => 1];
    }
}
