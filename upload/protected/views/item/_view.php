<?php
/* @var $this ItemController */
/* @var $data Item */
?>

<div class="view">

	<?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo mb_substr(CHtml::encode($data->content), 0, 500, 'UTF-8'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateline')); ?>:</b>
	<?php echo date('Y-m-d', $data->dateline); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('view_count')); ?>:</b>
	<?php echo CHtml::encode($data->view_count); ?>
	<br />

	<?php
	if(!empty($data->keywords)){
	?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('keywords')); ?>:</b>
	<?php echo CHtml::encode($data->keywords); ?>
	<br />
	<?php
	}
	?>


</div>
