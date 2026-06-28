@extends('layouts.mobile')

@section('content')
    <div class="wrap">
        <h1 style="color: white;">Отметить присутствующих</h1>
    <form style="padding: 20px; color:white; font-size: 25px;" action="{{route('journalcreatepost')}}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{$id}}";
        @foreach ($dancers as $item)
        <p> {{$item->name}}   
            <input type="checkbox" value="{{$item->id}}" name="dancers[]">
        </p>
        @endforeach
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
@endsection
