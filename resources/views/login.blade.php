<style>
  .container {
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .heading {
    font-weight: bold;
    margin: 20px auto;
    font-size: 20px;
  }

  .form {
    display: flex;
    flex-direction: column;
    margin: 15px auto;
  }

  .form>* {
    width: 350px;
    height: 40px;
    padding: 5px;
    margin: 10px;
    border-radius: 5px;
  }

  .form>input {
    border: solid 1px gray;
  }

  .register_wrap {
    text-align: center;
  }

  .register_wrap>p {
    margin: 0;
  }

  .submit_btn {
    background: blue;
    color: white;
    font-size: 10px;
  }

  .link {
    color: blue;
  }
</style>
<!--ログイン失敗時、ログアウト時の表示をさせる-->
<div class="container">
  {}}
  <h1 class="heading">ログイン</h1>
  <form action="/login" method="post" class="form">
    @csrf
    <input type="text" 　name="email" placeholder="メールアドレス">
    <input type="text" name="password" placeholder="パスワード">
    <button class="submit_btn">ログイン</button>
  </form>
  <div class="register_wrap">
    <p>アカウントをお持ちでない方はこちらから</p>
    <a href="/register">会員登録</a>
  </div>
</div>