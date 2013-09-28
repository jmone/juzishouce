<?php
$condition = array(
	'where' => 'id = :id AND dateline <= :dateline',
	'params' => array(
		':id' => 1,
		':dateline' => strtotime('2013-09-10'),
	),
);
?>
