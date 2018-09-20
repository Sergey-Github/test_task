<?php

/**
Класс Log для работы записи ошибок приложения
 
*/
class Log {
	
	public function write($message, $filename='../log/log.txt') {
	
		$f = fopen($filename, "a+");
		
		$str = $message."|".date("H:i:s d:m:Y") . PHP_EOL;
		fwrite($f, $str);
		fclose($f);

	}
}
?>