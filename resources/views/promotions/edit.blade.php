<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <section class="flex justify-center">
        <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 p-5">
            <p class="text-center text-xl text-white">Update Promotions</p>
            <form action="{{route('promotions.update' , $promotion->id)}}" method="POST" enctype="multipart/form-data" >
                @method('PATCH')
                @csrf
                <label for="name" >Name:</label><br>
                <input class="block w-full p-2 text-white border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="name" value="{{$promotion->name}}"> <br>
                <label for="image">Upload an image:</label> <br>
                <img class="h-10 w-10" src="{{asset('../images/' . $promotion->image)}}" alt="{{$promotion->name}}">
                <input class="block w-full p-2 text-white border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="file" name="image" value="{{$promotion->image}}"> <br>
                <label for="date">Choose promotion date:</label> <br>
                <label for="price" >Price:</label><br>
                <input class="block w-full p-2 text-white border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="price" value="{{$promotion->price}}"> <br>
                <input class="block w-full p-2 text-white border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="date" name="date" value="{{$promotion->date}}"><br>

                <label class="text-white" for="company">Edit Company</label> <br>
                <select class="" name="company_id" id="company">
                    @foreach($companies as $company)
                        <option class="rounded w-max block"
                                value="{{$company->id}}" {{$promotion->company ? 'selected' : ''}}>{{$company->name}}</option>
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