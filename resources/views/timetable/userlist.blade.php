@extends('layouts.mobile')


<?php 
        $time = [];
        foreach($timetable as $value) {
            $t_start = explode(":", $value->time_start);
            $time[$value->id]['time_start_sort'] = $t_start[0];
            $time[$value->id]['time_start'] = $value->time_start;
            $time[$value->id]['time_end'] = $value->time_end;
            $time[$value->id]['group_id'] = $value->group_id;
            $time[$value->id]['dancer_id'] = $value->dancer_id;
            $time[$value->id]['day'] = $value->day;
            $time[$value->id]['id'] = $value->id;
            }
            if (!empty($time)) {
                usort($time, function($a, $b) {
                    return $a['time_start_sort'] <=> $b['time_start_sort'];
                });
            }
   
?>

@section('content')
    <div class="wrap" style="color:white">
    
        <h1>Расписание </h1>
        <div class="day">
            <div class="day-head" style="background: #D1ACDC">
                Понедельник
            </div>
            @foreach ($time as $item)
                @if($item['day'] == 1)
                <div class="day-time">
                    <span class="time">{{$item['time_start']}}-{{$item['time_end']}}</span>
                    <span class="group">
                        <?php 
                            if ($item['group_id'] != 0) {
                                foreach ($group as $value) {
                                    if ($value->id == $item['group_id']) {
                                        foreach ($user_group as $ug) {
                                            if ($ug->group_id == $value->id && $ug->user_id == $user_id) {
                                                ?>
                                                <a class='btn btn-primary' href="{{route('journalcreate', $item['id'])}}">Провести</a>
                                                <a class='btn btn-primary' href="{{route('paymentcreate', $item['id'])}}">Оплата</a>
                                                <?php
                                            }
                                        }
                                        echo $value->name;
                                    }
                                }
                            } else {
                                foreach ($dancer as $value) {
                                    if ($value->id == $item['dancer_id']) {
                                        echo $value->name;
                                    }
                                }
                            }
                        ?>
                    </span>
                </div>
                @endif
            @endforeach
            <a class="btn btn-primary" href="{{route('timetableusercreate', ['room' => $room, 'day' => 1])}}">Создать новое занятие</a>
        </div>
        <div class="day">
            <div class="day-head" style="background: #8EACDC">
                Вторник
            </div>
            @foreach ($time as $item)
                @if($item['day'] == 2)
                <div class="day-time">
                    <span class="time">{{$item['time_start']}}-{{$item['time_end']}}</span>
                    <span class="group">
                        <?php 
                            if ($item['group_id'] != 0) {
                                foreach ($group as $value) {
                                    if ($value->id == $item['group_id']) {
                                        foreach ($user_group as $ug) {
                                            if ($ug->group_id == $value->id && $ug->user_id == $user_id) {
                                                ?>
                                                <a class='btn btn-primary' href="{{route('journalcreate', $item['id'])}}">Провести</a>
                                                <a class='btn btn-primary' href="{{route('paymentcreate', $item['id'])}}">Оплата</a>

                                                <?php
                                            }
                                        }
                                        echo $value->name;
                                    }
                                }
                            } else {
                                foreach ($dancer as $value) {
                                    if ($value->id == $item['dancer_id']) {
                                        echo $value->name;
                                    }
                                }
                            }
                        ?>
                    </span>
                </div>
                @endif
            @endforeach
            <a class="btn btn-primary" href="{{route('timetableusercreate', ['room' => $room, 'day' => 2])}}">Создать новое занятие</a>
        </div>
        <div class="day">
            <div class="day-head" style="background: #BCE19F">
                Среда
            </div>
           @foreach ($time as $item)
                @if($item['day'] == 3)
                <div class="day-time">
                    <span class="time">{{$item['time_start']}}-{{$item['time_end']}}</span>
                    <span class="group">
                        <?php 
                            if ($item['group_id'] != 0) {
                                foreach ($group as $value) {
                                    if ($value->id == $item['group_id']) {
                                        foreach ($user_group as $ug) {
                                            if ($ug->group_id == $value->id && $ug->user_id == $user_id) {
                                                ?>
                                                <a class='btn btn-primary' href="{{route('journalcreate', $item['id'])}}">Провести</a>
                                                <a class='btn btn-primary' href="{{route('paymentcreate', $item['id'])}}">Оплата</a>

                                                <?php
                                            }
                                        }
                                        echo $value->name;
                                    }
                                }
                            } else {
                                foreach ($dancer as $value) {
                                    if ($value->id == $item['dancer_id']) {
                                        echo $value->name;
                                    }
                                }
                            }
                        ?>
                    </span>
                </div>
                @endif
            @endforeach
            <a class="btn btn-primary" href="{{route('timetableusercreate', ['room' => $room, 'day' => 3])}}">Создать новое занятие</a>
        </div>
        <div class="day">
            <div class="day-head" style="background:  #E7E789">
                Четверг
            </div>
            @foreach ($time as $item)
                @if($item['day'] == 4)
                <div class="day-time">
                    <span class="time">{{$item['time_start']}}-{{$item['time_end']}}</span>
                    <span class="group">
                        <?php 
                            if ($item['group_id'] != 0) {
                                foreach ($group as $value) {
                                    if ($value->id == $item['group_id']) {
                                        foreach ($user_group as $ug) {
                                            if ($ug->group_id == $value->id && $ug->user_id == $user_id) {
                                                ?>
                                                <a class='btn btn-primary' href="{{route('journalcreate', $item['id'])}}">Провести</a>
                                                <a class='btn btn-primary' href="{{route('paymentcreate', $item['id'])}}">Оплата</a>

                                                <?php
                                            }
                                        }
                                        echo $value->name;
                                    }
                                }
                            } else {
                                foreach ($dancer as $value) {
                                    if ($value->id == $item['dancer_id']) {
                                        echo $value->name;
                                    }
                                }
                            }
                        ?>
                    </span>
                </div>
                @endif
            @endforeach
            <a class="btn btn-primary" href="{{route('timetableusercreate', ['room' => $room, 'day' => 4])}}">Создать новое занятие</a>
        </div>
        <div class="day">
            <div class="day-head" style="background: #FF8B9F">
                Пятница
            </div>
            @foreach ($time as $item)
                @if($item['day'] == 5)
                <div class="day-time">
                    <span class="time">{{$item['time_start']}}-{{$item['time_end']}}</span>
                    <span class="group">
                        <?php 
                            if ($item['group_id'] != 0) {
                                foreach ($group as $value) {
                                    if ($value->id == $item['group_id']) {
                                        foreach ($user_group as $ug) {
                                            if ($ug->group_id == $value->id && $ug->user_id == $user_id) {
                                                ?>
                                                <a class='btn btn-primary' href="{{route('journalcreate', $item['id'])}}">Провести</a>
                                                <a class='btn btn-primary' href="{{route('paymentcreate', $item['id'])}}">Оплата</a>

                                                <?php
                                            }
                                        }
                                        echo $value->name;
                                    }
                                }
                            } else {
                                foreach ($dancer as $value) {
                                    if ($value->id == $item['dancer_id']) {
                                        echo $value->name;
                                    }
                                }
                            }
                        ?>
                    </span>
                </div>
                @endif
            @endforeach
            <a class="btn btn-primary" href="{{route('timetableusercreate', ['room' => $room, 'day' => 5])}}">Создать новое занятие</a>
        </div>

        <div class="day">
            <div class="day-head" style="background: #B2DEDE">
                Суббота
            </div>
            @foreach ($time as $item)
                @if($item['day'] == 6)
                <div class="day-time">
                    <span class="time">{{$item['time_start']}}-{{$item['time_end']}}</span>
                    <span class="group">
                        <?php 
                            if ($item['group_id'] != 0) {
                                foreach ($group as $value) {
                                    if ($value->id == $item['group_id']) {
                                        foreach ($user_group as $ug) {
                                            if ($ug->group_id == $value->id && $ug->user_id == $user_id) {
                                                ?>
                                                <a class='btn btn-primary' href="{{route('journalcreate', $item['id'])}}">Провести</a>
                                                <a class='btn btn-primary' href="{{route('paymentcreate', $item['id'])}}">Оплата</a>

                                                <?php
                                            }
                                        }
                                        echo $value->name;
                                    }
                                }
                            } else {
                                foreach ($dancer as $value) {
                                    if ($value->id == $item['dancer_id']) {
                                        echo $value->name;
                                    }
                                }
                            }
                        ?>
                    </span>
                </div>
                @endif
            @endforeach
            <a class="btn btn-primary" href="{{route('timetableusercreate', ['room' => $room, 'day' => 6])}}">Создать новое занятие</a>
        </div>
        <div class="day">
            <div class="day-head" style="background: #FFC9FF">
                Воскресенье
            </div>
            @foreach ($time as $item)
                @if($item['day'] == 7)
                <div class="day-time">
                    <span class="time">{{$item['time_start']}}-{{$item['time_end']}}</span>
                    <span class="group">
                        <?php 
                            if ($item['group_id'] != 0) {
                                foreach ($group as $value) {
                                    if ($value->id == $item['group_id']) {
                                        foreach ($user_group as $ug) {
                                            if ($ug->group_id == $value->id && $ug->user_id == $user_id) {
                                                ?>
                                                <a class='btn btn-primary' href="{{route('journalcreate', $item['id'])}}">Провести</a>
                                                <a class='btn btn-primary' href="{{route('paymentcreate', $item['id'])}}">Оплата</a>

                                                <?php
                                            }
                                        }
                                        echo $value->name;
                                    }
                                }
                            } else {
                                foreach ($dancer as $value) {
                                    if ($value->id == $item['dancer_id']) {
                                        echo $value->name;
                                    }
                                }
                            }
                        ?>
                    </span>
                </div>
                @endif
            @endforeach
            <a class="btn btn-primary" href="{{route('timetableusercreate', ['room' => $room, 'day' => 7])}}">Создать новое занятие</a>
        </div>
    </div>
@endsection
<style>
    .day {
        width: 100%;
        padding: 10px;
    }
    .day-head {
        width: 100%;
        height: 80px;
        color: white;
        display: flex;
        align-items: center;
        padding: 20px;
        font-size: 20px;
    }
    .day-time {
        font-size: 20px;
        display: flex;
        justify-content: space-between;
        padding: 20px;
        border-bottom: 1px solid grey;
    }
    .btn {
        margin-top: 10px !important;
    }
</style>