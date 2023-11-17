<x-app-layout>
    @section('title')
        <x-title>Товары</x-title>
    @endsection

    @section('js')
        <script src="/js/classes/ServerRequest.js" defer></script>
        <script src="/js/classes/ProductClientController.js" defer></script>
        <script src="/js/pages/dashboard.js" defer></script>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Товары</h2>
    </x-slot>

    <div class="flex overflow-hidden shadow-sm sm:rounded-lg h-screen">
        <section class="w-1/2">
            <table id='table-product' class='w-full mx-auto text-sm text-left'>
                <thead class='w-full text-xs uppercase border-b-2 border-gray-400'>
                    <tr class='text-gray-400 bg-theme'> 
                        <th class='p-3 w-1/4'>Артикул</th> 
                        <th class='p-3'>Название</th>
                        <th class='p-3'>Статус</th> 
                        <th class='p-3'>Атрибуты</th>
                    </tr>
                <thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class='table-product__tr border-b-2 border-gray-40 bg-white cursor-pointer' id="product-{{$product['id']}}">
                            <td class='p-3 relative'>{{$product['articul']}}</td>
                            <td class='p-3'>{{$product['name']}}</td>
                            <td class='p-3'>{{$product['status']}}</td>
                            <td class='p-3'>
                                @foreach ($product['data'] as $key => $value)
                                    {{$key}}: {{$value}}<br>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <!-- блок кнопок -->
        <section class='text-right w-1/2 pt-6 pe-8 section-buttons'>
            <a href="{{route('product.create')}}" class="section-buttons__btn mb-1 text-center inline-block rounded bg-sky-500 text-white py-2 text-xs font-medium 
                    leading-normal transition duration-150 ease-in-out hover:bg-opacity-70 hover:bg-sky-400
                    focus:border-neutral-800 focus:text-neutral-800 focus:outline-none focus:ring-0 
                    active:border-neutral-900 active:text-neutral-900" title='Добавить'>Добавить
            </a><br>
            <a class="section-buttons__btn mb-1 text-center inline-block rounded bg-sky-500 text-white py-2 text-xs font-medium 
                    leading-normal transition duration-150 ease-in-out hover:bg-opacity-70 hover:bg-sky-400
                    focus:border-neutral-800 focus:text-neutral-800 focus:outline-none focus:ring-0 
                    active:border-neutral-900 active:text-neutral-900 hidden" id='btn-info' title='Информация'>Информация
            </a><br>
            <a class="section-buttons__btn mb-1 text-center inline-block rounded bg-sky-500 text-white py-2 text-xs font-medium 
                    leading-normal transition duration-150 ease-in-out hover:bg-opacity-70 hover:bg-sky-400
                    focus:border-neutral-800 focus:text-neutral-800 focus:outline-none focus:ring-0 
                    active:border-neutral-900 active:text-neutral-900 hidden" id='btn-edit' title='Редактировать'>Редактировать
            </a><br>
            <button class="section-buttons__btn mb-1 text-center inline-block rounded bg-sky-500 text-white py-2 text-xs font-medium 
                    leading-normal transition duration-150 ease-in-out hover:bg-opacity-70 hover:bg-sky-400
                    focus:border-neutral-800 focus:text-neutral-800 focus:outline-none focus:ring-0 
                    active:border-neutral-900 active:text-neutral-900 hidden" id='btn-remove' title='Удалить'>Удалить
            </button>      
            <p id='table-error' class='font-semibold pb-4 text-center text-red-500 text-xl font-semibold'></p>
        </section>
    </div>
</x-app-layout>
