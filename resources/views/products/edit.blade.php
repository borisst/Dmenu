<x-app-layout>
    <div class="flex flex-wrap space-y-5 mx-auto relative justify-center">
        <div class="md:relative fixed md:py-2 py-3 px-10 rounded-b-lg w-full bg-green-300">
            navbar goes here
        </div>

        <div class="flex flex-wrap justify-center md:space-y-5 space-y-10">
            <div class="rounded-lg md:shadow-lg md:p-3 mx-auto">
                <p class="md:contents hidden md:text-lg text-sm">Editing
                    <a href="{{route('products.show', $product)}}" class="text-blue-400 capitalize">{{$product->name}}</a>
                </p>
            </div>

            <div class="w-full rounded-lg border-2 border-gray-200 shadow-lg p-5">
                <form action="{{route('products.update', $product)}}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="flex flex-col justify-center space-y-2">
                        <div class="mx-15">
                            <label for="name" class="block">Product Name</label>
                            <input id="name" type="text" name="name" value="{{$product->name}}" class="w-2/3 px-2 p-1 rounded-lg capitalize mt-2">
                        </div>

                        <div>
                            <label for="weight" class="block">Weight</label>
                            <input id="weight" type="number" name="weight" value="{{$product->weight}}" class="w-2/3 px-2 p-1 rounded-lg mt-2">
                        </div>

                        <div>
                            <label for="image" class="block">Image</label>
                            <input id="image" type="file" name="image" value="{{$product->image}}" class="w-full px-2 p-1 rounded-lg mt-2">
                        </div>

                        <div>
                            <label for="category" class="block">Category</label>
                            <select id="category"  name="category_id" class="w-2/3 px-2 p-1 rounded-lg capitalize bg-white mt-2">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($product->category_id == $category->id) selected @endif>{{ucfirst($category->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="description" class="block">Description</label>
                            <textarea rows="5" cols="20" id="description"   name="description" class="w-full px-2 p-1 rounded-lg mt-2">{{$product->description}}</textarea>
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
