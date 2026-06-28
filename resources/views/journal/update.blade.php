@extends('layouts.app')

@section('content')
    <div class="wrap">
    <a class="btn btn-primary" href="{{route('journalall')}}">Назад</a>
    <form action="{{route('journalupdatepost')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Дата</label>
          <input type="text" value="{{$journal->created_at}}" name="created_at" class="form-control" id="exampleFormControlInput1" >
        </div>
        <input type="hidden" value="{{$journal->id}}" name="id">
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
@endsection