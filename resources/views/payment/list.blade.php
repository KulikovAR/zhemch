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
            <th scope="col">Кто принял</th>
            <th>Танцор</th>
            <th>Количество</th>
            <th>Дата</th>
            <th>Удалить</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($payment as $item)
         <tr>
             <td>
             @foreach ($group as $g)
                @if($g->id == $item->group_id)
                    {{$g->name}}
                @endif
             @endforeach

             </td>
             <td>
             @foreach ($user as $u)
                @if($u->id == $item->trainer_id)
                    {{$u->name}}
                @endif
             @endforeach

             </td>
             <td>{{$item->count}}</td>
             <td>
               <?php 
                foreach ($dancer as $d) {
                
                    if ($item->dancer_id == $d->id) {
                        ?>
                        - {{$d->name}} <br>
                        <?php
                    }
                }
               ?>
   
                </td>
                <td>{{$item->created_at}}</td>
       			<td><a href="{{route('paymentdelete', $item->id)}}" style="color: red">Удалить</a></td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
@endsection
