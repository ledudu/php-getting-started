<?php
$bot_api_key = 'CHANGE HERE';
function send_get($urlstring){
 $ch = curl_init();

 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_HEADER, false);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
 curl_setopt( $ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_URL, $urlstring);
 $result = curl_exec($ch);
 //捕抓异常
    if (curl_errno($ch)) {
        $code = 400; //执行异常
        $data = curl_error($ch);
         curl_close($ch); 
         return $data;
    }
 curl_close($ch); 
 return $result;
}
$today = date('Y-m-d');
$text = @$_GET["text"];
$tgid = @$_GET["tgid"];
$sendText = urlencode($today."\n".$text);
if($text){
    echo getenv('botid');
 $url = "https://api.telegram.org/bot"+(str)getenv('botid')+"/sendMessage?chat_id="+(str)getenv('chat_id')+"&text={$sendText}&parse_mode=HTML";
 echo send_get($url);
 echo $today;
}else{
 //echo "Please Input";
 echo getenv('botid');
 echo (str)getenv('chat_id');
}
?>
