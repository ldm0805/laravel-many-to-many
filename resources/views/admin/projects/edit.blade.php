@extends('layouts.admin')
@section('content')
<div class="container edit">
    <div class="row">
        <div class="col-12 text-center m-4">
            <h2 class="text-white">Modifica questo project</h2>
        </div>
        <div class="col-12">
            <form action="{{route('admin.projects.update', $project->slug)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label class="control-label mb-2">
                    Titolo
                </label>
                <input type="text" class="form-control" placeholder="Titolo" id="title" name ="title" value="{{old('title') ?? $project->title}}">
                    @error('title')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
            </div>
            <div class="form-group mb-3">
                <label class="control-label mb-2">
                    Categoria
                </label>
              <select class="form-control" name="type_id" id="type_id">
                @foreach($types as $type)
                <option value="{{$type->id}}" {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>{{$type->name}}</option>
                @endforeach
              </select>
              @error('type_id')
                <div class="alert alert-danger mt-2">{{$message}}</div>
              @enderror
            </div>
            <div class="form-group mb-3">
                <label class="control-label mb-2">
                    Tipo
                </label>
                @foreach($tags as $tag)
                <div class="form-check @error('tags') is-invalid @enderror">
                    {{-- primo caso 
                        ci sono degli errori di validazione quindi bisona ricaricare i tag selezionati tramite la finzione old()--}}
                        @if($errors->any())
                            <input type="checkbox" value={{$tag->id}} name="tags[]" {{in_array($tag->id, old('tags', [])) ? 'checked' : ''}} class="form-check-input"> 
                            <label class="form-check-label">{{$tag->name}}</label>
                        {{-- Secondo caso 
                            se non sono presenti errori di validazione significa che la pagina è stata aperta per la prima volta, quindi bisogna recuperare i tag in relazione col project--}}
                        @else
                        <input type="checkbox" value={{$tag->id}} name="tags[]" {{$project->tags->contains($tag) ? 'checked' : ''}} class="form-check-input"> 
                        <label class="form-check-label">{{$tag->name}}</label>
                        @endif
                    {{-- Se può essere selezionato più di un valore devono essere messe le parentesi quadre nel name , crei tipo un'array--}}
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
                <input type="date" class="form-control" placeholder="Data" name="date_project" value="{{old('date_project') ?? $project->date_project}}">
                    @error('date_project')
                        <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
            </div>
            <div class="form-group mb-3">
                <label class="control-label mb-2">
                    Contenuto
                </label>
                <textarea type="text-area" class="form-control" placeholder="Contenuto" id="content" name ="content">{{old('content') ?? $project->content}}</textarea>
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btnblue">Salva</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection