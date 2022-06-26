<x-app-layout>
    <div class="flex flex-wrap mx-auto relative justify-center">
        <div class="md:relative fixed md:py-2 py-3 px-10 rounded-b-lg w-full bg-green-300">
            navbar goes here
        </div>
        {{--@dd($company)--}}
        <div
            class="md:p-3 mx-auto md:my-4 mb-5 mt-16 bg-white border-blue-400 rounded-lg shadow-lg px-2 py-1">
            <p class="md:text-lg text-sm"><a
                    href="{{route('company-menus.show', ['company' => $company->id])}}"
                    class="text-blue-400 capitalize">{{$menu->name}}</a>'s products</p>
        </div>

        <div
            class="md:shadow-lg md:p-3 mx-auto md:my-4 mb-5 mt-16 border-2 border-blue-200 rounded-lg shadow-2xl px-2 py-1">
            <p class="md:text-lg text-sm">
                <a href="{{route('products.create')}}" class="uppercase">add new
                    product</a>
            </p>
        </div>

        <table class="container mx-auto text-left">
            <thead>
            <tr class="bg-white">
                <th class="p-3 hidden border lg:table-cell">Name</th>
                <th class="p-3 hidden border lg:table-cell">Category</th>
                <th class="p-3 hidden border lg:table-cell">Description</th>
                <th class="p-3 hidden border lg:table-cell">Weight</th>
                <th class="p-3 hidden border lg:table-cell">Price</th>
                <th class="p-3 hidden border lg:table-cell">Actions</th>
            </tr>
            </thead>

            <tbody>

            @foreach($assignedProducts as $product)
                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left border border-b block lg:table-cell relative lg:static capitalize">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Name</span>
                        {{$product->name}}</td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left border border-b block lg:table-cell relative lg:static capitalize">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Category</span>
                        {{$product->category->name}}</td>
                    <td class="w-full lg:w-auto pb-3 pt-5 text-gray-800 text-center md:text-left md:pl-4 border border-b block lg:table-cell relative lg:static ">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Description</span>
                        {{$product->description}}</td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left border border-b block lg:table-cell relative lg:static">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Weight</span>
                        {{$product->weight}} ml.
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left border border-b block lg:table-cell relative lg:static">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Price</span>
                        {{$product->pivot->price}} mkd.
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Actions</span>
                        <a href="{{route('products.edit', $product)}}"
                           class="rounded-lg shadow-lg px-2 py-1 border-2 border-orange-400">Edit</a>
                        <a href="{{route('products.delete', $product)}}"
                           onclick="return confirm('This will delete the product!')"
                           class="rounded-lg shadow-lg px-2 py-1 border-2 border-red-400">Remove</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    @if ($unassignedProducts->isNotEmpty())

        <div class="flex flex-wrap mx-auto relative justify-center md:mt-5">
            <p class="text-lg text-sm text-blue-500 rounded-lg bg-white shadow-xl px-2 py-1">Unassigned Products</p>
        </div>

        <div class="flex flex-wrap mx-auto relative justify-center mt-5">
            <table class="container mx-auto text-left">
                <thead>
                <tr class="bg-white">
                    <th class="p-3 hidden border lg:table-cell">Name</th>
                    <th class="p-3 hidden border lg:table-cell">Category</th>
                    <th class="p-3 hidden border lg:table-cell">Description</th>
                    <th class="p-3 hidden border lg:table-cell">Weight</th>
                    <th class="p-3 hidden border lg:table-cell">Price</th>
                    <th class="p-3 hidden border lg:table-cell">Action</th>
                </tr>
                </thead>

                <tbody>

                @foreach($unassignedProducts as $product)
                    <form action="{{route('menu-product.attach-products', $menu)}}" method="POST">
                        @csrf
                        @method('POST')

                        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left border border-b block lg:table-cell relative lg:static capitalize">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Name</span>
                                {{$product->name}}</td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left border border-b block lg:table-cell relative lg:static capitalize">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Category</span>
                                {{$product->category->name}}</td>
                            <td class="w-full lg:w-auto pb-3 pt-5 text-gray-800 text-center md:text-left md:pl-4 border border-b block lg:table-cell relative lg:static">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Description</span>
                                {{$product->description}}</td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left border border-b block lg:table-cell relative lg:static">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Weight</span>
                                {{$product->weight}} ml.
                            </td>
                            <td class="w-full lg:w-auto pb-3 pt-5 text-gray-800 text-center md:text-left md:pl-4 border border-b block lg:table-cell relative lg:static">
                                <input type="hidden" name="product" value="{{$product->id}}">
                                <input type="hidden" name="category_id" value="{{$product->category_id}}">
                                <div class="pl-5">
                                    <input required id="price" type="number" name="price" value=""
                                           class="lg:w-auto text-gray-800 rounded-lg p-1 text-center md:text-left border mx-auto border-b lg:table-cell"
                                           placeholder="Add price">

                                </div>

                            </td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Action</span>
                                <button class="rounded-lg shadow-lg px-2 py-1 border-2 bg-white border-green-400"
                                        type="submit">Add to Menu
                                </button>
                            </td>
                        </tr>
                    </form>
                @endforeach
            </table>
        </div>
    @endif

</x-app-layout>
