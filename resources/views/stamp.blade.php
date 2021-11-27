<style>
  .container {
    background-color: whitesmoke;
    width: 80%;
    height: 80%;
    position: relative;
  }

  .button {
    width: 300px;
    height: 100px;
    padding: 20px 40px;
    position: absolute;
    top: 50%;
    left: 50%;
  }

  .start_working {
    transform: translate(-110%, -110%);
  }

  .end_working {
    transform: translate(10%, -110%);
  }

  .start_breaketime {
    transform: translate(-110%, 10%);
  }

  .end_breaketime {
    transform: translate(10%, 10%);
  }
</style>

<a href="">ホーム</a><a href="">日付一覧</a><a href="">ログアウト</a>
<div class="conatainer">
  <p>さんお疲れ様です！</p>
  <form action="/stamp" method="post">
    <button class="button start_working" name="sw">勤務開始</button>
    <button class="button end_working" name="ew">勤務終了</button>
    <button class="button start_breaketime" name="sb">休憩開始</button>
    <button class="button end_breaketime" name="eb">休憩終了</button>
  </form>
</div>