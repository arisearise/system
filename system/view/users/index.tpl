<?php
$html = <<<HTML


<!doctype html>
<html lang="ja" >
  <head>
    <title>{$title}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body >
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
            <a class="nav-link active" href="../dashboard">
              <span data-feather="home"></span>
              ダッシュボード<span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../orders">
              <span data-feather="file"></span>
              受注管理
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../products">
              <span data-feather="shopping-cart"></span>
              加工品目管理
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">
              <span data-feather="users"></span>
              取引先管理
            </a>
          </li>

      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{$title}</h1>
      </div>
        <p class="mt-5 mb-3 text-muted"><a href="edit.php">新規登録</a></p>


      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>取引先</th>
              <th>住所</th>
              <th>電話</th>
              <th>FAX</th>
              <th>種別</th>
              <th>削除</th>
            </tr>
          </thead>
          <tbody>
HTML;
if (!empty($vendorList)) {
    foreach ($vendorList as $vendor) {
        $upd = '<a href="edit.php?status=update&vendor_id=' . $vendor['vendor_id'] . '">';
        $del = '<a href="edit.php?status=delete&vendor_id=' . $vendor['vendor_id'] . '">';
        $html .= <<<HTML

            <tr>
              <td>{$upd}{$vendor['vendor_name']} {$vendor['department_name']}</a></td>
              <td>{$vendor['address_1']}{$vendor['address_2']}{$vendor['address_3']}</td>
              <td>{$vendor['tel_no']}</td>
              <td>{$vendor['fax_no']}</td>
              <td>{$vendor['note']}</td>
              <td>{$del}<span data-feather="trash"></span></a></td>
            </tr>
HTML;
    }
}
$html .= <<<HTML

          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
</script>
  </body>
</html>

HTML;
