<?php
  session_start();
?>

<html lang="zh">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
       function onSubmit(token) {
         document.getElementById("form0").submit();
       }
     </script>

    <title>台中二中學生出缺席紀錄速查</title>
  </head>
  <body>
    <div class="container">
      <h1 class="text-center">中二中學生出缺席紀錄速查</h1>
      <form id="form0" method="post" action="process.php">
        <div class="form-group">
          帳號：<input type="text" name="account" class="form-control" id="validationCustom01" required>
	</div>
        <div class="form-group">
          密碼：<input type="password" name="password" class="form-control" id="validationCustom02" required>
	</div>
         <button type="submit" class="g-recaptcha col sm-12 btn btn-primary" data-sitekey="<insert-yout-sitekey-here>" data-callback='onSubmit'>查詢</button>
      </form>
        <h2>說明</h2>
        <p>本網站提供台中二中學生，進行出缺席紀錄的簡易速查；查詢結果<b>僅供參考</b>，以校方系統之最後結果為準。</p>
	<p class="text-right">Created by TCSCSC</p>
        <a href="http://acdm3.tcssh.tc.edu.tw/csn4/default.htm">台中二中成績查詢系統</a>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
