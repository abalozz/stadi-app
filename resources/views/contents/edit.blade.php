@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>{{ $content->course->name }}</h1>
        <a href="{{ route('course.show', $content->course->id) }}" class="btn btn-default">Volver a los contenidos</a>
        <form class="form-button" action="{{ route('content.destroy', $content->id) }}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    </div>

    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">Contenido</a></li>
        <li role="presentation"><a href="{{ route('question.index', $content->course->id) }}">Preguntas</a></li>
    </ul>

    <div class="col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        <h2>Editar contenido</h2>

        <form action="{{ route('content.update', $content->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="hidden" name="id" value="{{ $content->id }}">
            <input type="hidden" name="course_id" value="{{ $content->course->id }}">
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $content->title) }}">
            </div>
            <div class="form-group">
                <label for="body">Contenido</label>
                <textarea class="form-control" id="body" name="body">{{ old('body', $content->body) }}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publicar contenido</button>
            </div>
        </form>

        @include('partials.errors', ['text' => 'editar el contenido'])

        @if (Session::has('success'))
            <p class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>{{ Session::get('success') }}</strong>
            </p>
        @endif
    </div>
</div>
@endsection
