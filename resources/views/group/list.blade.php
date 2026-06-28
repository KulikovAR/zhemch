@extends('layouts.app')

@section('content')
    <div class="wrap">
    <a class="btn btn-primary" href="{{route('groupcreate')}}">Создать новую группу</a>
    <h2>Сумма оплат: {{$payment_price}} руб.</h2>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Название</th>
            <th>Время (в минутах)</th>
            <th> Направление</th>
            <th>Танцоры</th>
            <th>Оплата</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($group as $item)
         <tr>
            <th scope="row">{{$item->name}}</th>
            <th scope="row">{{$item->hours}}</th>
            <td>
              @foreach ($type as $value)
                @if($item->type_id == $value->id) 
                  {{$value->name}}
                @endif   
              @endforeach
            </td>
            <td>
              <details>
               <summary>Танцоры.</summary>

              <?php $count = 0?>
              @foreach ($dancer_group as $value)
                  @if($value->group_id == $item->id)
                    @foreach ($dancer as $d)
                      @if($value->dancer_id == $d->id)
                        <?php $count++?>
                        {{$count}} - {{$d->name}}
                        <br>
                      @endif
                    @endforeach
                  @endif
              @endforeach
              </details>
            </td>
            <td><a class="btn btn-primary" href="{{route('payment', $item->id)}}">История оплаты</a></td>
            <td><a style="color: blue;" href="{{route('groupupdate',$item->id)}}">Обновить</a></td>
            <td><a style="color: red;" href="{{route('groupdelete',$item->id)}}">Удалить</a></td>
          </tr>
        @endforeach
       
        </tbody>
      </table>
    </div>
@endsection
