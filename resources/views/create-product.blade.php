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
        <script src="/js/attributes.js" defer></script>
    @endsection

    <div class="bg-black-theme overflow-hidden pt-4 ps-2 w-200">
        <h2 class="font-semibold text-xl text-white leading-tight pb-4 relative me-4">
            Добавить продукт
            <a href="{{route('product')}}"><input type="button" class='text-white absolute top-0 right-0'value="x"></a>
        </h2>
        <article  class='inline-block w-full'>
            <form class='form-new-product' data-type='add'>
                <label for="form-new-product__articul" class='block w-2/3 text-white text-xs pb-2'>Артикул:</label>
                <input type="text" class='w-2/3 rounded mb-4' id='form-new-product__articul' name='articul' required><br>

                <label for="form-new-product__name" class='block w-2/3 text-white text-xs pb-2'>Имя:</label>
                <input type="text" class='w-2/3 rounded mb-4' id='form-new-product__name' name='name' required><br>
                
                <label for="form-new-product__status" class="block w-2/3 text-white text-xs pb-2">Статус</label>
                <select name="status" id="form-new-product__status" class="w-2/3 rounded mb-4 p-2">
                    <option value="available">Доступен</option>
                    <option value="unavailable">Недоступен</option>
                </select>
                <p class='font-semibold text-base text-white leading-tight pb-4 relative me-4 mb-4'>Атрибуты</p>

                <section class='form-new-product__attributes w-full'></section>
                <button class="form-new-product__add-attr text-sky-400 text-xs border-b border-dashed border-sky-400 mb-8">+ Добавить атрибут</button>

                <div class='pb-2 text-xl mb-6'>
                    <input type="submit" class='rounded bg-sky-500 text-white px-10 py-2 text-xs font-medium 
                    leading-normal transition duration-150 ease-in-out hover:bg-opacity-70 hover:bg-sky-400
                    focus:border-neutral-800 focus:text-neutral-800 focus:outline-none focus:ring-0 
                    active:border-neutral-900 active:text-neutral-900' value="Добавить">
                </div>
            </form>
        </article>
        <p id='table-error' class='font-semibold pb-4 text-center text-white text-xl font-semibold'></p>
    </div>
</x-app-layout>