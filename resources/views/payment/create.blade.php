@extends('layouts.mobile')

@section('content')
    <div class="wrap">
        <h1 style="color: white;">Оплата</h1>
    <form style="padding: 20px; color:white; font-size: 25px;" action="{{route('paymentcreatepost')}}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{$id}}">
        @foreach ($dancers as $item)
        <div class="row-pay">
        <p> {{$item->name}}   
            <input type="number"  name="dancers[{{$item->id}}]">
            Долг:
            <input type="checkbox"  name="dolg[{{$item->id}}]">
        </p>
        </div>
        @endforeach
        <button style="margin-top: 20px;" type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
@endsection
<style>
    .row-pay {
        display:flex;
        flex-direction: column;
        width: 70%;
        margin-bottom: 20px;
    }
</style>