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
			@foreach ($items as $item)
			<tr>
				<td>{{$item->get('name')}}</td>
				<td>{{$item->get('start_work')}}</td>
				<td>{{$item->get('end_work')}}</td>
				<td>{{$item->get('break_time')}}</td>
				<td>{{$item->get('work_time')}}</td>
			</tr>
			@endforeach
			@endisset
		</table>
		@isset($items)
		{{ $items->links('vendor.pagination.bootstrap-4') }}
		@endisset
	</div>
</main>
@endsection