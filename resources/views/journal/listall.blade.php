@extends('layouts.app')

@section('content')
    <div class="wrap">
    <form  action="" method="GET">
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Месяц</label>
          <select class="form-control" name="m">
            <option value="1">Прошлый месяц</option>
            <option value="2">Позапрошлый месяц</option>
          </select>
        </div>
        <button style="margin-top: 20px;" type="submit" class="btn btn-primary">Фильтр</button>
    </form>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Группа</th>
            <th>Присутсвующие</th>
            <th>Дата</th>
            <th>Обновить</th>
            <th>Удалить</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($journal as $item)
         <tr>
             <td>
             @foreach ($group as $g)
                @if($g->id == $item->group_id)
                    {{$g->name}}
                @endif
             @endforeach

             </td>
             <td>
               <?php 
                $dancer = json_decode($item->dancers_id);
                foreach ($dancer as $d) {
                    foreach ($dancers as $ds) {
                        if ($ds->id == $d) {
                            ?>
                            - {{$ds->name}} <br>
                            <?php
                        }
                    }
                }
               ?>
   
                </td>
                <td>{{$item->created_at}}</td>
                <td><a style="color: blue;" href="{{route('journalupdate',$item->id)}}">Обновить</a></td>
                <td><a style="color: red;" href="{{route('journaldelete',$item->id)}}">Удалить</a></td>

          </tr>
        @endforeach
       
        </tbody>
      </table>
    </div>
@endsection
