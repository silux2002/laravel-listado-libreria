
@extends('recursos.base')

@section('content')
<h1>{{ $empresa }}</h1>

<form action="{{ url('libros') }}" method="post">
    @csrf
    <input value="{{ $id }}" type="hidden" name="id"/>
    <input value="{{ old('name') }}" type="text" name="name" placeholder="Nombre del libro" nim-length="5" max-length="30" required/>
    <input value="{{ old('precio') }}" type="number" name="precio" placeholder="Precio del libro" step=".01" required/>
    <input type="submit" value="Create"/>
</form>
@endsection