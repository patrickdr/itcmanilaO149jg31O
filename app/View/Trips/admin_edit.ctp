<div class="trips form">
<?php echo $this->Form->create('Trip'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Trip'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('collector_id');
		echo $this->Form->input('trip_type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Trip.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Trip.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Trips'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Collectors'), array('controller' => 'collectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collector'), array('controller' => 'collectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Itineraries'), array('controller' => 'itineraries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itinerary'), array('controller' => 'itineraries', 'action' => 'add')); ?> </li>
	</ul>
</div>
