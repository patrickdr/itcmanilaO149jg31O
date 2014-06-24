<div class="collections view">
<h2><?php echo __('Collection'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Collection Type'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['collection_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Official Receipt'); ?></dt>
		<dd>
			<?php echo $this->Html->link($collection['OfficialReceipt']['or_number'], array('controller' => 'official_receipts', 'action' => 'view', $collection['OfficialReceipt']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Collector'); ?></dt>
		<dd>
			<?php echo $this->Html->link($collection['Collector']['name'], array('controller' => 'collectors', 'action' => 'view', $collection['Collector']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Invoice Number'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['invoice_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ded1'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['ded1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ded2'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['ded2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Check Amount'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['check_amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Check Number'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['check_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bank'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['bank']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Check Dat E'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['check_dat e']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Check Type'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['check_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Currency'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deposit Date'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['deposit_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deposit Channel'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['deposit_channel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Clearing Type Code'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['clearing_type_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Drawee Bank Code'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['drawee_bank_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Drawee Bank Branch Code'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['drawee_bank_branch_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Check Pickup Date'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['check_pickup_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Collector Remarks'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['collector_remarks']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Collection'), array('action' => 'edit', $collection['Collection']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Collection'), array('action' => 'delete', $collection['Collection']['id']), null, __('Are you sure you want to delete # %s?', $collection['Collection']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Collections'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collection'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Official Receipts'), array('controller' => 'official_receipts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Official Receipt'), array('controller' => 'official_receipts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Collectors'), array('controller' => 'collectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collector'), array('controller' => 'collectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
