<x-app-layout>

    <x-slot name="header">
    </x-slot>

    <section class="flex flex-wrap -mx-1 lg:-mx-4 justify-center">

        @forelse($events as $event)
            <div class="m-5 text-white p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                Name: <a class="text-blue-500 text-2xl rounded p-1 m-3" href="{{route('events.show',$event->id)}}">{{$event->name}}</a>
                <p>Image:<img class="rounded-t-lg w-10 h-10" src="{{asset('../images/' . $event->image)}}" alt=""/></p>
                <p class="text-center  text-gray-200">Date: {{$event->date}}</p>
                <div class="flex items-center">
                    <div class="grid-cols-6 ">
                        <a class="w-20 bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{route('events.edit',$event->id)}}">Edit</a> <br>
                    </div>
                    <div class="grid-cols-6 ">
                        <form action="{{route('events.delete',$event->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="w-20 bg-red-400 hover:bg-red-700 text-white font-bold py-2 px-4 mx-2 rounded"
                                   type="submit" name="submit" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No events yet.</p>
        @endforelse

    </section>
</x-app-layout>




