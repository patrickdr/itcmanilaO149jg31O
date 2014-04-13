<div class="users form">

	<fieldset>
		<legend><?php echo __('Administrator Login'); ?></legend>
	<?php
		echo $this->Form->create(array('action'=>'admin_login'));
		echo $this->Form->input('username');
		echo $this->Form->input('password', array('type'=>'password'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>