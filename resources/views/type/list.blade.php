@extends('layouts.app')

@section('content')
    <div class="wrap">
    <a class="btn btn-primary" href="{{route('typecreate')}}">Создать новое направление</a>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Название</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($type as $item)
         <tr>
            <th scope="row">{{$item->name}}</th>
            <td><a style="color: blue;" href="{{route('typeupdate',$item->id)}}">Обновить</a></td>
            <td><a style="color: red;" href="{{route('typedelete',$item->id)}}">Удалить</a></td>
          </tr>
        @endforeach
       
        </tbody>
      </table>
    </div>
@endsection
