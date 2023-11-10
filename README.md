## Product-list – база товаров

Особенности
+ Авторизация и регистрация пользователей. Две роли: обычный пользователь и администратор
+ Список всех товаров
+ Добавить товар. При добавлении нового товара на почту отправляется уведомление
+ Удалить товар
+ Редактировать товар
+ Карточка товара


#### Создать таблицу «products».

```
    Schema::create('products', function (Blueprint $table) {
        $table->id();

        $table->string('articul', 255)->unique();
        $table->string('name', 255)->nullable(false);

        // считаю, что такая реализация лучше. Отсеивает лишние значения
        $table->enum('status', ['available', 'unavailable'])->default('available');

        $table->jsonb('data')->nullable('false');
        $table->timestamp('created_at')->useCurrent();
    });
```

#### Создать Eloquent-модель «Product», связанную с таблицей «products». В модели реализовать Local Scope для получения только доступных продуктов (STATUS = “available”).

```
    public static function availableProducts()
    {
        return Product::where('status', 'available');
    }
```

#### Сделать валидацию полей NAME, ARTICLE

Валидация происходит в контроллере App\Http\Controllers\ProductController, методе validateFields

#### Создать роль администратора

 В таблицу пользователей добавлено поле is_admin, через него проиходит валидация прав

#### При создании продукта реализовать отправку на заданный в конфигурации Email (config(‘products.email’)) уведомления (Notification) о том, что продукт создан.
#### Уведомление должно отправляться через задачу (Job) в очереди (Queue).

Используется библиотека PHPMailer. Отправка письма реализована через собственный класс App\EMailSender. Письмо отправляется через задание App\Jobs\SendEmailJob очереди
Письма отправляются по-настоящему, если сайт работает через веб-сервер апач.

#### Готовое приложение упаковать в docker. 

За докеризацию отвечает папка *docker-compose*, файлы *.env*, *Dockerfile*, *docker-compose.yml* в корне проекта
