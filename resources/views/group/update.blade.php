@extends('layouts.app')

@section('content')
    <div class="wrap">
    <a class="btn btn-primary" href="{{route('group')}}">Назад</a>
    <form action="{{route('groupupdatepost')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Название</label>
          <input type="text" value="{{$group->name}}" name="name" class="form-control" id="exampleFormControlInput1" >
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Время (в минутах)</label>
          <input type="text" value="{{$group->hours}}" name="hours" class="form-control" id="exampleFormControlInput1" >
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Направление</label>
          <select class="form-control" name="type_id">
              @foreach ($type as $item)
                  @if($item->id == $item->type_id)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @else 
                    <option value="{{$item->id}}">{{$item->name}}</option>
                  @endif
              @endforeach
          </select>
        </div>
        <input type="hidden" value="{{$group->id}}" name="id">
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
@endsection