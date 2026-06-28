@extends('layouts.app')

@section('content')
    <div class="wrap">
    <a class="btn btn-primary" href="{{route('trainer')}}">Назад</a>
    <form action="{{route('trainerupdatepost')}}" method="POST">
        @csrf
        <div class="form-group">
          <label>Ставка</label>
          <input value="{{$user->per}}" class="form-control" type="number" name="per">
          <br>
          <h2>Группы тренера</h2>
          @foreach($group as $item)
          <?php $check = ''; ?>
            @foreach ($user_group as $ug)
            <?php 
              if ($ug->group_id == $item->id) {
                  $check = 'checked';
              } 
            ?>
            @endforeach
            <p> {{$item->name}}
             <input {{$check}} type="checkbox" name="group[]"  value="{{$item->id}}">
            </p>
          @endforeach
       </div>
        <input type="hidden" value="{{$user->id}}" name="id">
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
@endsection