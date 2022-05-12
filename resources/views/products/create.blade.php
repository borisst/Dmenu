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
<h1>Add product</h1>
<form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>

    <label for="category">Category</label><br>
    <input type="text" id="category" name="category"><br>

    <label for="weight">Weight</label><br>
    <input type="text" id="weight" name="weight"><br>

    <label for="description">Description</label><br>
    <input type="text" id="description" name="description"><br>

    <label for="image">Upload an Image</label><br>
    <input type="file" name="image"> <br>

    <input type="submit">

    @if(session()->has('success'))
        <p>{{ session('success') }}</p>
    @endif
    @if(session()->has('error'))
        <p>{{ session('error') }}</p>
    @endif
</form>
</body>
</html>
