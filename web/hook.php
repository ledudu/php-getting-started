<?php
    $path = "https://api.telegram.org/bot" . strval(getenv('botid'));

    $update = json_decode(file_get_contents("php://input"), true);

    $chatId  = $update["message"]["chat"]["id"];
    $message = $update["message"]["text"];
    $message = $message.toLowerCase();

    if (strpos($message, "/hello") === 0)
    {
        $location = substr($message, 7);
        //$weather  = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . $location . "&appid=mytoken"), true)["weather"][0]["main"];
        $sendmessage = "日常发送";
        file_get_contents($path . "/sendmessage?chat_id=" . $chatId . "&text=Here's the weather in " . $location . ": " . $sendmessage);
    }
?>