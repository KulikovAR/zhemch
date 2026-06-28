@extends('layouts.app')

@section('content')
    <div class="wrap" style="min-width: ">
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
            <th scope="col">#</th>
            <th scope="col">ФИО</th>
           <!--  <th scope="col">Телефон</th>
            <th scope="col">Телефон вайбер</th>
            <th scope="col">Дата рождения</th>
            <th scope="col">Имя родителя</th>
            <th scope="col">Примечание</th>
            <th scope="col">Фотография</th> -->
            <th scope="col">Абонемент</th>
            <th scope="col">Оплата</th>
            <th scope="col">Посещение</th>
            <th scope="col">Долг</th>
            <th scope="col">Переплата</th>
          </tr>
        </thead>
        <tbody>
        <?php $count = 0;?>
        @foreach($groups as $group)
          <tr>
            <th style="font-size: 25px; color: blue;">{{$group->name}}</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          @foreach($dancer_groups as $dancer_group)
            @if($group->id == $dancer_group->group_id)
              @foreach ($dancers as $item)
                @if($dancer_group->dancer_id == $item->id)
                 <tr>
                   <?php $count++?>
                    <th>{{$count}}</th>
                    <th scope="row">{{$item->name}}</th>
                    <td>
                      @foreach ($sub as $value)
                          @if($value->id == $item->subscription_id)
                              {{$value->name}}
                          @endif
                      @endforeach
                    </td>
                    <td>
                      {{ $dancer_pay[$item->id]['payment'] }}
                    </td>
                    <td>
                      {{ $dancer_pay[$item->id]['hours'] }}
                    </td>
                    <td>
                      {{ $dancer_pay[$item->id]['dolg'] }}
                    </td>
                    <td>
                      {{ $dancer_pay[$item->id]['pere'] }}
                    </td>
                  </tr>
                @endif
              @endforeach
            @endif
          @endforeach
       @endforeach
        </tbody>
      </table>
    </div>
@endsection
