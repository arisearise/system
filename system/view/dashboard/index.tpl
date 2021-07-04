<?php
$html = <<<HTML


<!doctype html>
<html lang="ja" >
  <head>
    <title>{$title}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    {$style}
  </head>
  <body >
  <header>
  	<div class = 'form-inline'>
  	<a class = 'home-logo' href= "../dashboard">
  	<img src = "$homeImg" alt = "" width="36" height="36" '>
  	</a>
  	</div>
  </header>
  
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
  <div class="container">
    <span class="skiplink-text">Skip to main content</span>
  </div>
</a>
<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              面接シュミレーター<span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../vendors">
              <span data-feather="shopping-cart"></span>
              求人検索
            </a>
          <li class="nav-item">
            <a class="nav-link" href="../company">
              <span data-feather="file"></span>
              企業・業界・業種検索
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../university">
              <span data-feather="shopping-cart"></span>
              大学一覧
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../vendors">
              <span data-feather="users"></span>
              就職イベント
            </a>
          </li>

      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{$title}</h1>
      </div>
      
	<form  name='form1' class = 'header-form' action = '#' method='post'>
  		<div  class = 'form-group'>
  		<!--
  		<input size = '80' type='text' name='company-research' placeholder='探したい企業を入力してください'>
  		<input type='submit' value='検索'>
  		
  		<select name='prefecture_id' onChange='form1.submit()'>
  		</select>
  		-->
  		{$select_pref}
  		</div>
	</form>
	
      <h2>Section title</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>企業名</th>
              <th>職種</th>
              <th>雇用形態</th>
              <th>リンク</th>
              <th>期待値</th>
            </tr>
          </thead>
          <tbody>
   			{$company}
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

  </body>
</html>

HTML;
?>
