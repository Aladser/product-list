<x-app-layout>
    @section('js')
        <script src="/js/ServerRequest.js" defer></script>
        <script src="/js/dashboard.js" defer></script>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Товары</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <article class='mb-6 text-center'>
                        <form action = '/' class='form-new-product'>
                            <label for="form-new-product__articul" class='inline-block w-1/5'>Артикул:</label>
                            <input type="text" class='w-1/2' id='form-new-product__articul' name='articul'><br>
                            
                            <label for="form-new-product__name" class='inline-block w-1/5'>Имя:</label>
                            <input type="text" class='w-1/2' id='form-new-product__name' name='name'><br>
                            
                            <label for="form-new-product__color" class='inline-block w-1/5'>Цвет:</label>
                            <input type="text" class='w-1/2' id='form-new-product__color'name='color'><br>

                            <label for="size" id='form-new-product__size' class='inline-block w-1/5'>Размер:</label>
                            <input type="text" class='w-1/2' id='form-new-product__size' name='size'>

                            <input type="submit" class='form-new-product_btn block mx-auto border border-black mt-2 py-2 px-6' value="Добавить">
                        </form>
                    </article>

                    <article>
                        <table class='table-auto w-full mx-auto text-sm text-left text-gray-500 dark:text-gray-400 border border-black' id='table-product'>
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
                                    <tr class='table-product__tr relative' id="{{$product['id']}}">
                                        <td class='p-3 border-e border-black'>{{$product['article']}}</td>
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
    </div>
</x-app-layout>