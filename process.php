<?php
ini_set("display_errors","Off");
session_start();

$account = $_POST['account'];
$password = $_POST['password'];

$secret = "<insert-your-secret-key-here>";
$response = $_POST['g-recaptcha-response'];

$ch0 = curl_init();
curl_setopt($ch0,CURLOPT_URL,'https://www.google.com/recaptcha/api/siteverify');
curl_setopt($ch0, CURLOPT_POST, true);
curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch0, CURLOPT_POSTFIELDS, array(
	'secret' => $secret,
	'response' => $response,
	));
$data = curl_exec($ch0);
curl_close($ch0);
$recaptcha = json_decode($data, true);

if ($recaptcha["success"] && !empty($account) && !empty($password) ){
    $cookie_jar = '/tmp/cookie' ;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://acdm3.tcssh.tc.edu.tw/csn4/Reg_stu.ASP');
    curl_setopt($ch, CURLOPT_POST, 1);
    $request = "txtS_NO=".$account."&txtPass=".$password;
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_NOBODY, false);
    $content = curl_exec($ch);
    curl_close($ch);


    if (strpos($content,"i_Stu.asp") == false){
        echo "帳密驗證錯誤，將跳轉回登入頁面";
        echo header( "Refresh:3; url=index.php", true, 303);
    }
    else {
        //get data after login
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, 'http://acdm3.tcssh.tc.edu.tw/csn4/CS2/work.asp');
        curl_setopt($ch2, CURLOPT_HEADER, false);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_COOKIEFILE, $cookie_jar);
        $orders = curl_exec($ch2);

	preg_match_all("/<td.*>(.*)<\/td>/U", $orders, $lists);

	curl_close($ch2);

        foreach($lists[0] as $key => $value){
            $lists[0][$key] = mb_convert_encoding($value,"UTF-8","BIG5");
        }

        // for debugging
        //print_r($lists[0]);

        $record = array(
            '公'=>0,
			'病'=>0,
			'事'=>0,
			'曠'=>0,
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
	echo "Error Code:";
	if (!$recaptcha["success"]){
		echo "1";
	}
	if(empty($account) || empty($password) ){
  		echo "2";
	}
}

 ?>
