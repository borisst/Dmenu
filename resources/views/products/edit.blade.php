<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <section class="flex justify-center">

    <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 p-5">
    <p class="text-center text-xl text-white">Edit product</p>
<form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <label class="text-white" for="name">Name:</label><br>
    <input class="block w-full p-2 text-white border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" id="name" name="name" value="{{$product->name}}"><br>

    <label class="text-white" for="weight">Weight</label><br>
    <input class="block w-full p-2 text-white border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" id="weight" name="weight" value="{{$product->weight}}"><br>

    <label class="text-white" for="description">Description</label><br>
    <input class="block w-full p-2 text-white border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" id="description" name="description" value="{{$product->description}}"><br>

    <div class="m-5 text-white p-6 max-w-sm bg-white rounded-lg border border-white shadow-md ">

        <img class="h-10 w-10" src="{{asset('../images/' . $product->image)}}" alt="{{$product->name}}">
        <input class="block w-full p-2 text-white border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$product->image}}" type="file" name="image">
    </div>

    <input class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" type="submit">
    <br>
    @if(session()->has('success'))
        <p class="text-blue-500">{{session('success')}}</p>
    @endif
</form>
</div>
    </section>

</x-app-layout>
