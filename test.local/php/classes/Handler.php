<?php
/*
Класс Handler для работы с данными
*/
class Handler
{
	// Поля с данными
	private $name;
	private $email;
	private $comment;

	function __construct($name, $email, $comment) {
		// Запись данных в свойства 
		$this -> name = self::checkName($name);
		$this -> email = self::checkEmail($email);
		$this -> comment = self::checkComment($comment);

	}

	public static function getData(){

		// TODO: Заменить root на пользователя с ограниченными правами

		// connect to MySQL
		$dbh = new PDO('mysql:dbname=tet;host=localhost', 'root', '');

		$query = $dbh->prepare("SELECT * FROM `comments` ORDER BY `id`");

		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_NUM);
		return $result;

	}

	private function checkName($str){

		$str = trim($str);

		if( strlen($str) > 1 && strlen($str) < 101 )
			return htmlspecialchars($str);

		return false;
	}

	private function checkEmail($str){

		$str = filter_var(trim($str), FILTER_VALIDATE_EMAIL);

		if ($str)
			return $str;

	}

	private function checkComment($str){
		
		$str = trim($str);

		if( strlen($str) > 5 && strlen($str) < 101 ){
			$str = htmlspecialchars($str);

			return str_replace(["\r", "\n"], "<br>", $str);
		}

		return false;

	}

	public function insertData() {
		// Если хотя бы один аргумент получен неправильным (подделан на клиенте)
		if (!($this -> name && 
			  $this -> email && 
			  $this -> comment)) {
			
				return false;
		}
		
		// TODO: Заменить root на пользователя с ограниченными правами
		$dbh = new PDO('mysql:dbname=test;host=localhost', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

		$stmt = $dbh->prepare("INSERT INTO comments (name, email, comment) VALUES (?, ?, ?)");


		$stmt->bindParam(1, $this -> name);
		$stmt->bindParam(2, $this -> email);
		$stmt->bindParam(3, $this -> comment);

		if ($stmt->execute()) {
			return json_encode([$this -> name,
								$this -> email,
								$this -> comment],
								
								JSON_HEX_TAG |
								JSON_HEX_APOS |
								JSON_HEX_QUOT |
								JSON_HEX_AMP |
								JSON_UNESCAPED_UNICODE);
		};

	}
}

?>