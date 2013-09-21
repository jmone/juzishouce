<?php
$link = mysql_connect('localhost', 'root', '32100321');

$result = mysql_list_tables("e", $link);
while ($row = mysql_fetch_row($result)) {
	$table = $row[0];
	$class_name = explode('_', $table);
	$class_name = array_map('strtolower', $class_name);
	$class_name = array_map('ucfirst', $class_name);
	$class = implode('', $class_name);

	$fields = mysql_list_fields("e", $table, $link);
	$columns = mysql_num_fields($fields);

/*
*/
	$field_array = array();
	for ($i = 0; $i < $columns; $i++) {
		$field = mysql_field_name($fields, $i);
		$field_array[] = $field;
		echo $field . "\t";
		echo mysql_field_type($fields, $i) . "\t";
		echo mysql_field_flags($fields, $i) . "\t";
		echo mysql_field_len($fields, $i) . "\n";
	}
	print_r($field_array);
	$data_str = "\$data = array_merge(array(\n";
	foreach($field_array as $field){
		$data_str .= "\t\t\t'$field' => '',\n";
	}
	$data_str .= "\t\t), \$data);\n";

	$insert_fields = implode(', ', $field_array);
	$insert_field_flags = implode(', ', array_map(create_function('$str', 'return ":$str";'), $field_array));
	$sql = "INSERT INTO $table ($insert_fields) values ($insert_field_flags)";

	$add_str = $delete_str = $batch_delete_str = $update_str = $get_str = $get_batch_str = $count_str = '';

	$add_str = <<<EOF
\$keys = array_keys(\$data);
		\$sql = '$sql';
		\$sth = \$dbh->prepare(\$sql);
		foreach(\$data as \$key => \$value){
			\$flag = ":\$key";
			\$sth->bindValue(\$flag, \$value);
		}
		\$sth->execute();
EOF;
	$content = <<<EOF
<?php
class $class{
	public function add(\$data){
		$data_str
		$add_str
	}
	public function delete(\$condition){

	}
	public function batchDelete(\$condition){

	}
	public function update(\$data, \$condition){

	}
	public function get(\$condition){

	}
	public function getBatch(\$page, \$size, \$condition){

	}
	public function count(\$condition){

	}
}
?>
EOF;

	echo $content;
	file_put_contents('model/'.$class.'.php', $content);

}

?>
