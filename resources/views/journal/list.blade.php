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
    @foreach($group as $g)
    <h2>{{$g->name}}</h2>
    <table class="table">
        <thead class="thead-dark">
          <tr class="fixed">
          <th >Имя танцора / Дата</th>      
          @for($i = 1;$i <= 31; $i++)
          <th>{{$i}}</th>
          @endfor
          </tr>
        </thead>
        <tbody>
        @foreach ($dancers as $item)
          @if(!isset($dancer_group[$g->id]))
            <?php break; ?>
          @endif
          @if(in_array($item->id,$dancer_group[$g->id]))
            <tr>
              <th >
              {{$item->name}}
              </th>
              
              @for($i = 1;$i <= 31; $i++)
              <td>
                @if(!empty($jounal_dancers[$g->id]))
                @foreach ($jounal_dancers[$g->id] as $key => $jd)
                    @if($key == $i && in_array($item->id,$jd))
                      <span style="color: rgb(17, 194, 111); font-size: 20px; font-weight: bold;">+</span>
                    @endif
                @endforeach
                @endif
              </td>
              @endfor
            </tr>
          @endif
        @endforeach
        </tbody>
      </table>
      @endforeach
    </div>
@endsection
<style>
  
  table, th, td {
    border: 1px solid grey !important;
  }
  thead {
    position: sticky;
    top: 0;
    background: #2B2F33;
    color: white;
    border-color:white;
  }
  .wrap {
    margin: 0 !important;
    padding: 0 !important;
  }
</style>