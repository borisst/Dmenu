<x-app-layout>
    <div class="flex flex-wrap space-y-5 mx-auto relative justify-center">
        <div class="md:relative fixed md:py-2 py-3 px-10 rounded-b-lg w-full bg-green-300">
            navbar goes here
        </div>

        {{--        NEED TO FIX MOBILE VIEW --}}

        <div
                class="md:p-3 mx-auto md:my-4 mb-5 mt-16 bg-white border-blue-400 rounded-lg shadow-lg px-2 py-1">
            <p class="md:text-lg text-sm"><a href="{{route('companies')}}" class="text-blue-400 capitalize">
                    {{$company->name}}</a>'s events</p>
        </div>

        <div
                class="md:shadow-lg md:p-3 mx-auto md:my-4 mb-5 mt-16 border-2 border-blue-200 rounded-lg shadow-2xl px-2 py-1">
            <p class="md:text-lg text-sm">
                <a href="{{route('events-event.create')}}" class="uppercase">add new
                    event</a>
            </p>
        </div>

        {{--        NEED TO FIX MOBILE VIEW --}}

        <div class="w-full  mx-4">
            <div class="flex flex-wrap md:flex-nowrap lg:space-x-4 space-y-4 lg:space-y-0">
                @foreach($events as $event)
                    <div class="w-full md:w-1/2 h-full bg-gray-200 rounded-lg shadow-lg p-2 space-y-2 p-5">
                        <div class="flex space-x-2 rounded-lg border-2 border-gray-200 items-center shadow-lg mb-4">
                            <img class="rounded-lg w-10 h-10 m-1" src="{{$event->menu_logo}}" alt="">
                            <p>{{$event->name}}</p>
                        </div>

                        <div class="lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <a href="{{route('events.edit', $event)}}"
                               class="rounded-lg shadow-lg px-2 py-1 border-2 border-orange-400">Edit</a>
                            <a href="{{route('events.delete', $event)}}"
                               onclick="return confirm('This will delete the product!')"
                               class="rounded-lg shadow-lg px-2 py-1 border-2 border-red-400">Remove</a>
                        </div>

                        <div
                                class="flex flex-col h-52 md:flex-row md:space-x-2 space-y-2 md:space-y-0 place-content-between">
                            <div class="md:w-2/3 md:h-14 rounded-lg shadow-lg py-4 md:mt-2 px-4 space-y-2 border-2 border-gray-200">
                                <p>Number of Promotions: {{$event->promotions_count}}</p>
                            </div>
                            <div
                                    class="w-full md:h-auto h-2/3 bg-scroll bg-center bg-contain bg-no-repeat"
                                    style="background-image: url({{asset('images/1655200640.png')}});">
                            </div>
                            <div class="md:w-1/2 py-4 px-4 space-y-2 text-center">
                                <p class="rounded-lg shadow-lg px-3 py-2 border-2 border-blue-200">
                                    <a href="{{route('event.promotions.show', $event)}}">View Promotions</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
