@extends('layouts.app')

@section('content')
    <div class="wrap">
    <a class="btn btn-primary" href="{{route('sub')}}">Назад</a>
    <form action="{{route('subupdatepost')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Название</label>
          <input type="text" value="{{$sub->name}}" name="name" class="form-control" id="exampleFormControlInput1" >
          <input type="number" value="{{$sub->count}}" name="count" class="form-control" id="exampleFormControlInput1" >
          <input type="number" value="{{$sub->price}}" name="price" class="form-control" id="exampleFormControlInput1" >
        </div>
        <input type="hidden" name="id" value="{{$sub->id}}">
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
@endsection