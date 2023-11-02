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

    <div class="flex bg-slate-200 overflow-hidden shadow-sm sm:rounded-lg">
        <section class="bg-white w-1/2">
            <table id='table-product' class='w-full mx-auto text-sm text-left text-gray-500'>
                <thead class='w-full text-xs text-gray-700 uppercase bg-gray-50'>
                    <tr> 
                        <th class='p-3 w-1/4 bg-theme'>Артикул</th> 
                        <th class='p-3 text-center bg-theme'>Название</th> 
                        <th class='p-3 w-1/4 text-end bg-theme'>Цвет</th>
                        <th class='p-3 w-1/4 text-end bg-theme'>Размер</th>
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
        </section>

        <section class='text-right w-1/2 p-4 bg-theme'>
            <p id='table-error' class='hidden font-semibold pb-4 text-center text-red-500 text-xl font-semibold'></p>
            <a href="{{route('product.create')}}" class="rounded bg-sky-500 text-white px-6 pb-[6px] pt-2 text-xs font-medium 
                    leading-normal transition duration-150 ease-in-out hover:bg-opacity-70 hover:bg-sky-400
                    focus:border-neutral-800 focus:text-neutral-800 focus:outline-none focus:ring-0 
                    active:border-neutral-900 active:text-neutral-900">Добавить</a>
        </section>
    </div>
</x-app-layout>