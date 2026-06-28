@extends('layouts.app')

@section('content')
    <div class="wrap">
    <a class="btn btn-primary" href="{{route('dancers')}}">Назад</a>
    <form action="{{route('dancerupdatepost')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">ФИО</label>
          <input type="text" value="{{$dancer->name}}" name="name" class="form-control" id="exampleFormControlInput1" >
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Дата рождения</label>
            <input type="text" class="form-control" value="{{$dancer->birth}}" name="birth" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Телефон родителя</label>
          <input type="text" class="form-control" value="{{$dancer->phone}}" name="phone" id="exampleFormControlInput1" >
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Имя родителя</label>
          <input type="text" class="form-control"  value="{{$dancer->parent_name}}" name="parent_name" id="exampleFormControlInput1" >
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Примечание</label>
            <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3">{{$dancer->comment}}</textarea>
          </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
@endsection