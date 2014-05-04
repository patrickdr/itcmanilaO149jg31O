<div class="areas form">
<?php echo $this->Form->create('Area', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Admin Multiple Areas'); ?></legend>
	<?php
    
     echo $this->Form->input('file', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

	</ul>
</div>
