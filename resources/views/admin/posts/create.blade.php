@extends('layouts.admin')

@section('title', "Crea nuovo post")

@section('content')
    <div class="container">
        <h1>Pagina create della (C)RUD</h1>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">

                <ul>

                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach

                </ul>

            </div>
        @endif

        <form
        action="{{route('admin.posts.store')}}"
        method="POST"
        id="postsCreateForm">
            @csrf

            {{-- TITLE --}}
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text"
                value="{{old('title')}}"
                class="form-control @error('title') is-invalid @enderror"
                id="title" name="title"
                placeholder="Titolo">

                {{-- Errore gestito da Laravel --}}
                @error('title')
                <p class="text-danger">{{$message}}</p>
                @enderror

                {{-- Errore gestito da Jquery --}}
                <p class="text-danger" id="error-title"></p>

            </div>

            {{-- CONTENT --}}
            <div class="mb-3">
                <label for="content" class="form-label">Contenuto del post</label>
                <textarea class="form-control @error('content') is-invalid @enderror"
                name="content" id="content"
                cols="30" rows="10">{{old('content')}}</textarea>

                {{-- Errore gestito da Laravel --}}
                @error('content')
                <p class="text-danger">{{$message}}</p>
                @enderror

                {{-- Errore gestito da Jquery --}}
                <p class="text-danger" id="error-content"></p>
            </div>

            {{-- CATEGORY --}}
            <div class="mb-3">
                <select name="category_id" id="category_id" class="form-select">
                    <option value="" {{old('category_id') == null ? 'selected' : ''}} >Nessuna categoria</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{$category->id}}"
                            {{old('category_id') == $category->id ? 'selected' : ''}} >
                            {{$category->name}}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- TAG --}}
            <div class="mb-3">

                @foreach ($tags as $tag)
                    <input
                    type="checkbox"
                    name="tags[]"
                    id="tag{{$loop->iteration}}"
                    value="{{$tag->id}}"
                    {{in_array($tag->id, old('tags', []) ) ? 'checked' : '' }}>

                    <label for="tag{{$loop->iteration}}">{{$tag->name}}</label>
                @endforeach

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
@endsection
