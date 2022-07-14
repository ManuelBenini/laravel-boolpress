@extends('layouts.admin')

@section('title', "Lista post")

@section('content')
    <h1>Pagina index della C(R)UD</h1>

    @if (session('delete_success'))
        <div class="alert alert-danger d-flex justify-content-between" role="danger">
            {{session('delete_success')}}
            <a class="btn btn-danger" href="{{route('admin.posts.index')}}">X</a>
        </div>
    @endif

    <table class="table">

        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Categoria</th>
            <th scope="col">Tag</th>
            <th scope="col">Azioni</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->title}}</td>

                    <td>{{$post->category ? $post->category->name : 'Nessuna categoria'}}</td>

                    <td>
                        @forelse ($post->tags as $tag)
                            <span class="badge badge-pill badge-success">{{$tag->name}}</span>
                        @empty
                            <span>Nessuna categoria</span>
                        @endforelse
                    </td>

                    <td>
                        <a class="btn btn-success" href="{{route('admin.posts.show', $post)}}">Mostra</a>
                        <a class="btn btn-primary" href="{{route('admin.posts.edit', $post)}}">Modifica</a>

                        <form class="d-inline"
                        action="{{route('admin.posts.destroy', $post)}}"
                        method="POST"
                        onsubmit="return confirm('sei sicuro di voler cancellare il post?')">
                            @csrf
                            @method("DELETE")

                            <button type="submit" class="btn btn-danger">Cancella</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>


    </table>

    {{$posts->links()}}

    <div>
        <h2 class="mb-5">Lista pagina divise per categorie</h2>

        @foreach ($categories as $category)
            <h3>{{$category->name}}</h3>

            <ul>

                @forelse ($category->posts as $post)
                    <li> <a href="{{route('admin.posts.show', $post)}}"> {{$post->title}} </a> </li>
                @empty
                    <li> Non sono presenti post per questa categoria </li>
                @endforelse

            </ul>

        @endforeach

    </div>
@endsection
