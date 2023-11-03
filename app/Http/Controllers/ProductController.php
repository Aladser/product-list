<?php

namespace App\Http\Controllers;

use App\EMailSender;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $eMailSender;

    public function __construct()
    {
        // $smtpSrv, $username, $password, $smtpSecure, $port, $emailSender, $emailSenderName
        $this->eMailSender = new EMailSender(
            env('MAIL_MAILER'),
            env('MAIL_USERNAME'),
            env('MAIL_PASSWORD'),
            env('MAIL_ENCRYPTION'),
            env('MAIL_PORT'),
            env('MAIL_FROM_ADDRESS'),
            env('MAIL_FROM_NAME')
        );
    }

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

        return view('dashboard', ['products' => $products]);
    }

    // форма редактирования
    public function show($id)
    {
        $product = Product::find($id);
        $data = [];
        $data['id'] = $product->id;
        $data['articul'] = $product->articul;
        $data['name'] = $product->name;
        $data['status'] = $product->status;
        $data['data'] = json_decode($product->data);

        return view('show', ['product' => $data]);
    }

    public function create()
    {
        return view('create-product');
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
            $product->status = $data['status'];
            $product->data = $data['data'];
            $isSaved = $product->save();

            if ($isSaved) {
                // отправка письма
                /*
                $message = "
                    <body>
                        <h4>Появился новый продукт</h4>
                        <p>Артикул:{$data['articul']}</p>
                        <p>Название:{$data['name']}</p></p>
                    </body>
                ";
                $this->eMailSender->send('Магазин: новый продукт', $message, config('products.email'));
                */
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

    public function destroy($id, Request $request)
    {
        $isDeleted = Product::find($id)->delete();

        return ['result' => $isDeleted ? 1 : 0];
    }

    // форма редактирования
    public function edit($id)
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

    // обновить данные в БД
    public function update(Request $request)
    {
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
