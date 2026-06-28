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
            <th scope="col">Имя тренера</th>
            <th>Группы</th>
            <th>Задолженность</th>
            <th>Подтвердить</th>
            <th>Снять задолженность</th>
            <th>Зарплата</th>
            <th>Ставка</th>
            <th>Изменить</th>
            <th>Удалить</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($user as $item)
         <tr>
            <th scope="row">{{$item->name}}</th>
            <td>
                @foreach ($group as $g)
                    @foreach ($user_group as $ug)
                        @if ($item->id == $ug->user_id && $ug->group_id == $g->id)
                            - {{$g->name}} <br>
                        @endif
                    @endforeach
                @endforeach
            </td>
            <td>{{$item->balance}}</td>
            <td>
                @if($item->role == 0)
                    <a style="color: blue;" href="{{route('trainerconfirm',$item->id)}}">Подтвердить</a>
                @endif
            </td>
            <td><a class="btn btn-primary" href="{{route('trainerbalance',$item->id)}}">Снять задолженность</a></td>
            <td>
              {{$salary[$item->id]}}
            </td>
            <td>{{$item->per}}</td>
            <td><a style="color: blue;" href="{{route('trainerupdate',$item->id)}}">Изменить</a></td>
            <td><a style="color: red;" href="{{route('trainerdelete',$item->id)}}">Удалить</a></td>
          </tr>
        @endforeach
       
        </tbody>
      </table>
    </div>
@endsection
