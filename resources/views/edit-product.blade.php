<x-app-layout>
    @section('title')
        <x-title>Редактировать товар</x-title>
    @endsection
    
    @section('js')
        <script src="/js/classes/ServerRequest.js" defer></script>
        <script src="/js/classes/ProductClientController.js" defer></script>
        <script src="/js/classes/ProductAttribute.js" defer></script>
        <script src="/js/pages/edit-product.js" defer></script>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Редактирование товара</h2>
    </x-slot>

    <div class="bg-black-theme overflow-hidden pt-4 ps-2 w-200">
        <h2 class="font-semibold text-xl text-white leading-tight pb-4 relative me-4">
            Редактирование товара<x-btn-close></x-btn-close>
        </h2>

        <article  class='inline-block w-full'>
            <form class='form-edit-product' id='form-edit-product' data-type='edit' data-id="{{$product['id']}}">
                @if (config('products.role') === 'admin')
                    <label for="form-edit-product__articul" class='block w-2/3 text-white text-xs pb-2'>Артикул:</label>
                    <input type="text" class='w-2/3 rounded mb-4' id='form-edit-product__articul' name='articul' required value="{{$product['articul']}}"><br>
                @else
                    <p class='iblock w-2/3 text-white text-xs pb-2'>Артикул:</p>
                    <p class='w-2/3 rounded mb-4 inline-block w-1/2 border border-gray-200 ps-4 p-2 text-start bg-gray-200' id='form-edit-product__articul'>{{$product['articul']}}</p><br>
                @endif

                <label for="form-edit-product__name" class='block w-2/3 text-white text-xs pb-2'>Имя:</label>
                <input type="text" class='w-2/3 rounded mb-4' id='form-edit-product__name' name='name' required value="{{$product['name']}}"><br>

                <label for="form-edit-product__status" class="block w-2/3 text-white text-xs pb-2">Статус</label>
                <select name="status" id="form-edit-product__status" class="w-2/3 rounded mb-4 p-2">
                    @if ($product['status'] === 'available')
                        <option value="available" selected>Доступен</option>
                        <option value="unavailable">Недоступен</option>
                    @else 
                        <option value="available">Доступен</option>
                        <option value="unavailable" selected>Недоступен</option>
                    @endif
                </select>
                <p class='font-semibold text-base text-white leading-tight pb-4 relative me-4 mb-4'>Атрибуты</p>

                <section class='form-edit-product__attributes w-full'>
                @foreach ($product['data'] as $key => $value)
                    <article class='form-edit-product__attribute mb-4'>
                        <div class='inline-block w-30percents me-2'>
                            <label class='block w-2/3 text-white text-xs pb-2'>Название</label>
                            <input type='text' class='form-edit-product__attr-name w-full rounded' value="{{$key}}">
                        </div>
                        <div class='inline-block w-30percents me-2'>
                            <label class='block w-2/3 text-white text-xs pb-2'>Значение</label>
                            <input type='text' class='form-edit-product__attr-value w-full rounded' value="{{$value}}">
                        </div>
                        <button class='form-edit-product__btn-remove-attr'>🗑</button>
                    </article>
                @endforeach
                </section>

                <button class="form-edit-product__add-attr text-sky-400 text-xs border-b border-dashed border-sky-400 mb-8">+ Добавить атрибут</button>
                <div class='pb-2 text-xl'>
                    <input type="submit" class='rounded bg-sky-500 text-white px-10 py-2 text-xs font-medium 
                    leading-normal transition duration-150 ease-in-out hover:bg-opacity-70 hover:bg-sky-400
                    focus:border-neutral-800 focus:text-neutral-800 focus:outline-none focus:ring-0 
                    active:border-neutral-900 active:text-neutral-900' value="Сохранить">
                </div>
            </form>
        </article>
        <p id='table-error' class='font-semibold pb-4 text-center text-white text-xl font-semibold'></p>
    </div>
</x-app-layout>