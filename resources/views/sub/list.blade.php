@extends('layouts.app')

@section('content')
    <div class="wrap">
    <a class="btn btn-primary" href="{{route('subcreate')}}">Создать новый абонемент</a>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Название</th>
            <th scope="col">Количество</th>
            <th scope="col">Цена</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($sub as $item)
         <tr>
            <th scope="row">{{$item->name}}</th>
            <th scope="row">{{$item->count}}</th>
            <th scope="row">{{$item->price}}</th>
            <td><a style="color: blue;" href="{{route('subupdate',$item->id)}}">Обновить</a></td>
            <td><a style="color: red;" href="{{route('subdelete',$item->id)}}">Удалить</a></td>
          </tr>
        @endforeach
       
        </tbody>
      </table>
    </div>
@endsection
