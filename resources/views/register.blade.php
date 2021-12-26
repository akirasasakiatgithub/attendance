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

  .login_wrap {
    text-align: center;
  }

  .login_wrap>p {
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
<div class="container">
  <h1 class="heading">会員登録</h1>
  <form action="/register" method="post" class="form">
    @csrf
    <input type="text" name="name" placeholder="名前">
    <input type="text" name="email" placeholder="メールアドレス">
    <input type="text" name="password" placeholder="パスワード">
    <input type="text" name="password" placeholder="確認用パスワード">
    <button class="submit_btn">会員登録</button>
  </form>
  <div class="login_wrap">
    <p>アカウントをお持ちの方はこちらから</p>
    <a href="{{ route('login') }}" class="link">ログイン</a>
  </div>
</div>