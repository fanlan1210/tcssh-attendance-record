<?php
session_start();

$account = $_POST['account'];
$password = $_POST['password'];

if ( !empty($account) && !empty($password)){
    $cookie_jar = './cookie' ;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://acdm3.tcssh.tc.edu.tw/csn4/Reg_stu.ASP');
    curl_setopt($ch, CURLOPT_POST, 1);
    $request = "txtS_NO=".$account."&txtPass=".$password;
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    //把返回來的cookie保存在$cookie_jar文件中
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
    //設定返回的資料是否自動顯示
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //設定是否顯示頭訊息
    curl_setopt($ch, CURLOPT_HEADER, false);
    //設定是否輸出頁面內容
    curl_setopt($ch, CURLOPT_NOBODY, false);
    $content = curl_exec($ch);
    curl_close($ch);

    
    if (strpos($content,"i_Stu.asp") == false){
        echo "輸入錯誤，將跳轉回登入頁面";
        echo header( "Refresh:3; url=login.php", true, 303);
    }
    else {
        //get data after login
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, 'http://acdm3.tcssh.tc.edu.tw/csn4/CS2/work.asp');
        curl_setopt($ch2, CURLOPT_HEADER, false);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_COOKIEFILE, $cookie_jar);
        $orders = curl_exec($ch2);
        //echo '&lt;pre&gt;';
        //echo strip_tags($orders);
        //echo $orders;
        preg_match_all("/<td.*>(.*)<\/td>/U", $orders, $lists);
        //echo '&lt;/pre&gt;';
        curl_close($ch2);

        foreach($lists[0] as $key => $value){
            $lists[0][$key] = mb_convert_encoding($value,"UTF-8","BIG5");
        }

        // for debugging
        //print_r($lists[0]);

        $record = array(
            '公'=>0,
            '病'=>0,
            '缺'=>0,
            '遲'=>0
        );

        //analyze data list
        foreach($lists[0] as $list_value){
            foreach($record as $key => $record_value){
                if(strpos($list_value,$key)){
                    $record[$key]+=1;
                }
            }
        }

        $_SESSION['result'] = $record;
        $_SESSION['updateTime'] = end($lists[0]);

        $_SESSION['isLogin'] = true;
        header("Location: result.php");
        die();
        }
}
else {
  echo "錯誤";
}

 ?>
