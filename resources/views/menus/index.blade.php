<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <!-- Snippet -->
    <section class="flex flex-col justify-center antialiased bg-gray-100 text-gray-600 min-h-screen p-4">
        <div class="h-full">
            <!-- Table -->
            <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-800">Menus by {{auth()->user()->name}}</h2>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2">
                                    <div class="font-semibold text-left">Name</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-left">Company</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-center">Products</div>
                                </th>
                                <th class="p-2">

                                </th>
                                <th class="p-2">

                                </th>
                            </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                            @foreach($menus as $menu)
                                <tr>
                                    <td class="p-2">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full"
                                                                                                   src="https://placekitten.com/80/80"
                                                                                                   width="80"
                                                                                                   height="80"
                                                                                                   alt="{{$menu->name}}">
                                            </div>
                                            <div class="font-medium text-gray-800"><a
                                                    href="{{route('menus-menu.show', ['menu' => $menu, 'company' => $menu->company])}}">{{$menu->name}}</a></div>
                                        </div>
                                    </td>
                                    <td class="p-2">
                                        <div class="text-left"><a
                                                href="{{route('companies-company.show', $company = $menu->company)}}">{{$menu->company->name}}</a>
                                        </div>
                                    </td>
                                    <td class="p-2">
                                        <div
                                            class="text-center font-medium text-green-500">{{$menu->products_count}}</div>
                                    </td>
                                    <td class="p-2">
                                        <div class="text-center font-medium text-orange-500"><a
                                                href="{{route('menus-menu.edit', $menu)}}">Edit</a>
                                        </div>
                                    </td>
                                    <form action="{{route('menus-menu.destroy', $menu)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <td class="p-2">
                                            <button class="button text-center font-medium text-red-500" onclick="return confirm('Are you sure?')" type="submit">Remove</button>
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
