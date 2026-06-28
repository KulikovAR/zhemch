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
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Фотография</label>
            <input name="image" type="file">
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Абонемент</label>
          <select class="form-control" name="subscription_id">
            @foreach ($sub as $value)
              @if ($value->id == $dancer->subscription_id)
                <option selected value="{{$value->id}}">{{$value->name}}</option>  
              @else
                <option value="{{$value->id}}">{{$value->name}}</option>   
              @endif    
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Группы</label>
          @foreach($group as $item)
          <?php $check = ''; ?>
            @foreach ($dancer_group as $dg)
            <?php 
              if ($dg->group_id == $item->id) {
                  $check = 'checked';
              } 
            ?>
            @endforeach
            <p> {{$item->name}}
             <input {{$check}} type="checkbox" name="group[]"  value="{{$item->id}}">
            </p>
          @endforeach
       </div>
        <input type="hidden" value="{{$dancer->id}}" name="id">
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
@endsection