@extends('layouts.base')

@section('content')
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
<script>
  const startWorking = document.getElementsByClassName('start_working')[0];
  const endWorking = document.getElementsByClassName('end_working')[0];
  const startBreak = document.getElementsByClassName('start_break')[0];
  const endBreak = document.getElementsByClassName('end_break')[0];

  if (startWorking.className.includes('active')) {
    startWorking.addEventListener('click', () => {
      submitData(startWorking)
    });
  }
  if (endWorking.className.includes('active') || startBreak.className.includes('active')) {
    endWorking.addEventListener('click', () => {
      submitData(endWorking)
    });
    startBreak.addEventListener('click', () => {
      submitData(startBreak)
    });
  }
  if (endBreak.className.includes('active')) {
    endBreak.addEventListener('click', () => {
      submitData(endBreak)
    });
  }

  function submitData(buttonClicked) {
    buttonClicked.disabled = true;
    buttonClicked.classList.toggle('active');
    if (buttonClicked == startWorking || buttonClicked == endBreak) {
      endWorking.disabled = false;
      startBreak.disabled = false;
      endWorking.classList.toggle('active');
      startBreak.classList.toggle('active');
      //buttonSwitch(buttonClicked, endWorking, startBreak, '');
    } else if (buttonClicked == endWorking) {
      startBreak.disabled = true;
      startBreak.classList.toggle('active');
      console.log(buttonClicked);
      startWorking.disabled = false;
      startWorking.classList.toggle('active');
      //buttonSwitch(buttonClicked, startWorking, '', startBreak);
    } else if (buttonClicked == startBreak) {
      endWorking.disabled = true;
      endWorking.classList.toggle('active');
      console.log(buttonClicked);
      endBreak.disabled = false;
      endBreak.classList.toggle('active');
      //buttonSwitch(buttonClicked, endBreak, '', endWorking);
    }
  }

  /*function buttonSwitch(buttonClicked, buttonToActive1, buttonToActive2, buttonToInactive) {
    buttonClicked.disabled = true;
    buttonClicked.classList.toggle('active');
    buttonToInactive.disabled = true;
    buttonToInactive.classList.toggle('active');
    buttonToActive1.disabled = false;
    buttonToActive2.disabled = false;
    buttonToActive1.classList.toggle('active');
    buttonToActive2.classList.toggle('active');
  }*/
</script>
</body>

</html>
@endsection