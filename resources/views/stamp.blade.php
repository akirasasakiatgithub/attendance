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
      <li class="nav_item"><a href="/date">日付一覧</a></li>
      <li class="nav_item"><a href="">ログアウト</a></li>
    </ul>
  </nav>
</header>
<main>
  <div class="container">
    <p class="greeting character">{{$item->login_name}}さんお疲れ様です！</p>
    <form action="/" method="post">
      <button class="button start_working active" name="start_working">
        <p>勤務開始</p>
      </button>
      <button class="button end_working" name="end_working">
        <p>勤務終了</p>
      </button>
      <button class="button start_break" name="start_break">
        <p>休憩開始</p>
      </button>
      <button class="button end_break" name="end_break">
        <p>休憩終了</p>
      </button>
    </form>
  </div>
</main>
<footer class="footer character">
  <small>Atte,inc.</small>
</footer>
<script>
  const buttons = document.getElementsByClassName('button');
  for (let i = 0; i < buttons.length; i++) {
    if (buttons[i].contains("active")) {
      if (buttons[i].contains("start_working" || "end_break")) {
        buttons[i].addEventListener('click', goAwayFromWork);
      } else if (buttons[i].contains("end_working")) {
        buttons[i].addEventListener('click', endWorking);
      } else if (buttons[i].contains("start_break")) {
        buttons[i].addEventListener('click', startBreak);
      }
    }

    function goAwayFromWork() {
      this.classList.remove('active');
      buttons.getElementsByClassName('end_working')[0].classList.add('active');
      buttons.getElementsByClassName('start_break')[0].classList.add('active');
    };

    function endWorking() {
      this.classList.remove('active');
      buttons.getElementsByClassName('start_working')[0].classList.add('active');
    }

    function startBreak() {
      this.classList.remove('active');
      buttons.getElementsByClassName('end_break')[0].classList.add('active');
    }
</script>
</body>

</html>