<?php
require 'Database.php';
require 'model/BuyOffer.php';

$buyoffer = new BuyOffer;
$data = array(
	'uid' => 1,
	'name' => 'test',
	'message' => 'test message.',
	'count' => 100,
	'expiration_date' => time(),
	'dateline' => time(),
);
$buyoffer->add($data);
$condition = array(
	'where' => 'id = :id',
	'params' => array(
		':id' => 31,
	),
);
$buyoffer->delete($condition);
$data['uid'] = 5;
$condition['params'][':id'] = 32;
$result = $buyoffer->get($condition);
print_r($result);
$buyoffer->update($data, $condition);
$result = $buyoffer->get($condition);
print_r($result);
echo $buyoffer->count();
?>
