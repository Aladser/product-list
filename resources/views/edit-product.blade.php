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

    <div class="bg-black-theme overflow-hidden pt-4 ps-2 w-200">
        <h2 class="font-semibold text-xl text-white leading-tight pb-4 relative me-4">
            Редактирование товара
            <a href="{{route('product')}}"><input type="button" class='text-white absolute top-0 right-0'value="x"></a>
        </h2>
        <article  class='inline-block w-full'>
            <form class='form-edit-product' data-type='edit'>
                @if (config('products.role') === 'admin')
                    <label for="form-new-product__articul" class='block w-2/3 text-white text-xs pb-2'>Артикул:</label>
                    <input type="text" class='w-2/3 rounded mb-4' id='form-new-product__articul' name='articul' required value="{{$product['articul']}}"><br>
                @else
                    <p class='iblock w-2/3 text-white text-xs pb-2'>Артикул:</p>
                    <p class='w-2/3 rounded mb-4 inline-block w-1/2 border border-gray-200 ps-4 p-2 text-start bg-gray-200'>{{$product['articul']}}</p><br>
                @endif

                <label for="form-new-product__name" class='block w-2/3 text-white text-xs pb-2'>Имя:</label>
                <input type="text" class='w-2/3 rounded mb-4' id='form-new-product__name' name='name' required value="{{$product['name']}}"><br>
                
                <label for="form-new-product__color" class='block w-2/3 text-white text-xs pb-2'>Цвет:</label>
                <input type="text" class='w-2/3 rounded mb-4' id='form-new-product__color'name='color' value="{{$product['color']}}"><br>

                <label for="size" id='form-new-product__size' class='block w-2/3 text-white text-xs pb-2'>Размер:</label>
                <input type="text" class='w-2/3 rounded mb-4' id='form-new-product__size' name='size' value="{{$product['size']}}">

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