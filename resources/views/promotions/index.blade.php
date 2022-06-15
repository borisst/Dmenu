<x-app-layout>

    <x-slot name="header">
    </x-slot>

    <section class="flex flex-wrap -mx-1 lg:-mx-4 justify-center">

        @forelse($promotions as $promotion)
            <div class="m-5 text-white p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                Name: <a class="text-blue-500 text-2xl rounded p-1 m-3" href="{{route('promotions.show',$promotion->id)}}">{{$promotion->name}}</a>
                <p>Image:<img class="rounded-t-lg w-10 h-10" src="{{asset('../images/' . $promotion->image)}}" alt=""/></p>
                <p class="text-center  text-gray-200">Date: {{$promotion->date}}</p>
                <p class="text-center  text-gray-200">Price: {{$promotion->price}}</p>

                <div class="flex items-center">
                    <div class="grid-cols-6 ">
                        <a class="w-20 bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{route('promotions.edit',$promotion->id)}}">Edit</a> <br>
                    </div>
                    <div class="grid-cols-6 ">
                        <form action="{{route('promotions.delete',$promotion->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="w-20 bg-red-400 hover:bg-red-700 text-white font-bold py-2 px-4 mx-2 rounded"
                                   type="submit" name="submit" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No promotions yet.</p>
        @endforelse

    </section>
</x-app-layout>
