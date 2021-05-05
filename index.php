<?php 
// https://api.telegram.org/bot1749333819:AAFGoeVJ8zVuxHTZy9vcRDFbiZD2V7TWMrk/setWebhook?url=https://web2telegramchanell.herokuapp.com/

$token = '1749333819:AAFGoeVJ8zVuxHTZy9vcRDFbiZD2V7TWMrk';
define('API_KEY', $token);

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$update = json_decode(file_get_contents('php://input'));

$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$message_id = $message->message_id;

if ($text == '/start') {
	bot(
		'sendMessage',
		[
			'chat_id' => $chat_id,
			'text' => 'Bul birinshi zapros',
		]
	);
} elseif ($text) {
	bot(
		'deleteMessage',
		[
			'chat_id' => $chat_id,
			'message_id' => $message_id,
		]
	);
}

?>