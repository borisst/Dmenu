<x-app-layout>
    <x-slot name="header">
    </x-slot>
<form action="{{route('events.update' , $event->id)}}" method="POST" enctype="multipart/form-data" >
    @method('PATCH')
    @csrf
    <label for="name" >Name:</label><br>
    <input type="text" name="name" value="{{$event->name}}"> <br>
    <label for="image">Upload an image:</label> <br>
    <img class="h-10 w-10" src="{{asset('../images/' . $event->image)}}" alt="{{$event->name}}">
    <input type="file" name="image" value="{{$event->image}}"> <br>
    <label for="date">Choose event date:</label> <br>
    <input type="date" name="date" value="{{$event->date}}"><br>
    <input type="submit" name="submit">
    @if(session()->has('success'))
        <p class="text-blue-600">{{ session('success') }}</p>
    @endif
    @if(session()->has('error'))
        <p class="text-red-600">{{ session('error') }}</p>
    @endif
</form>
</x-app-layout>
