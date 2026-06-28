@extends('layouts.app')

@section('content')
    <div class="wrap">
    <a class="btn btn-primary" href="{{route('dancers')}}">Назад</a>
    <form action="{{route('dancercreatepost')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">ФИО *</label>
          <input type="text" name="name" class="form-control" id="exampleFormControlInput1" >
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Дата рождения</label>
            <input type="text" class="form-control" name="birth" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Телефон родителя *</label>
          <input type="text" class="form-control" name="phone" id="exampleFormControlInput1" >
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">Телефон вайбер</label>
          <input type="text" class="form-control" name="viber_phone" id="exampleFormControlInput1" >
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Имя родителя *</label>
          <input type="text" class="form-control" name="parent_name" id="exampleFormControlInput1" >
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Примечание</label>
            <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Фотография</label>
          <input name="image" type="file">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Абонемент</label>
        <select class="form-control" name="subscription_id">
          @foreach ($sub as $value)
            <option  value="{{$value->id}}">{{$value->name}}</option>      
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <h2>Группы*</h2>
        @foreach($group as $item)
          <p> {{$item->name}}
          <input type="checkbox" name="group[]" value="{{$item->id}}">
          </p>
        @endforeach
     </div>
  
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
@endsection
