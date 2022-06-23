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
        <th>勤務日</th>
        <th>勤務開始</th>
        <th>勤務終了</th>
        <th>休憩時間</th>
        <th>勤務時間</th>
      </tr>
      @isset($attes)
      @foreach($attes as $atte)
      <tr>
        <td>{{$atte['date']}}</td>
        <td>{{$atte['start_work']}}</td>
        <td>{{$atte['end_work']}}</td>
        <td>{{$atte['break_time']}}</td>
        <td>{{$atte['work_time']}}</td>
      </tr>
      @endforeach
      @endisset
    </table>
  </div>
</main>
@endsection