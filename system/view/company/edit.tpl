<?php
$html = <<<HTML


<!doctype html>
<html lang="ja" >
  <head>
    <title>{$title}</title>
    <link rel="stylesheet" href="$bootstrap">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{$zip2addr}"></script>
  </head>
 <body style="padding: 50px;">
    <form name="form1" method="POST" action="">
      <h1 class="h3 mb-3 font-weight-normal">{$title} {$subTitle}</h1>

      <div class="form-group col-sm-offset-2">
        <label for="email">取引先</label>
      </div>
      <div class="form-group form-inline col-sm-offset-2">
        <input type="text" class="form-control" id="customer_name" name="customer_name"  value="{$para['customer_name']}" placeholder="会社名" required>　
        <input type="text" class="form-control" id="department_name" name="department_name" value="{$para['department_name']}" placeholder="部署名">
      </div>
      <div class="form-group col-sm-offset-2">
        <label for="pass">住所</label>
      </div>
        <input type="text" class="form-control col-sm-2" id="zip_code" onKeyUp="$('#zip_code').zip2addr('#address_1');" name="zip_code" value="{$para['zip_code']}" placeholder="郵便番号" required>　
      </div>
      <div class="form-group form-inline col-sm-offset-2">
        <input type="text" class="form-control col-sm-4" id="address_1" name="address_1" value="{$para['address_1']}" placeholder="" required>　
        <input type="text" class="form-control col-sm-3" id="address_2" name="address_2" value="{$para['address_2']}" placeholder="" >
        <input type="text" class="form-control col-sm-3" id="address_3" name="address_3" value="{$para['address_3']}" placeholder="" >
      </div>
      <div class="form-group col-sm-offset-2">
        <label for="pass">電話・FAX等</label>
      </div>
      <div class="form-group form-inline col-sm-offset-2">
        <input type="text" class="form-control col-sm-3" id="tel_no" name="tel_no" value="{$para['tel_no']}" placeholder="電話番号" required>　
        <input type="text" class="form-control col-sm-3" id="fax_no" name="fax_no" value="{$para['fax_no']}" placeholder="FAX">　
        <input type="text" class="form-control col-sm-4" id="email_address" name="email_address" value="{$para['email_address']}" placeholder="メールアドレス" required>
      </div>
      <div class="form-group col-sm-offset-2">
        <label for="pass">種別</label>
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
