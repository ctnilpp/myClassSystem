<?php
function get_sign_config(){//读取文件配置
	$myfile = fopen("sign_config.txt", "r") or die("Unable to open file!");
	$sign_config = array();
	$sign = fread($myfile,filesize("sign_config.txt"));
	$index =0;
	$jzh =0;
	$jzt =0;
	$vh =0;
	$vt =0;
	$jz ='';
	$vz ='';
	$now ='';
	$rest = '';
	$length = filesize("sign_config.txt");
if(strpos($sign,';')){
	$vt = strpos($sign,';');
	$now = substr($sign,$index,$vt);
	$rest = substr($sign,$vt,$length);
		while (1) {
			$vt = strpos($sign,';');
			$now = substr($sign,$index,$vt);
			$rest = trim(substr($sign,$vt+1,$length));
			$jzt = strpos($now,'=');
			$jz = substr($now,$index,$jzt);
			$vh = strpos($now,'=')+1;
			$vz = substr($now,$vh,$vt);
			$sign = $rest;
			$sign_config[$jz] = change($vz);
			if(!strpos($rest,';')){
				break;
					}
				}
}
fclose($myfile);
return $sign_config;
}


//改变文件配置
function change_sign_config($sign_config){
	$myfile = fopen('sign_config.txt',"w") or die("unable to open the file!");
	foreach ($sign_config as $key => $value) {
		 $txt = "$key"."=".change($value).";\n";
		 fwrite($myfile, $txt);
	}
	fclose($myfile);
}






?>