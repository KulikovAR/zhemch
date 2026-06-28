@extends('layouts.app')

@section('content')
    <div class="wrap">

    <form action="{{route('timetablecreatepost')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Время</label>
          <input name="hour_start" type="number" min="0" max="24" placeholder="ч.">
          <input name="min_start" type="number"  min="0" max="60" step="15" placeholder="м."> :
          <input name="hour_end" type="number" min="0" max="24" placeholder="ч.">
          <input name="min_end" type="number" min="0" max="60" step="15" placeholder="м.">
        </div>
        <input type="hidden" name="def" value="0">
        <input type="hidden" name="room" value="{{$room}}">
        <input type="hidden" name="day" value="{{$day}}">

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Выбрать группу</label>
          <select class="form-control"  name="group_id">
            <option value="0"></option>
            @foreach ($group as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Выбрать танцора</label>
          <select class="form-control"  name="dancer_id">
            <option value="0"></option>
            @foreach ($dancer as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Комментарий</label>
            <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
@endsection
