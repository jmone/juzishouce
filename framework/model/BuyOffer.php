<?php
class BuyOffer{
	public function add($data){
		$data = array_merge(array(
			'id' => '',
			'uid' => '',
			'name' => '',
			'message' => '',
			'count' => '',
			'expiration_date' => '',
			'dateline' => '',
		), $data);

		$keys = array_keys($data);
		$sql = 'INSERT INTO buy_offer (id, uid, name, message, count, expiration_date, dateline) values (:id, :uid, :name, :message, :count, :expiration_date, :dateline)';
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