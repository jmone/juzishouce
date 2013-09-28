<?php
class Database{
	protected $dbh;
	public function __construct(){
		$dsn = 'mysql:dbname=e;host=127.0.0.1';
		$user = 'root';
		$password = '32100321';

		try {
			$this->dbh = new PDO($dsn, $user, $password);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
	}
}
?>
