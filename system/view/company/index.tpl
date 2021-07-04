<?php
$html = <<<HTML


<!doctype html>
<html lang="ja" >
  <head>
    <title>{$title}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    {$style}
    {$jsImg}
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script>
  
  	</script>
  </head>
  	
  <body >
  <header>
  	<div class = 'form-inline'>
  	<a class = 'home-logo' style="padding-left:20px;" href= "../dashboard">
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
    <nav class=" d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
        <div class='form-inline'>
       		<input id = search-text style='width:72%;float:left;' type='text' name='research-company' placeholder='大学名を入力してください' onChange='onResearch(research)'>
         	<button style='width:25%;float:right;' onClick='clearButton()'>clear</button>
		</div>
		<div class='cmpList'>
         {$cmpList}
        </div>
         </ul>

      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{$title}</h1>
      </div>


      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
          <div id="tabs">
<span id="tabsspan">
<div id="psnotabs">
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">会社概要</span>	
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">関連企業・グループ企業</span>
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">採用実績</span>
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">求人</span>
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">頻出質問集</span>
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">キーワード検索</span>
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">併願企業</span>
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">出典URL</span>
</div>
</span>
</div>
          </thead>
          <tbody>
HTML;
$html .= <<<HTML

          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
  feather.replace()
</script>
  </body>
</html>

HTML;
