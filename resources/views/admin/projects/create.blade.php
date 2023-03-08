@extends('layouts.admin')
@section('content')
<div class="container create">
    <div class="row">
        <div class="col-12 text-center m-4">
            <h2 class="text-white">Aggiungi nuovo project</h2>
        </div>
        <div class="col-12">
            <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label class="control-label mb-2">
                    Titolo
                </label>
                <input type="text" class="form-control" placeholder="Titolo" id="title" name="title">
                    @error('title')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
            </div>
            <div class="form-group mb-3">
                <label class="control-label mb-2">
                    Copertina
                </label>
                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image">
                @error('cover_image')
                <div class="alert alert-danger mt-2">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="control-label mb-2">
                    Difficoltà
                </label>
              <select class="form-control" name="type_id" id="type_id">
                @foreach($types as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3">
                <label class="control-label mb-2">
                    Tipo
                </label>
                @foreach($tags as $tag)
                <div class="form-check @error('tags') is-invalid @enderror">
                    {{-- Se può essere selezionato più di un valore devono essere messe le parentesi quadre nel name , crei tipo un'array--}}
                    <input class="form-check-input" type="checkbox" value={{$tag->id}} name="tags[]"> 
                    <label class="form-check-label">{{$tag->name}}</label>
                </div>
              @endforeach
              @error('tags')
                <div class="invalid-feedback">{{$message}}</div>
              @enderror
            </div>
            <div class="form-group mb-3">
                <label class="control-label mb-2">
                    Data
                </label>
                <input type="date" class="form-control" placeholder="Data" name="date_project">
                    @error('date_project')
                        <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
            </div>
            <div class="form-group mb-3">
                <label class="control-label mb-2">
                    Contenuto
                </label>
                <textarea type="text-area" class="form-control" placeholder="Contenuto" id="content" name="content"></textarea>
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btnblue">Salva</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection