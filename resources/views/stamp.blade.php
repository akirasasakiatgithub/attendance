@extends('layouts.base')

@section('content')
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