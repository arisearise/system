<?php
$html = <<<HTML


<!doctype html>
<html lang="ja" >
  <head>
    <title>{$title}</title>
    {$bootstrap}
    {$style}
  </head>
  <body  class="text-center" >
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
      <div class="container">
        <span class="skiplink-text"></span>
      </div>
    </a>

<form class="form-signin">
  <img src="$img" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">{$title}</h1>
  <input type="password" name="dummypass" style="visibility: hidden; top: -100px; left: -100px;" />
  <label for="inputEmail" class="sr-only">メールアドレス</label>
  <input type="email" name="email" id="inputEmail"  value="{$para['email']}" class="form-control" placeholder="メールアドレス" autocomplete="off" required autofocus >
  <label for="inputPassword" class="sr-only">パスワード</label>
  <input type="password" name="password" id="inputPassword" value="{$para['password']}" class="form-control" placeholder="パスワード" required>
  <p class="text-danger text-center"><small>{$message}</small></p>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">ログイン</button>
  <p class="mt-5 mb-3 text-muted"><a href="edit.php">新規登録</a></p>
</form>


  </body>
</html>




HTML;
?>
