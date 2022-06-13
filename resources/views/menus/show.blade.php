<x-app-layout>
    <section class="bg-gray-800 body-font max-w-md mx-auto">

        {{--        Nav Menu--}}
        <div class="container mx-auto flex flex-wrap">
            <div class="flex flex-wrap place-content-center w-full text-orange-300 px-10 py-8 mb-2 bg-black">
                <div>
                    <img class="object-fill w-full h-12" src="https://dummyimage.com/100" alt="Company Name">
                </div>
            </div>
        </div>

        <div class="container px-2 mx-auto flex flex-wrap">
            @foreach($categories as $category)
                <div class="flex flex-wrap w-full py-6 px-10 relative mb-2 bg-black">
                    <div class="text-center relative z-10 w-full">
                        <a href="{{route('menus-menu.show', ['menu' => $menu, 'company' => $menu->company, 'city' => $menu->company->city])}}"
                           class="uppercase text-2xl text-orange-300 font-medium title-font mb-2">Menu {{$loop->iteration}}</a>
                        <p class="text-orange-200">{{$menu->name}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <div class="flex items-center justify-center min-h-screen bg-gray-900">
        <div class="col-span-12">
            <div class="overflow-auto lg:overflow-visible ">
                <table class="table text-gray-400 border-separate space-y-6 text-sm">
                    <thead class="bg-gray-800 text-gray-500">
                    <tr>
                        <th class="p-3">Product</th>
                        <th class="p-3 text-left">Description</th>
                        <th class="p-3 text-left">Price</th>
                        @auth()
                            <th class="p-3 text-left">Action</th>
                        @endauth
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)

                        <tr class="bg-gray-800">
                            <td class="p-3">
                                <div class="flex align-items-center">
                                    <img class="rounded-full h-12 w-12  object-cover"
                                         src="https://images.unsplash.com/photo-1613588718956-c2e80305bf61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=634&q=80"
                                         alt="unsplash image">
                                    <div class="ml-3">
                                        <div class="">{{$product->name}}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">{{$product->description}}</td>
                            <td class="p-3 font-bold">{{$product->pivot->price}}</td>
                            @auth()
                                <td class="p-3 ">
                                    <a href="#" class="text-gray-400 hover:text-gray-100 mr-2">
                                        <i class="material-icons-outlined text-base">visibility</i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-gray-100  mx-2">
                                        <i class="material-icons-outlined text-base">edit</i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-gray-100  ml-2">
                                        <i class="material-icons-round text-base">delete_outline</i>
                                    </a>
                                </td>
                            @endauth
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <style>
        .table {
            border-spacing: 0 5px;
        }

        i {
            font-size: 1rem !important;
        }

        .table tr {
            border-radius: 20px;
        }

        tr td:nth-child(n+3),
        tr th:nth-child(n+3) {
            border-radius: 0 .625rem .625rem 0;
        }

        tr td:nth-child(1),
        tr th:nth-child(1) {
            border-radius: .625rem 0 0 .625rem;
        }
    </style>
</x-app-layout>
