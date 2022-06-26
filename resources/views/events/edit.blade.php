<x-app-layout>
    <div class="flex flex-wrap space-y-5 mx-auto relative justify-center">
        <div class="md:relative fixed md:py-2 py-3 px-10 rounded-b-lg w-full bg-green-300">
            navbar goes here
        </div>

        <div class="flex flex-wrap justify-center md:space-y-5 space-y-10">
            <div class="rounded-lg md:shadow-lg md:p-3 mx-auto">
                <p class="md:contents hidden md:text-lg text-sm">Enter Event Details</p>
            </div>

            <div class="w-full rounded-lg border-2 border-gray-200 shadow-lg p-5">
                <form action="{{route('events.store')}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col justify-center space-y-2">
                        <div class="mx-15">
                            <label for="name" class="block">Event Name</label>
                            <input id="name" type="text" name="name" value="{{$event->name}}"
                                   class="w-2/3 px-2 p-1 rounded-lg capitalize mt-2">
                        </div>

                        <div>
                            <label for="company" class="block">Company</label>
                            <select id="company" name="company_id"
                                    class="required w-2/3 px-2 p-1 rounded-lg capitalize bg-white mt-2">
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}" @if($event->company_id == $company->id) selected @endif>{{ucfirst($company->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="date" class="block">Date <span class="text-gray-400 text-sm">(optional)</span></label>
                            <input type="datetime-local" id="date" name="date" class="px-2 p-1 rounded-lg mt-2" value="{{$event->date}}">
                        </div>

                        <div>
                            <label for="image" class="block">Image <span class="text-gray-400 text-sm">(optional)</span></label>
                            <input id="image" type="file" name="image" value="" class="w-full px-2 p-1 rounded-lg mt-2">
                        </div>
                        <div>
                            <label for="description" class="block">Description <span class="text-gray-400 text-sm">(optional)</span></label>
                            <textarea rows="5" cols="20" id="description" name="description"
                                      class="w-full px-2 p-1 rounded-lg mt-2">{{$event->description}}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 mt-3">
                        <a href="{{url()->previous()}}"
                           class="rounded-lg shadow-lg px-2 py-1 border-2 bg-white border-red-400">Cancel</a>
                        <button class="rounded-lg shadow-lg px-2 py-1 border-2 bg-white border-green-400" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>