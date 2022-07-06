@extends('layouts.base')

@section('content')
<main>
  <div class="container">
    <h1 class="date">{{"{$date}の勤務一覧"}}</h1>
    <form method="post" action="/attendance">
      @csrf
      <laval for="date" class="">日付を選択して下さい。</laval>
      <input type="date" name="date" value="date" id="date" class="">
      <button class="">検索</button>
    </form>
    <table>
      <tr>
        <th><a href="/attendance?sort=name" class="">名前</a></th>
        <th><a href="/attendance?sort=start_work" class="">勤務開始</a></th>
        <th><a href="/attendance?sort=end_work" class="">勤務終了</a></th>
        <th><a href="/attendance?sort=break_time" class="">休憩時間</a></th>
        <th><a href="/attendance?sort=work_time" class="">勤務時間</a></th>
      </tr>
      @isset($items)
      <p hidden>{{$num = $paginateInfo->firstItem()-1}}</p>
      @for($i = 0; $i < $paginateInfo->perPage(); $i++)
        <tr>
          @empty($items[$i + $num])
          @break
          @endempty
          {{ddd($items)}}
          <td>{{$items[$i + $num]['name']}}</td>
          <td>{{$items[$i + $num]['start_work']}}</td>
          <td>{{$items[$i + $num]['end_work']}}</td>
          <td>{{$items[$i + $num]['break_time']}}</td>
          <td>{{$items[$i + $num]['work_time']}}</td>
        </tr>
        @endfor
        @endisset
    </table>
    @isset($items)
    {{ $paginateInfo->appends(['sort' => $sort])->links() }}
    @endisset
  </div>
</main>
@endsection