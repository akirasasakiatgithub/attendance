@extends('layouts.base')

@section('content')
<main>
  <div class="container">
    <h1 class="date">{{"{$name}の勤務一覧"}}</h1>
    <form method="post" action="/person">
      @csrf
      <laval for="date" class="">日付を選択して下さい。</laval>
      <input type="date" name="date" value="date" id="date" class="">
      <button class="">検索</button>
    </form>
    <table>
      <tr>
        <th><a class="">勤務日</a></th>
        <th><a class="">勤務開始</a></th>
        <th><a class="">勤務終了</a></th>
        <th><a class="">休憩時間</a></th>
        <th><a class="">勤務時間</a></th>
      </tr>
      @isset($items)
      @foreach($items as $item)
      <tr>
        <td>{{$item['idlist_a']}}</td>
        <td>{{$item['start_work']}}</td>
        <td>{{$item['end_work']}}</td>
        <td>{{$item['break_time']}}</td>
        <td>{{$item['work_time']}}</td>
      </tr>
      @endforeach
      @endisset
    </table>
    {{ $items->links('vendor.pagination.bootstrap-4') }}
  </div>
</main>
@endsection