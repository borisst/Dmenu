<x-app-layout>
    <div class="flex flex-wrap space-y-5 mx-auto relative justify-center">
        <div class="md:relative fixed md:py-2 py-3 px-10 rounded-b-lg w-full bg-green-300">
            navbar goes here
        </div>

        <div class="flex flex-wrap justify-center md:space-y-5 space-y-10">
            <div class="rounded-lg md:shadow-lg md:p-3 mx-auto">
                <p class="md:contents hidden md:text-lg text-sm">Enter Company Details</p>
            </div>

            <div class="w-full rounded-lg border-2 border-gray-200 shadow-lg p-5">
                <form action="{{route('companies-company.store')}}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="flex flex-col justify-center space-y-2">
                        <div class="mx-15">
                            <label for="name" class="block">Company Name</label>
                            <input id="name" type="text" name="name" value="" class="w-2/3 px-2 p-1 rounded-lg capitalize mt-2">
                        </div>

                        <div>
                            <label for="contact_number" class="block">Contact Number</label>
                            <input id="contact_number" type="tel" name="contact_number" value="" class="w-2/3 px-2 p-1 rounded-lg mt-2">
                        </div>

                        <div>
                            <label for="logo" class="block">Choose Logo</label>
                            <input id="logo" type="file" name="logo" value="" class="w-full px-2 p-1 rounded-lg mt-2">
                        </div>

                        <div>
                            <label for="city" class="block">Choose City</label>
                            <select id="city"  name="city_id" class="w-2/3 px-2 p-1 rounded-lg capitalize bg-white mt-2">
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{ucfirst($city->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-wrap justify-evenly">
                            <div>
                                <label for="opens_at" class="block">Opens at:</label>
                                <input type="time" id="opens_at"   name="opens_at" class="px-2 p-1 rounded-lg mt-2">
                            </div>

                            <div>
                                <label for="closes_at" class="block">Closes at:</label>
                                <input type="time" id="closes_at"   name="closes_at" class="px-2 p-1 rounded-lg mt-2">
                            </div>
                        </div>

                        <div>
                            <label for="fb_link" class="block">Facebook Profile</label>
                            <input id="fb_link" type="text" name="fb_link" value="" class="w-full px-2 p-1 rounded-lg mt-2">
                        </div>

                        <div>
                            <label for="ig_link" class="block">Instagram Profile</label>
                            <input id="ig_link" type="text" name="ig_link" value="" class="w-full px-2 p-1 rounded-lg mt-2">
                        </div>

                    </div>

                    <div class="flex justify-end space-x-4 mt-3">
                        <a href="{{url()->previous()}}" class="rounded-lg shadow-lg px-2 py-1 border-2 bg-white border-red-400">Cancel</a>
                        <button class="rounded-lg shadow-lg px-2 py-1 border-2 bg-white border-green-400" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
