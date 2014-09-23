<div class="itineraries form">
<?php echo $this->Form->create('Itinerary'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Itinerary'); ?></legend>
	<?php
		echo $this->Form->input('buyer_id');
		echo $this->Form->input('itinerary_type');
		echo $this->Form->input('trip_id');
		echo $this->Form->input('name');
		echo $this->Form->input('trip_number');
		echo $this->Form->input('remarks');
		echo $this->Form->input('date_received');
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
  <?= $this->Element('Others/admin_navigation') ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Itineraries'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Buyers'), array('controller' => 'buyers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Buyer'), array('controller' => 'buyers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Trips'), array('controller' => 'trips', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trip'), array('controller' => 'trips', 'action' => 'add')); ?> </li>
	</ul>
</div>
