@extends('layouts.app')

@section('content')
    <div class="wrap">
    <a class="btn btn-primary" href="{{route('sub')}}">Назад</a>
    <form action="{{route('subcreatepost')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Название</label>
          <input type="text" name="name" class="form-control" id="exampleFormControlInput1" >
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Количество</label>
          <input type="text" name="count" class="form-control" id="exampleFormControlInput1" >
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Цена</label>
          <input type="text" name="price" class="form-control" id="exampleFormControlInput1" >
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
@endsection
