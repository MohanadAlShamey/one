@php

    $start=\Carbon\Carbon::createFromFormat('Y-m-d',date('Y-m-d',strtotime(auth()->user()->created_at)));
    $start2=\Carbon\Carbon::createFromFormat('Y-m-d',date('Y-m-d',strtotime(auth()->user()->created_at)));

             $now=\Carbon\Carbon::now();
             $reg_days=$now->diff($start);
             $reg_at=auth()->user()->reg_at;
             $jockes=\App\Joker::where([
            'user_id'=>auth()->id(),
            'status'=>'unactive'
            ])->count();
             $num_sat_sun=\App\Helpers\Helpers::get_num_sat_sun($start,\Carbon\Carbon::now()->startOfDay());
             $lesson=\App\Lesson::find(request()->id) ?? \App\Lesson::find(4);
 $num_day=\App\Helpers\Helpers::num_days_to_lesson($lesson);

@endphp

<p>تاريخ التسجيل: {{$start2}}</p>
<p>تاريخ اليوم: {{\Carbon\Carbon::now()->startOfDay()}}</p>
<p>الفرق بين التاريخين: {{$reg_days->days}}</p>
<p>عدد الأيام المضافة من المدير: {{$reg_at}}</p>
<p>عدد الجواكر: {{$jockes}}</p>
<p>عدد أيام العطل: {{$num_sat_sun}}</p>
<p>لايام المطلوبة للدرس: {{$num_day}}</p>