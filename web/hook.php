<?php
    $path = "https://api.telegram.org/bot" . strval(getenv('botid'));

    $update = json_decode(file_get_contents("php://input"), true);

    $chatId  = $update["message"]["chat"]["id"];
    $message = $update["message"]["text"];
    //$message = strtolower($message);

    receiveCmd($message,'/addredcode ','redcode.txt','整点红包代码保存完毕','整点红包代码未改变');
    receiveCmd($message,'/addredcodehalf ','redcodehalf.txt','半点红包代码保存完毕','半点红包代码未改变');

    /**
     * @param $msg  接收的全部信息
     * @param $cmd  匹配的命令
     * @param $filename 信息保存到的文件名
     * @param string $successMsg    保存成功的信息
     * @param string $failMsg   保存失败的信息
     */
    function receiveCmd($msg,$cmd,$filename,$successMsg = '代码保存完毕',$failMsg = '代码未改变')
    {
        global $path,$chatId;
        if (strpos($msg, $cmd) === 0)
        {
            $addCode = trim(substr($msg, strlen($cmd)));

            if (strlen($addCode) != 0)
            {
                $today = date("d");
                $arr=[
                    'date'=>$today,
                    'code'=>$addCode
                ];
                $addCode = json_encode($arr);

                $myfile = fopen($filename, "w") or die("Unable to open file!");
                fwrite($myfile, $addCode);
                fclose($myfile);
                $sendmessage = $successMsg;
            }
            else{
                $sendmessage = $failMsg;
            }

            file_get_contents($path . "/sendmessage?chat_id=" . $chatId . "&text=" . $sendmessage);
        }
    }
?>