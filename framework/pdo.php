<?php
$dsn = 'mysql:dbname=e;host=127.0.0.1';
$user = 'root';
$password = '32100321';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

//add
$data = array(
	'uid' => 1,
	'name' => 'no name',
	'message' => 'test',
	'count' => 100,
	'expiration_date' => time(),
	'dateline' => time(),
);
$keys = array_keys($data);
$fields = implode(', ', $keys);
$fieldFlags = implode(', ', array_map(create_function('$str', 'return ":$str";'), $keys));
$sql = "INSERT INTO buy_offer ($fields) values ($fieldFlags)";
$sth = $dbh->prepare($sql);
foreach($data as $key => $value){
	$flag = ":$key";
	$sth->bindValue($flag, $value);
}
$sth->execute();

//delete
//update
//select
$sth = $dbh->prepare('SELECT *
    FROM buy_offer
    WHERE id=:id');
$sth->bindParam(':id', $id, PDO::PARAM_INT);

$id = 1;
$sth->execute();

$result = $sth->fetch(PDO::FETCH_ASSOC);
print_r($result);

$id = 2;
//$sth->bindParam(':id', $id, PDO::PARAM_INT);
$sth->execute();

$result = $sth->fetch(PDO::FETCH_ASSOC);
print_r($result);

//select batch
$uid = 1;
$page = 1;
$size = 10;
$startid = ($page-1) * $size;
$sth = $dbh->prepare('SELECT *
    FROM buy_offer
    WHERE uid=:uid
    LIMIT :startid, :size');
$sth->bindParam(':uid', $uid, PDO::PARAM_INT);
$sth->bindParam(':startid', $startid, PDO::PARAM_INT);
$sth->bindParam(':size', $size, PDO::PARAM_INT);
$sth->execute();

$result = $sth->fetchAll(PDO::FETCH_ASSOC);
//print_r($result);
?>
