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
        <th><a class="">名前</a></th>
        <th><a class="">勤務開始</a></th>
        <th><a class="">勤務終了</a></th>
        <th><a class="">休憩時間</a></th>
        <th><a class="">勤務時間</a></th>
      </tr>
      @isset($items)
      <p hidden>{{$pageFirstId = $paginateInfo->firstItem()-1}}</p>
      @for($i = 0; $i < $paginateInfo->perPage(); $i++)
        <tr>
          @empty($items[$i + $pageFirstId])
          @break
          @endempty
          <td>{{$items[$i + $pageFirstId]['name']}}</td>
          <td>{{$items[$i + $pageFirstId]['start_work']}}</td>
          <td>{{$items[$i + $pageFirstId]['end_work']}}</td>
          <td>{{$items[$i + $pageFirstId]['break_time']}}</td>
          <td>{{$items[$i + $pageFirstId]['work_time']}}</td>
        </tr>
        @endfor
        @endisset
    </table>
    @isset($items)
    {{ $paginateInfo->links() }}
    @endisset
  </div>
</main>
@endsection