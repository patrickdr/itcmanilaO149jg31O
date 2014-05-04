<div class="collectors form">
<?php echo $this->Form->create('Collector'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Collector'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('code');
		echo $this->Form->input('contact_number');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Collector.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Collector.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Collectors'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Trips'), array('controller' => 'trips', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trip'), array('controller' => 'trips', 'action' => 'add')); ?> </li>
	</ul>
</div>
