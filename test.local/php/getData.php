<?php
try{
	// Подключаем классы
	define('DIR',  __DIR__);
	define('Classes',  DIR.'/classes');
	 
	spl_autoload_register(function ($class) {
		include Classes. '/' . $class . '.php';
	});

	// Возвращаем данные
	echo(json_encode(Handler::getData(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE));
}
catch(Exception $e){
	// Логирование ошибок
	Log::write($e->getMessage());
	echo false;
}

?>
