<?php
try{

	// Подключение классов
	define('DIR',  __DIR__);
	define('Classes',  DIR.'/classes');
	 
	spl_autoload_register(function ($class) {
		include Classes. '/' . $class . '.php';
	});

	// Создание объекта и вставка новых данных
	$hand = new Handler($_POST['name'], $_POST['email'], $_POST['comment']);

	echo $hand->insertData();
}
catch(Exception $e){

	// Логирование ошибок
	Log::write($e->getMessage());
	
}

?>