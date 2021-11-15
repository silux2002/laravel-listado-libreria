@extends('recursos.base')

@section('content')
<h1>{{ $empresa }}</h1>

<form action="{{ url('libros/' . $libro['id']) }}" method="post">
    @csrf
    @method('put')
    <input value="{{ old('id', $libro['id']) }}" type="hidden" name="id" placeholder="#id positive integer" required/>
    <input value="{{ old('name', $libro['name']) }}" type="text" name="name" placeholder="Name of the resource" nim-length="5" max-length="30" required/>
    <input value="{{ old('precio', $libro['precio']) }}" type="number" name="precio" placeholder="Precio del libro" step=".01" required/>
    <input type="submit" value="Create"/>
</form>
@endsection