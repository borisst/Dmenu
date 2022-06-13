<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <form action="{{route('events.store')}}" method="POST" enctype="multipart/form-data" >
            @method('POST')
            @csrf
            <label for="name" >Name:</label><br>
            <input type="text" name="name"> <br>
            <label for="image">Upload an image:</label> <br>
            <input type="file" name="image"> <br>
            <label for="date">Choose event date:</label> <br>
            <input type="date" name="date"> <br>
            <input type="submit" name="submit">
            @if(session()->has('success'))
                <p class="text-blue-600">{{ session('success') }}</p>
            @endif
            @if(session()->has('error'))
                <p class="text-red-600">{{ session('error') }}</p>
            @endif
        </form>
</x-app-layout>
