<?php
class User{
	public function add($data){
		$data = array_merge(array(
			'id' => '',
			'type' => '',
			'email' => '',
			'password' => '',
			'dateline' => '',
		), $data);

		$keys = array_keys($data);
		$sql = 'INSERT INTO user (id, type, email, password, dateline) values (:id, :type, :email, :password, :dateline)';
		$sth = $dbh->prepare($sql);
		foreach($data as $key => $value){
			$flag = ":$key";
			$sth->bindValue($flag, $value);
		}
		$sth->execute();
	}
	public function delete($condition){

	}
	public function batchDelete($condition){

	}
	public function update($data, $condition){

	}
	public function get($condition){

	}
	public function getBatch($page, $size, $condition){

	}
	public function count($condition){

	}
}
?>