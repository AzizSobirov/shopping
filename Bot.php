<?php

ob_start();

define('API_KEY', '1723783316:AAFaNbZvaGCteXH3yqMKwBJaZegbib7MIG4');//token

$admin = "1074236330";//admin id

$mybot = "CounterMembers_bot"; //bot useri @ qoymasdan

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

//KOD @LIGHT_BLOGGER TOMONIDAN YOZILDI MANBAGA TEGMA

$update = json_decode(file_get_contents('php://input'));

$message = $update->message;

$text = $message->text;

$mid = $message->message_id;

$chat_id = $message->chat->id;

$user_id = $message->from->id;

$ufname = $update->message->from->first_name;

$type = $message->chat->type;

$title = $message->chat->title;

$repid = $message->reply_to_message->from->id;

$repmid = $message->reply_to_message->message_id;

$repufname = $message->reply_to_message->from->first_name;

$left = $message->left_chat_member;

$new = $message->new_chat_member;

$leftid = $message->left_chat_member->id;

$newid = $message->new_chat_member->id;

$newufname = $message->new_chat_member->first_name;

$soat = date('H:i:s', strtotime('5 hour'));

$sana = date('d-m-Y',strtotime('5 hour'));

mkdir("lightblogger");

mkdir("light");

mkdir("light/$chat_id");

$lightblogger = file_get_contents("light/$chat_id/$user_id.txt");

$step = file_get_contents("lightblogger/$chat_id.step");

$guruhlar = file_get_contents("lightblogger/Guruh.lar");

$userlar = file_get_contents("lightblogger/User.lar");

if(isset($message)){

  if($type == "group" or $type == "supergroup"){

    if(stripos($guruhlar,"$chat_id")!==false){

    }else{

    file_put_contents("lightblogger/Gulightruh.lar","$guruhlar\n$chat_id");

    }

  }else{

   $userlar = file_get_contents("lightblogger/User.lar");

   if(stripos($userlar,"$chat_id")!==false){

    }else{

    file_put_contents("lightblogger/User.lar","$userlar\n$chat_id");

   }}}

//KOD @LIGHT_BLOGGER TOMONIDAN YOZILDI MANBAGA TEGMA

if($text == "/start" or $text == "/start@$mybot"){

bot('sendMessage',[

'chat_id'=>$chat_id,

'text'=> "🤖 Botga xush kelibsiz, <a href='tg://user?id=$user_id'>$ufname</a> !

🌐 Men guruhga kim qancha odam qo'shganligini aytib beruvchi robotman. Meni admin qilib tayinlashga unutmang!

✅ <b>Robot qat'iy ravishda guruhlarda ishlaydi!</b>",

'parse_mode' => 'html',

'disable_web_page_preview'=>true,

  'reply_markup'=>json_encode([   

   'inline_keyboard'=>[

       [['text'=>'Yordam!','url'=>'t.me/light_blogger'],],

]   

]),

]);

}

//KOD @LIGHT_BLOGGER TOMONIDAN YOZILDI MANBAGA TEGMA

if($left){

  bot('deletemessage',[

    'chat_id'=>$chat_id,

    'message_id'=>$mid

  ]);

  unlink("light/$chat_id/$leftid.txt");

}

if($new){

  bot('deletemessage',[

    'chat_id'=>$chat_id,

    'message_id'=>$mid

  ]);

  bot('sendmessage',[

    'chat_id'=>$chat_id,

    'text'=>"<b>👋Salom</b> <a href='tg://user?id=$newid'>$newufname</a> Gruppamizga xush kelibsiz! Biz xursand bo'ldik😉",

    'parse_mode'=>'html'

   ]);

  $add = $lightblogger + 1;

  file_put_contents("light/$chat_id/$user_id.txt","$add");

}

if($text == "/mymembers" or $text == "/mymembers@$mybot"){

if($UzStarTM==true){

  bot('sendmessage',[    

    'chat_id'=>$chat_id, 

    'reply_to_message_id'=>$mid,  

    'parse_mode'=>'html',   

    'text'=>"<a href='tg://user?id=$user_id'>$ufname</a> 

🔹Siz $lightblogger ta odam qo'shgansiz!",

  ]);   

}else{

bot("sendMessage",[

"chat_id"=>$chat_id,

 'reply_to_message_id'=>$mid,  

    'parse_mode'=>'html',   

"text"=>"<a href='tg://user?id=$user_id'>$ufname</a> 

❌Siz hali odam qo'shmadingiz!",

]);

}}

//KOD @LIGHT_BLOGGER TOMONIDAN YOZILDI MANBAGA TEGMA

if($text == '/code' and $chat_id == $admin){

bot('sendDocument',[

'chat_id'=>$chat_id,

'reply_to_message_id'=>$mid,

'document'=>new CURLFile(__FILE__),

'caption'=>"@$mybot <b>code</b>", 

'parse_mode'=>"html",

]);

}
if($text=="/stat"){

$gr = substr_count($guruhlar,"\n"); 

$us = substr_count($userlar,"\n"); 

$all = $gr + $us;

bot('sendmessage',[

'chat_id'=>$chat_id,

'reply_to_message_id'=>$mid,

'text'=>"<b>📊Bot foydalanuvchilari:

👤 Foydalanuvchilar: $us ta

👥 Guruhlar: $gr ta

🔃Hammasi: $all ta

📅 $sana $soat

❇️</b> @UzStarsGroup",

'parse_mode'=>"html"

]);

} 

//KOD @LIGHT_BLOGGER TOMONIDAN YOZILDI MANBAGA TEGMA

?>
