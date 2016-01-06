@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>Crear nuevo curso</h1>
        <a href="/admin/cursos" class="btn btn-default">Volver a la lista de cursos</a>
    </div>

    @if (count($errors) > 0)
        <!-- Form Error List -->
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><strong>No se ha podido crear el curso</strong> por los siguientes motivos:</p>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/admin/cursos" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Nombre" name="name" value="{{ old('name') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Crear curso</button>
            </div>
        </div>
    </form>
</div>
@endsection