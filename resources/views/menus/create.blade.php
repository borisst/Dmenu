<x-app-layout>
    <x-slot name="header">
    </x-slot>


    <!-- Snippet -->
    <section class="flex flex-col justify-center antialiased bg-gray-100 text-gray-600 min-h-screen p-4">
        <div class="h-full">
            <!-- Table -->
            <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="text-center  font-semibold text-gray-800">Create new Menu</h2>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400">
                            <tr>
                                <th class="p-2">
                                </th>
                                <th class="p-2">
                                </th>
                                <th class="p-2">
                                </th>
                            </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                            <form action="{{route('menus-menu.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <tr>
                                    <td class="p-2">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="rounded block h-6">
                                    </td>
                                    <td class="p-2">
                                        <label for="company">Company</label>
                                        <select class="rounded w-full block" name="company_id" id="company">
                                            @foreach($companies as $company)
                                                <option class="rounded w-max block" value="{{$company->id}}">{{$company->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    Choose company logo <br>
                                    <input type="file" name="logo">
                                    <td class="p-2">
                                        <button type="submit">Save</button>
                                    </td>
                                </tr>
                            </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
