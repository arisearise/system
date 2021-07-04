<?php
$html = <<<HTML


<!doctype html>
<html lang="ja" >
  <head>
    <title>{$title}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	{$style}
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	{$university_js} 
	<script>
	function onSubmit(no){
			key = 'university_name-' + no;
			console.log(key);
			university = document.getElementById(key);
			university_name = university.value;
			console.log(university_name);
			$('#id-' + no).submit();  
	}
	function getCampus(no){
		key = 'submit_code-' + no;
		console.log(key);
		submit_code = document.getElementById(key);
		code_name = submit_code.value;
		console.log(code_name);
		$('#idd-' + no).submit();  
 
	}
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
  <div class="container" >
    <span class="skiplink-text">Skip to main content</span>
  </div>
</a>
<div class="container-fluid">
  <div class="row">
    <nav class=" d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
      	<ul style='padding:0px;' class='flex-column'>
      	<div style="position:sticky;">
      	<form id='id' name='university.form' class='unicersity-form' action='#'  method='post'>
      	<div class='form-inline' id='research_id'>
      	<input style='width:75%'type='text' name='research-university' value=''>
      	<input style='width:25%'type='submit' name='research-clear' value="clear">
      	</div>
      	</form>
      	<!--<form name='university' id='university_id'  action='/system/controller/university/index.php' method='post'> -->
        	{$university}
        <!--</form>-->
        </div>
       </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" ">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 style=width:100%; class="h2">{$_POST['university_name']}</h1>
      </div>



          <tbody>

<div id="tabs">
<span id="tabsspan">
<div id="psnotabs">
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">学部・学科</span>
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">卒業後の進路</span>
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">就職実績</span>
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">就職支援</span>
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">キーワード検索</span>
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">外部サイト</span>
<span id="tabbutton0" class="coloredbutton" onclick="setTab()">出典（関連URL）</span>
</div>
</span>
</div>
<tbody>
{$code1}
          </tbody>
        </table>
      </div>
      <footer>
      </footer>
    </main>
  </div>
</div>

<!-- Icons -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  </body>
</html>

HTML;
