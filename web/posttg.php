<?php
    date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai'   亚洲/上海
    $bot_api_key = 'CHANGE HERE';
    function send_post($postArray)
    {
        $params = $postArray;
        $ch     = curl_init("https://api.telegram.org/bot" . strval(getenv('botid')) . "/sendMessage");
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $result = curl_exec($ch);
        //捕抓异常
        if (curl_errno($ch))
        {
            $code = 400; //执行异常
            $data = curl_error($ch);
            curl_close($ch);

            return $data;
        }
        curl_close($ch);

        return $result;
    }

    $today    = date('Y-m-d H:i:s');
    $text     = @$_POST["text"];
    $tgid     = isset($_POST['chatid']) ? $_POST['chatid'] : strval(getenv('chat_id'));
    $sendText = urlencode($today . "\n" . $text);
    if ($text)
    {
        //echo getenv('botid');
        //        $url    = "https://api.telegram.org/bot" . strval(getenv('botid')) . "/sendMessage?chat_id=" . $tgid . "&text={$sendText}&parse_mode=HTML";
        $params = ['chat_id' => $tgid,
                   'text' => $sendText,
                   'parse_mode' => 'HTML'];
        echo send_post($params);
        //echo $today;
    }
    else
    {
        echo "hello";
        //echo send_get('http://www.google.com');
        //        echo getenv('botid');
        //        echo getenv('chat_id');
    }
?>