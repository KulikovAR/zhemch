@extends('layouts.app')

@section('content')
    <div class="wrap">
    <a class="btn btn-primary" href="{{route('type')}}">Назад</a>
    <form action="{{route('typecreatepost')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Название</label>
          <input type="text" name="name" class="form-control" id="exampleFormControlInput1" >
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
@endsection
