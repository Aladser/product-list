<x-app-layout>
    @section('title')
        <x-title>Товары</x-title>
    @endsection

    @section('js')
        <script src="/js/ServerRequest.js" defer></script>
        <script src="/js/ClientController.js" defer></script>
        <script src="/js/ProductClientController.js" defer></script>
        <script src="/js/dashboard.js" defer></script>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Товары</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{route('product.create')}}" class="inline-block rounded border border-neutral-800 px-6 pb-[6px] pt-2 text-xs font-medium uppercase 
                        leading-normal text-neutral-800 transition duration-150 ease-in-out 
                        hover:border-neutral-800 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-neutral-800 
                        focus:border-neutral-800 focus:text-neutral-800 focus:outline-none focus:ring-0 active:border-neutral-900 
                        active:text-neutral-900 dark:border-neutral-900 dark:text-neutral-900 dark:hover:border-neutral-900 dark:hover:bg-neutral-100 
                        dark:hover:bg-opacity-10 dark:hover:text-neutral-900 dark:focus:border-neutral-900 dark:focus:text-neutral-900 dark:active:border-neutral-900 
                        dark:active:text-neutral-900 m-1">Добавить новый продукт</a>

                <article class="bg-white border-b border-gray-200 m-1">
                    <p id='table-error' class='font-semibold pb-4 text-center text-red-500 text-xl font-semibold'></p>
                    <table id='table-product' class='table-auto w-full mx-auto text-sm text-left text-gray-500 dark:text-gray-400 border border-black'>
                        <thead class='w-full text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b border-black'>
                            <tr> 
                                <th class='p-3 w-1/4 border-e border-black'>Артикул</th> 
                                <th class='p-3 text-center border-e border-black'>Название</th> 
                                <th class='p-3 w-1/4 text-end border-e border-black'>Цвет</th>
                                <th class='p-3 w-1/4 text-end'>Размер</th>
                            </tr>
                        <thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class='table-product__tr ' id="product-{{$product['id']}}">
                                    <td class='p-3 border-e border-black relative'>
                                        <span>{{$product['articul']}}</span>
                                        <div class='inline float-right'>
                                            <a href="/product/edit/{{$product['id']}}">
                                                <button class='product__btn-edit opacity-50' title='Редактировать'>✎</button>
                                            </a>
                                            <button class='product__btn-remove opacity-50' title='Удалить'>🗑</button>
                                        </div>
                                    </td>
                                    <td class='p-3 text-center border-e border-black'>{{$product['name']}}</td>
                                    <td class='p-3 text-end border-e border-black'>{{$product['color']}}</td>
                                    <td class='p-3 text-end'>{{$product['size']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </article>
            </div>
        </div>
    </div>
</x-app-layout>