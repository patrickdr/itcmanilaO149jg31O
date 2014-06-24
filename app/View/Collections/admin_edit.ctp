<div class="collections form">
<?php echo $this->Form->create('Collection'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Collection'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('collection_type');
		echo $this->Form->input('name');
		echo $this->Form->input('official_receipt_id');
		echo $this->Form->input('collector_id');
		echo $this->Form->input('invoice_number');
		echo $this->Form->input('ded1');
		echo $this->Form->input('ded2');
		echo $this->Form->input('check_amount');
		echo $this->Form->input('check_number');
		echo $this->Form->input('bank');
		echo $this->Form->input('check_dat e');
		echo $this->Form->input('check_type');
		echo $this->Form->input('currency');
		echo $this->Form->input('deposit_date');
		echo $this->Form->input('deposit_channel');
		echo $this->Form->input('clearing_type_code');
		echo $this->Form->input('drawee_bank_code');
		echo $this->Form->input('drawee_bank_branch_code');
		echo $this->Form->input('check_pickup_date');
		echo $this->Form->input('collector_remarks');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Collection.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Collection.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Collections'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Official Receipts'), array('controller' => 'official_receipts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Official Receipt'), array('controller' => 'official_receipts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Collectors'), array('controller' => 'collectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collector'), array('controller' => 'collectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
