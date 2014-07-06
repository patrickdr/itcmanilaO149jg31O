<div class="officialReceipts form">
<?php echo $this->Form->create('OfficialReceipt'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Official Receipt'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('collector_id');
		echo $this->Form->input('seller_id');
		echo $this->Form->input('customer_id');
		echo $this->Form->input('or_number');
		echo $this->Form->input('status');
		echo $this->Form->input('date_received');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
  <?= $this->Element('Others/admin_navigation') ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<?= $this->Element('Others/admin_or') ?> 
		<li><?php echo $this->Html->link(__('List Official Receipts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Collectors'), array('controller' => 'collectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collector'), array('controller' => 'collectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sellers'), array('controller' => 'sellers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seller'), array('controller' => 'sellers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
