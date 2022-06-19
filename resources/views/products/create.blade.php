<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <section class="flex justify-center">
    <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 p-5">
        <p class="text-center text-xl text-white">Add product</p>

    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <label class="text-white" for="name">Name:</label><br>
    <input class="block w-full p-2 text-white border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" id="name" name="name"><br>

    <label class="text-white" for="weight">Weight</label><br>
    <input class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" id="weight" name="weight"><br>

    <label class="text-white" for="description">Description</label><br>
    <input class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" id="description" name="description"><br>

    <label class="text-white" for="image">Upload an Image</label><br>
    <input class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="file" name="image"> <br>

        <label class="text-white" for="category_id">Category</label><br>
    <select name="category_id"> <br>
        @foreach($categories as $category)
            <option class="rounded w-max block"
                    value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select> <br>


    <input class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" type="submit">




    @if(session()->has('success'))
        <p class="text-blue-600">{{ session('success') }}</p>
    @endif
    @if(session()->has('error'))
        <p class="text-red-600">{{ session('error') }}</p>
    @endif

</form>
    </div>
    </section>
</x-app-layout>
