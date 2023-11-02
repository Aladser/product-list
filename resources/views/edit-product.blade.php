<x-app-layout>
    @section('title')
        <x-title>Редактировать товар</x-title>
    @endsection
    
    @section('js')
        <script src="/js/ServerRequest.js" defer></script>
        <script src="/js/ClientController.js" defer></script>
        <script src="/js/ProductClientController.js" defer></script>
        <script src="/js/edit-product.js" defer></script>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Редактирование товара</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <article class='text-center mt-8'>
                    <form class='form-edit-product' data-type='edit' data-id="{{$product['id']}}">
                        @if (config('products.role') === 'admin')
                            <label for="form-new-product__articul" class='inline-block w-1/5'>Артикул:</label>
                            <input type="text" class='w-1/2' id='form-new-product__articul' name='articul' required value="{{$product['articul']}}"><br>
                        @else
                            <p class='inline-block w-1/5'>Артикул:</p>
                            <p class='inline-block w-1/2 border border-gray-200 ps-4 p-2 text-start bg-gray-200'>{{$product['articul']}}</p><br>
                        @endif

                        <label for="form-new-product__name" class='inline-block w-1/5'>Имя:</label>
                        <input type="text" class='w-1/2' id='form-new-product__name' name='name' required value="{{$product['name']}}"><br>
                        
                        <label for="form-new-product__color" class='inline-block w-1/5'>Цвет:</label>
                        <input type="text" class='w-1/2' id='form-new-product__color'name='color' value="{{$product['color']}}"><br>

                        <label for="size" id='form-new-product__size' class='inline-block w-1/5'>Размер:</label>
                        <input type="text" class='w-1/2' id='form-new-product__size' name='size' value="{{$product['size']}}">

                        <div class='py-2 text-xl'>
                            <input type="submit" class='border border-black p-2 rounded h-full w-40' value="Сохранить">
                            <a href="{{route('product')}}">
                                <input type="button" class='border border-black p-2 rounded h-full w-40' value="Назад">
                            </a>
                        </div>
                    </form>
                </article>
                <p id='table-error' class='font-semibold pb-4 text-center text-red-500 text-xl font-semibold'></p>
            </div>
        </div>
    </div>
</x-app-layout>