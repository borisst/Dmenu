
<x-app-layout>
    <section class="bg-gray-800 body-font max-w-md mx-auto">

        {{--        Nav Menu--}}
        <div class="container mx-auto flex flex-wrap">
            <div class="flex flex-wrap place-content-center w-full text-orange-300 px-10 py-8 mb-2 bg-black">
                <div>
                    <img class="object-fill w-full h-12" src="https://dummyimage.com/100" alt="Company Name">
                </div>
            </div>


            <div class="container px-2 mx-auto flex flex-wrap">
                @foreach($products as $product)
                    <div class="flex flex-row justify-left items-center w-full relative mb-2 bg-black">
                        <div>
                            <img class="object-fill" src="{{$product->image}}" alt="">
                        </div>
                        <div class="pl-5 z-10 w-full">
                            <a href="{{route('products.show',$product->id)}}"
                               class="text-orange-200 capitalize">{{$product->name}}</a>
                        </div>
                        <div>
                        <p class="text-white">{{$product->pivot->price}}ден.</p>
                        </div>
                        </div>
                @endforeach

            </div>
        <div class="container mx-auto h-full flex flex-row">

            <div class="basis-3/4">
                <div class="flex flex-col w-full text-gray-500 px-10 bg-black">

                    <div class="flex items-center space-x-2 align-middle pt-2 text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="">
                            {{$company->opens_at . ' ' . ':' . ' ' . $company->closes_at}}
                        </p>
                    </div>

                    <div class="flex items-center space-x-2 align-middle py-2 text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042
                              11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <p class="">
                            {{$company->contact_number}}
                        </p>
                    </div>
                </div>
            </div>

            <div class="basis-1/4">
                <div class="flex flex-row text-gray-500 w-full h-full px-10 bg-black space-x-8 items-center">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <a xlink:href="{{$company->ig_link}}">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069
                            4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204
                            0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </a>
                        </svg>
                    </div>

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="gray" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <a href="{{$company->fb_link}}">
                                <path
                                    d="M21,1H3A2,2,0,0,0,1,3V21a2,2,0,0,0,2,2h7.5a.5.5,0,0,0,.5-.5v-7a.5.5,0,0,0-.5-.5h-1a.5.5,0,0,1-.5-.5v-3a.5.5,0,0,1,.5-.5h1a.5.5,0,0,0,.5-.5v-1A4.5,4.5,0,0,1,15.5,5h3a.5.5,0,0,1,.5.5v3a.5.5,0,0,1-.5.5h-3a.5.5,0,0,0-.5.5v1a.5.5,0,0,0,.5.5h3a.5.5,0,0,1,.49.58l-.5,3A.5.5,0,0,1,18,15H15.5a.5.5,0,0,0-.5.5v7a.5.5,0,0,0,.5.5H21a2,2,0,0,0,2-2V3A2,2,0,0,0,21,1Z"
                                />
                            </a>

                        </svg>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</x-app-layout>





