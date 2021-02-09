<?php
    $path = "https://api.telegram.org/bot" . strval(getenv('botid'));

    $update = json_decode(file_get_contents("php://input"), true);

    $chatId  = $update["message"]["chat"]["id"];
    $message = $update["message"]["text"];
    //$message = strtolower($message);

    if (strpos($message, "/hello") === 0)
    {
        $redcode = substr($message, 7);
        //$weather  = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . $location . "&appid=mytoken"), true)["weather"][0]["main"];
        $sendmessage = "红包代码保存完毕";
        file_get_contents($path . "/sendmessage?chat_id=" . $chatId . "&text=" . $sendmessage);

        if (strlen($redcode) != 0)
        {
            $myfile = fopen("redcode.txt", "w") or die("Unable to open file!");
            fwrite($myfile, $redcode);
            fclose($myfile);
        }
    }
?>