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
<a href="{{route('products.create')}}">Add a new product</a> <br>

@if(session()->has('success'))
    {{session('success')}}
@endif

@foreach($products as $product)

    <h1><a href="{{route('products.show',$product->id)}}">{{$product->name}}</a> <br></h1>

    <img class="rounded-t-lg" src="{{asset('../images/' . $product->image)}}" alt=""/>
    <a href="{{route('products.edit',$product->id)}}">Edit</a> <br>
    <form action="{{route('products.delete',$product->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" name="submit" value="delete">
    </form>
@endforeach
</body>
</html>

