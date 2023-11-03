<x-app-layout>
    @section('title')
        <x-title>Редактировать товар</x-title>
    @endsection
    
    @section('js')
        <script src="/js/ServerRequest.js" defer></script>
        <script src="/js/ClientController.js" defer></script>
        <script src="/js/ProductClientController.js" defer></script>
        <script src="/js/edit-product.js" defer></script>
        <script src="/js/attributes.js" defer></script>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Редактирование товара</h2>
    </x-slot>

    <div class="bg-black-theme overflow-hidden pt-4 ps-2 w-200 pb-40">
        <h2 class="font-semibold text-xl text-white leading-tight ps-3 pb-4 relative me-4 uppercase">
            {{$product['name']}}
            <a href="{{route('product')}}"><input type="button" class='text-gray-400 absolute top-0 right-0'value="x"></a>
        </h2>
        <table class='text-white'>
            <tr>
                <td class=' p-3 text-gray-300'>Артикул</td>
                <td class=' p-3'>{{$product['articul']}}</td>
            </tr>
            <tr>
                <td class=' p-3 text-gray-300''>Название</td>
                <td class=' p-3'>{{$product['name']}}</td>
            </tr>
            <tr>
                <td class=' p-3 text-gray-300''>Статус</td>
                <td class=' p-3'>{{$product['status']}}</td>
            </tr>
            <tr>
                <td class=' p-3 text-gray-300''>Атрибуты</td>
                <td class=' p-3'>
                    @foreach ($product['data'] as $key => $value)
                        {{$key}}: {{$value}}<br>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
</x-app-layout>