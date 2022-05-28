<style>
  * {
    font-weight: bold;
  }

  .character {
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

  .greeting {
    position: absolute;
    top: 5%;
    left: 50%;
    transform: translate(-50%, 0);
    margin: 20px auto;
  }

  .button {
    display: inline-block;
    background-color: white;
    width: 300px;
    height: 100px;
    padding: 20px 40px;
    position: absolute;
    top: 50%;
    left: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 10px auto;
    border-style: none;
  }

  .start_working {
    color: whitesmoke;
    transform: translate(-105%, -110%);
  }

  .end_working {
    color: whitesmoke;
    transform: translate(5%, -110%);
  }

  .start_break {
    color: whitesmoke;
    transform: translate(-105%, 10%);
  }

  .end_break {
    color: whitesmoke;
    transform: translate(5%, 10%);
  }

  .start_working.active {
    color: #222222;
  }

  .end_working.active {
    color: #222222;
  }

  .start_break.active {
    color: #222222;
  }

  .end_break.active {
    color: #222222;
  }

  .footer {
    display: flex;
    justify-content: center;
    margin: 10px;
  }
</style>

<header class="header character">
  <h1>Atte</h1>
  <nav class="nav">
    <ul class="nav_list">
      <li class="nav_item"><a href="/">ホーム</a></li>
      <li class="nav_item"><a href="{{ route('atte') }}">勤務一覧</a></li>
      <li class="nav_item"><a href="/date">個人勤務一覧</a></li>
      <li class="nav_item"><a href="">ログアウト</a></li>
    </ul>
  </nav>
</header>
<main>
  <div class="container">
    <p class="greeting character">{{$user->name}}さんお疲れ様です！</p>
    <form action="attendance/start" method="get">
      @csrf
      <button class="button start_working active" name="start_working">
        <p>勤務開始</p>
      </button>
    </form>
    <form action="attendance/end" method="get">
      @csrf
      <button class="button end_working" name="end_working" disabled>
        <p>勤務終了</p>
      </button>
    </form>
    <form action="break/start" method="get">
      @csrf
      <button class="button start_break" name="start_break" disabled>
        <p>休憩開始</p>
      </button>
    </form>
    <form action="break/end" method="get">
      @csrf
      <button class="button end_break" name="end_break" disabled>
        <p>休憩終了</p>
      </button>
    </form>
  </div>
</main>
<footer class="footer character">
  <small>Atte,inc.</small>
</footer>
</body>

</html>