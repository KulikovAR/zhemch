@extends('layouts.app')

@section('content')
    <div class="wrap">
    <a class="btn btn-primary" href="{{route('group')}}">Назад</a>
    <form action="{{route('groupcreatepost')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Название</label>
          <input type="text" name="name" class="form-control" id="exampleFormControlInput1" >
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Время (в минутах)</label>
          <input type="number" name="hours" class="form-control" id="exampleFormControlInput1" >
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Направление</label>
          <select class="form-control" name="type_id">
              @foreach ($type as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
          </select>
        </div>

          <button type="submit" class="btn btn-primary">Сохранить</button>

      </form>
    </div>
@endsection
