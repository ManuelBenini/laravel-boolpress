@extends('layouts.admin')

@section('title', "Post $post->title")

@section('content')
    <div class="container">
        <h1 class="mb-5">Pagina show della C(R)UD</h1>

        <h1>Titolo: {{$post->title}}</h1>
        <h1 class="my-4">Categoria: {{$post->category ? $post->category->name : 'Questo post non ha nessuna categoria'}}</h1>
        <h1 class="my-4">
            Tag:
            @forelse ($post->tags as $tag)
                <span class="badge badge-pill badge-success">{{$tag->name}}</span>
            @empty
                <span>Nessun tag</span>
            @endforelse
        </h1>

        <p>Contenuto: {{$post->content}}</p>

        {{-- Bottoni --}}
        <a class="btn btn-primary" href="{{route('admin.posts.index')}}">Torna all'elenco</a>
        <a class="btn btn-success" href="{{route('admin.posts.edit', $post)}}">Modifica</a>

        <form class="d-inline"
        action="{{route('admin.posts.destroy', $post)}}"
        method="POST"
        onsubmit="return confirm('sei sicuro di voler cancellare il post?')">
            @csrf
            @method("DELETE")

            <button type="submit" class="btn btn-danger">Cancella</button>
        </form>

    </div>
@endsection
