<?php
session_start();
if ( isset($_SESSION['result']) && isset($_SESSION['updateTime']) ){
?>
    <head>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Noto Sans TC', sans-serif;
            }
        </style>

      <title>查詢結果</title>
    </head>
    <body>
      <div class="container">
        <h1 class="text-center">查詢結果</h1>
        <p>
          <?php
            $record = $_SESSION['result'];
            echo "你的出缺席速查紀錄如下:"."<br>";
            foreach($record as $key => $value)
                echo $key.":".$value."<br>";
            echo "<br>";
            echo $_SESSION['updateTime'];
          ?>
        </p>
          <div class="row justify-content-center">
            <a class="col-4 btn btn-primary" href="logout.php">按我退出</a>
        </div>
      </div>

    </body>


<?php
}
else {
  echo "您尚未登入";
}
 ?>
