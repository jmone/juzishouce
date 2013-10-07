<?php
$role = 'company';
$models = array('BuyOffer', 'CommonUser', 'CompanyUser', 'Event', 'Exhibition', 'FriendLink', 'Message', 'News', 'Position', 'SellOffer', 'User');

$actions = array('manage', 'create', 'delete', 'get', 'list', 'search');

$roleAction = ucfirst($role).'Action';
$dir = 'actions/'.$role;
if(!is_dir($dir)){
	mkdir_r($dir);
}
$path = $dir.'/'.$roleAction.'.php';
$content = <<<EOF
<?php
class $roleAction extends Action{
	function role(){

	}
}
?>
EOF;
file_put_contents($path, $content);

//all actions
$managecontent = <<<EOF
<?php
class ManageAction extends $roleAction{
	function run(){

	}
}
?>
EOF;

$createcontent = <<<EOF
<?php
class CreateAction extends $roleAction{
	function run(){

	}
}
?>
EOF;

$deletecontent = <<<EOF
<?php
class DeleteAction extends $roleAction{
	function run(){

	}
}
?>
EOF;

$updatecontent = <<<EOF
<?php
class UpdateAction extends $roleAction{
	function run(){

	}
}
?>
EOF;

$getcontent = <<<EOF
<?php
class GetAction extends $roleAction{
	function run(){

	}
}
?>
EOF;

$listcontent = <<<EOF
<?php
class ListAction extends $roleAction{
	function run(){

	}
}
?>
EOF;

$searchcontent = <<<EOF
<?php
class SearchAction extends $roleAction{
	function run(){

	}
}
?>
EOF;


foreach($models as $model){
	foreach($actions as $action){
		$dir = 'actions/'.$role.'/'.strtolower($model);
		if(!is_dir($dir)){
			mkdir_r($dir);
		}
		$path = $dir.'/'.ucfirst($action).'Action.php';
		file_put_contents($path, ${$action.'content'});
	}
}

function mkdir_r($dirName, $rights=0777){
    $dirs = explode('/', $dirName);
    $dir='';
    foreach ($dirs as $part) {
        $dir.=$part.'/';
        if (!is_dir($dir) && strlen($dir)>0)
            mkdir($dir, $rights);
    }
}
?>
