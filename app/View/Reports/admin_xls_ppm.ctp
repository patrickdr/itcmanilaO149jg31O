<div class="reports form">
<?php echo $this->Form->create('PPM', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Upload Excel File to convert to PPM'); ?></legend>
	<?php 
    echo $this->Form->input('file', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Convert')); ?>
</div>
<div class="actions">
  <?= $this->Element('Others/admin_navigation') ?>
</div>
