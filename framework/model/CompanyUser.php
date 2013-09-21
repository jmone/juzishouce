<?php
class CompanyUser{
	public function add($data){
		$data = array_merge(array(
			'uid' => '',
			'name' => '',
		), $data);

		$keys = array_keys($data);
		$sql = 'INSERT INTO company_user (uid, name) values (:uid, :name)';
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