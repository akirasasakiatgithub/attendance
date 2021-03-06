<style>
  * {
    font-weight: bold;
    font-weight: bold;
    color: #222222;
  }

  a {
    text-decoration: none;
    color: inherit;
  }

  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 70px;
    padding: 0 30px;
  }

  .nav_list {
    display: flex;
    list-style: none;
  }

  .nav_item:not(:last-child) {
    margin-right: 30px;
  }

  .container {
    background-color: whitesmoke;
    margin: 0 auto;
    width: 100vw;
    height: 80vh;
    position: relative;
  }

  .footer {
    display: flex;
    justify-content: center;
    margin: 10px;
  }
</style>
<header class="header">
  <h1>Atte</h1>
  <nav class="nav">
    <ul class="nav_list">
      <li class="nav_item"><a href="{{route('index')}}">ホーム</a></li>
      <li class="nav_item"><a href="{{route('atte')}}">日付一覧</a></li>
      <li class="nav_item"><a href="">ログアウト</a></li>
    </ul>
  </nav>
</header>
<main>
  <div class="container">
    <p class="date">{{"月日"}}</p>
    <table>
      <tr>
        <th>名前</th>
        <th>勤務開始</th>
        <th>勤務終了</th>
        <th>休憩時間</th>
        <th>勤務時間</th>
      </tr>
      @isset($items)
      @foreach($items as $item)
      <tr>
        <td>{{$item->name}}</td>
        <td>{{$item->start_working_at}}</td>
        <td>{{$item->end_working_at}}</td>
        <td>{{$item->break_length}}</td>
        <td>{{$item->working_length}}</td>
      </tr>
      @endforeach
      @endisset
    </table>
  </div>
</main>
<footer class="footer">
  <small>Atte,inc.</small>
</footer>