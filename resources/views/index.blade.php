@extends('layouts.base')

@section('content')
<main>
  <div class="container">
    <p class="greeting character">{{$user->name}}さんお疲れ様です！</p>
    <form action="attendance/start" method="get">
      @csrf
      @error('start_working')
      <p class='error'>ERROR</p>
      <p class='error message'>{{$message}}</p>
      @enderror
      <button class="button start_working active" name="start_working">
        <p>勤務開始</p>
      </button>
    </form>
    <form action="attendance/end" method="get">
      @csrf
      @error('end_working')
      <p class='error'>ERROR</p>
      <p class='error message'>{{$message}}</p>
      @enderror
      <button class="button end_working" name="end_working">
        <p>勤務終了</p>
      </button>
    </form>
    <form action="break/start" method="get">
      @csrf
      @error('start_break')
      <p class='error'>ERROR</p>
      <p class='error message'>{{$message}}</p>
      @enderror
      <button class="button start_break" name="start_break">
        <p>休憩開始</p>
      </button>
    </form>
    <form action="break/end" method="get">
      @csrf
      @error('end_break')
      <p class='error'>ERROR</p>
      <p class='error message'>{{$message}}</p>
      @enderror
      <button class="button end_break" name="end_break">
        <p>休憩終了</p>
      </button>
    </form>
  </div>
</main>
@endsection