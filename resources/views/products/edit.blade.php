<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Edit product</h1>

<form action="{{route('products.update',$product->id)}}" method="POST">
    @csrf
    @method('PATCH')
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="{{$product->name}}"><br>

    <label for="price">Price</label><br>
    <input type="text" id="price" name="price" value="{{$product->price}}"><br>

    <label for="category">Category</label><br>
    <input type="text" id="category" name="category" value="{{$product->category}}"><br>

    <label for="weight">Weight</label><br>
    <input type="text" id="weight" name="weight" value="{{$product->weight}}"><br>

    <label for="description">Description</label><br>
    <input type="text" id="description" name="description" value="{{$product->description}}"><br>

    <div class="m-5 text-white p-6 max-w-sm bg-white rounded-lg border border-white shadow-md ">

        <img src="{{asset('../images/' . $product->image)}}" alt="image">
        <input value="{{$product->image}}" type="file" name="image">
    </div>

    <input type="submit">
</form>

</body>
</html>
