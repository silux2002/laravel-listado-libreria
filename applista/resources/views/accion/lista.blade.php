@extends('recursos.base')

@section('content')
<!-- nuevo 1 -->
<div class="modal" id="modalDelete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Confirm delete?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="modalDeleteResourceForm" action="" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Delete resource"/>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- fin nuevo 1 -->
<h1>{{'empresa'}}</h1>
@isset($alerta)
    <div class="alert alert-danger" role="alert">
        {{$alerta}}
    </div>
@endisset
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">precio(€)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($biblioteca as $libro)
        <tr>
            <td>
                {{ $libro['id'] }}
            </td>
            <td>
                {{ $libro['name'] }}
            </td>
            <td>
                {{ $libro['precio'] }}
            </td>
            <td>
                <a href="{{url('libros/'. $libro['id'] . '/edit')}}">edit</a>
            </td>
            <td>
              <form class="deleteForm" action="{{ url('libros/' . $libro['id']) }}" method="post">
                  @method('delete')
                  @csrf
                  <input type="submit" value="delete"/>
              </form>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>
<a href="{{url('libros/create')}}" class="btn btn-primary btn-lg">Incluir un nuevo libro a la lista</a>
<form id="deleteResourceForm" action="" method="post">
    @method('delete')
    @csrf
</form>
@endsection
@section('js')
<script src="{{ url('assets/js/delete.js') }}"></script>
@endsection