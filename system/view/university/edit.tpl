<?php
$html = <<<HTML


<!doctype html>
<html lang="ja" >
  <head>
    <title>{$title}</title>
    {$bootstrap}
  </head>
 <body style="padding: 50px;">
    <form name="form1" method="POST" action="">
      <h1 class="h3 mb-3 font-weight-normal">{$title} {$subTitle}</h1>

      <div class="form-group col-sm-offset-2">
        <label for="email">加工工程</label>
      </div>
      <div class="form-group form-inline col-sm-offset-2">
        <input type="text" class="form-control" id="product_name" name="product_name"  value="{$para['product_name']}" placeholder="加工方法" required>　
        <input type="text" class="form-control" id="product_type" name="product_type" value="{$para['product_type']}" placeholder="種類">
      </div>
      <div class="form-group col-sm-offset-2">
        <label for="pass">備考</label>
        <input type="text" class="form-control col-sm-10" id="note" name="note" value="{$para['note']}" placeholder="" >
      </div>
      
      <div class="col-md-8">
        <button id="submit" name="submit" class="btn btn-primary" value="1">{$subTitle}</button>
        <a href="index.php" id="cancel" name="cancel" class="btn btn-default">キャンセル</a>
      </div>
      <input type="hidden" name="init" value="{$para['init']}" />
    </form>
  </body>
</html>
HTML;
