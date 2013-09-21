<?php
class Message{
	public function add($data){
		$data = array_merge(array(
			'id' => '',
			'from_uid' => '',
			'to_uid' => '',
			'title' => '',
			'content' => '',
			'dateline' => '',
		), $data);

		$keys = array_keys($data);
		$sql = 'INSERT INTO message (id, from_uid, to_uid, title, content, dateline) values (:id, :from_uid, :to_uid, :title, :content, :dateline)';
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