<x-app-layout>
    @section('title')
        <x-title>Информация о товаре</x-title>
    @endsection
    
    @section('js')
        <script src="/js/classes/ServerRequest.js" defer></script>
        <script src="/js/classes/ProductClientController.js" defer></script>
    @endsection

    <x-slot name="header">
        <h2 class="cursor-pointer font-semibold text-xl text-gray-800 leading-tight">Редактирование товара</h2>
    </x-slot>

    <div class="bg-black-theme overflow-hidden pt-4 ps-2 w-200 pb-40">
        <h2 class="font-semibold text-xl text-white leading-tight ps-3 pb-4 relative me-4 uppercase">
            {{$product['name']}}<x-btn-close></x-btn-close>
        </h2>
        <table class='text-white'>
            <tr>
                <td class='p-3 text-gray-300'>Артикул</td>
                <td class='p-3'>{{$product['articul']}}</td>
            </tr>
            <tr>
                <td class='p-3 text-gray-300''>Название</td>
                <td class='p-3'>{{$product['name']}}</td>
            </tr>
            <tr>
                <td class='p-3 text-gray-300''>Статус</td>
                <td class='p-3'>{{$product['status']}}</td>
            </tr>
            <tr>
                <td class='p-3 text-gray-300''>Атрибуты</td>
                <td class='p-3'>
                    @foreach ($product['data'] as $key => $value)
                        {{$key}}: {{$value}}<br>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
</x-app-layout>