<?php



/**
 * 微信接入验证
 * 在入口进行验证而不是放到框架里验证，主要是解决验证URL超时的问题
 * 接口先写上，测试的时候取消注册
 */
/*
if (! empty ( $_GET ['echostr'] ) && ! empty ( $_GET ["signature"] ) && ! empty ( $_GET ["nonce"] )) {
	$signature = $_GET ["signature"];
	$timestamp = $_GET ["timestamp"];
	$nonce = $_GET ["nonce"];
	$token = $_GET ["token"];
	
	$tmpArr = array (
			$token,
			$timestamp,
			$nonce 
	);
	sort ( $tmpArr, SORT_STRING );
	$tmpStr = sha1 ( implode ( $tmpArr ) );
	
	if ($tmpStr == $signature) {
		echo $_GET ["echostr"];
	}
	exit ();
}*/

	define('APP_DEBUG',true);//开发完后定义为FALSE

	define('APP_NAME','app');//

	define('APP_PATH','./APP/');//项目完成后上线的时候转移到其他目录

	define('RUNTIME_PATH','./RUNTIME/');//缓存目录，项目上线的时候转移到其他目录

	require './ThinkPHP/ThinkPHP.php';

?>