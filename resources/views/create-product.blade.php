<x-app-layout>
    @section('title')
        <x-title>Добавить товар</x-title>
    @endsection

    @section('meta')
        <meta name="role" content="{{ config('products.role') }}">
    @endsection
    
    @section('js')
        <script src="/js/ServerRequest.js" defer></script>
        <script src="/js/ClientController.js" defer></script>
        <script src="/js/ProductClientController.js" defer></script>
        <script src="/js/create-product.js" defer></script>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Добавление товара</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <article class='text-center'>
                    <form class='form-new-product' data-type='add'>
                        <label for="form-new-product__articul" class='inline-block w-1/5'>Артикул:</label>
                        <input type="text" class='w-1/2' id='form-new-product__articul' name='articul' required><br>

                        <label for="form-new-product__name" class='inline-block w-1/5'>Имя:</label>
                        <input type="text" class='w-1/2' id='form-new-product__name' name='name' required><br>
                        
                        <label for="form-new-product__color" class='inline-block w-1/5'>Цвет:</label>
                        <input type="text" class='w-1/2' id='form-new-product__color'name='color'><br>

                        <label for="size" id='form-new-product__size' class='inline-block w-1/5'>Размер:</label>
                        <input type="text" class='w-1/2' id='form-new-product__size' name='size'>

                        <div class='py-2 text-xl'>
                            <input type="submit" class='border border-black p-2 rounded h-full w-40' value="Добавить">
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