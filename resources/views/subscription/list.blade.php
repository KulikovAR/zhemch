@extends('layouts.app')

@section('content')
    <div class="wrap">
    <a class="btn btn-primary" href="{{route('dancercreate')}}">Создать нового танцора</a>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ФИО</th>
            <th scope="col">Телефон</th>
            <th scope="col">Дата рождения</th>
            <th scope="col">Имя родителя</th>
            <th scope="col">Примечание</th>
            <th scope="col">Обновить</th>
            <th scope="col">Удалить</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($dancers as $item)
         <tr>
            <th scope="row">{{$item->name}}</th>
            <td>{{$item->phone}}</td>
            <td>{{$item->birth}}</td>
            <td>{{$item->parent_name}}</td>
            <td>{{$item->comment}}</td>
            <td><a style="color: blue;" href="{{route('dancerupdate',$item->id)}}">Обновить</a></td>
            <td><a style="color: red;" href="{{route('dancerdelete',$item->id)}}">Удалить</a></td>
          </tr>
        @endforeach
       
        </tbody>
      </table>
    </div>
@endsection
