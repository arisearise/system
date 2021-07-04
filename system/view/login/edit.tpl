<?php
$html = <<<HTML


<!doctype html>
<html lang="ja" >
  <head>
    <title>{$page}</title>
    {$bootstrap}
  </head>
 <body style="padding: 50px;">
    <form>
      <h1 class="h3 mb-3 font-weight-normal">新規登録</h1>

      <div class="form-group col-sm-3 col-sm-offset-2">
        <label for="email">氏名</label>
        <input type="text" class="form-control" id="user_name" name="user_name"  value="{$para['user_name']}" placeholder="氏名" required>
      </div>
      <div class="form-group col-sm-6 col-sm-offset-2">
        <label for="email">メールアドレス</label>
        <input type="email" class="form-control" id="email" name="email" value="{$para['email']}" placeholder="メールアドレス" required>
      </div>
      <div class="form-group col-sm-3 col-sm-offset-2">
        <label for="pass">パスワード</label>
        <input type="password" class="form-control" id="pass1" name="pass1" value="{$para['pass1']}" placeholder="パスワード" required>
      </div>
      <div class="form-group col-sm-3 col-sm-offset-2">
        <label for="pass">パスワード【確認】</label>
        <input type="password" class="form-control" id="pass2" name="pass2" value="{$para['pass2']}" placeholder="パスワード" required>
      </div>
      <div class="col-md-8">
        <button id="submit" name="submit" class="btn btn-primary" value="1">登録</button>
        <a href="index.php" id="cancel" name="cancel" class="btn btn-default">キャンセル</a>
      </div>
    </form>
  </body>
</html>
HTML;
