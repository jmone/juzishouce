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
//add
	$data_str = "\$data = array_merge(array(\n";
	foreach($field_array as $field){
		$data_str .= "\t\t\t'$field' => '',\n";
	}
	$data_str .= "\t\t), \$data);\n";

	$insert_fields = implode(', ', $field_array);
	$insert_field_flags = implode(', ', array_map(create_function('$str', 'return ":$str";'), $field_array));
	$sql = "INSERT INTO $table ($insert_fields) values ($insert_field_flags)";

	$add_str = $delete_str = $batch_delete_str = $update_str = $get_str = $get_batch_str = $count_str = '';

	$bindStr = '';
	foreach($field_array as $field){
		$bindStr .= "\t\t\$sth->bindValue(':$field', \$data['$field']);\n";
	}
	$add_str = <<<EOF
\$sql = '$sql';
		\$sth = \$this->dbh->prepare(\$sql);
$bindStr\t\t\$sth->execute();
EOF;
//delete
/*
	$sql = "DELETE FROM $table";
	if(isset($condition['where']) && $condition['where']){
		$sql .= " WHERE {$condition['where']}";
	}
	$sth = $dbh->prepare($sql);
	if(is_array($condition['params']) && !empty($condition['params'])){
		foreach($condition['params'] as $key => $value){
			$sth->bindValue($key, $value);
		}
	}
	$sth->execute();
*/

//update
	$update_sql = "UPDATE $table SET";
	foreach($field_array as $field){
		$update_sql .= " $field=:$field,";
	}
	$update_sql = substr($update_sql, 0, -1);

	$update_bind_str = '';
	foreach($field_array as $field){
		$update_bind_str .= "\t\t\$sth->bindValue(':$field', \$data['$field']);\n";
	}

	$update_str = <<<EOF
\$sql = '$update_sql';
		if(isset(\$condition['where']) && \$condition['where']){
			\$sql .= " WHERE {\$condition['where']}";
		}
		\$sth = \$this->dbh->prepare(\$sql);
$update_bind_str
		if(is_array(\$condition['params']) && !empty(\$condition['params'])){
			foreach(\$condition['params'] as \$key => \$value){
				\$sth->bindValue(\$key, \$value);
			}
		}
		\$sth->execute();
EOF;

	$content = <<<EOF
<?php
class $class extends Database{
	public function add(\$data){
		$data_str
		$add_str
	}
	public function delete(\$condition){
		\$sql = "DELETE FROM $table";
		if(isset(\$condition['where']) && \$condition['where']){
			\$sql .= " WHERE {\$condition['where']}";
		}
		\$sth = \$this->dbh->prepare(\$sql);
		if(is_array(\$condition['params']) && !empty(\$condition['params'])){
			foreach(\$condition['params'] as \$key => \$value){
				\$sth->bindValue(\$key, \$value);
			}
		}
		\$sth->execute();
	}
	public function update(\$data, \$condition){
		$data_str
		$update_str
	}
	public function get(\$condition){
		\$sql = "SELECT * FROM $table";
		if(isset(\$condition['where']) && \$condition['where']){
			\$sql .= " WHERE {\$condition['where']}";
		}
		\$sth = \$this->dbh->prepare(\$sql);
		if(is_array(\$condition['params']) && !empty(\$condition['params'])){
			foreach(\$condition['params'] as \$key => \$value){
				\$sth->bindValue(\$key, \$value);
			}
		}
		\$sth->execute();
		return \$sth->fetch(PDO::FETCH_ASSOC);
	}
	public function getBatch(\$page, \$size, \$condition){
		\$sql = "SELECT * FROM $table";
		if(isset(\$condition['where']) && \$condition['where']){
			\$sql .= " WHERE {\$condition['where']}";
		}
		\$sql .= " LIMIT :startid, :size";
		\$sth = \$this->dbh->prepare(\$sql);
		if(is_array(\$condition['params']) && !empty(\$condition['params'])){
			foreach(\$condition['params'] as \$key => \$value){
				\$sth->bindValue(\$key, \$value);
			}
		}
		\$sth->bindValue(':startid', \$startid, PDO::PARAM_INT);
		\$sth->bindValue(':size', \$size, PDO::PARAM_INT);
		\$sth->execute();

		return \$sth->fetchAll(PDO::FETCH_ASSOC);
	}
	public function count(\$condition = null){
		\$sql = "SELECT count(*) FROM $table";
		if(isset(\$condition['where']) && \$condition['where']){
			\$sql .= " WHERE {\$condition['where']}";
		}
		\$sth = \$this->dbh->prepare(\$sql);
		if(isset(\$condition['params']) && is_array(\$condition['params']) && !empty(\$condition['params'])){
			foreach(\$condition['params'] as \$key => \$value){
				\$sth->bindValue(\$key, \$value);
			}
		}
		\$sth->execute();
		return \$sth->fetchColumn();
	}
}
?>
EOF;

	echo $content;
	file_put_contents('model/'.$class.'.php', $content);

}

?>
