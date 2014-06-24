<div class="collections index">
	<h2><?php echo __('Collections'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('collection_type'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('official_receipt_id'); ?></th>
			<th><?php echo $this->Paginator->sort('collector_id'); ?></th>
			<th><?php echo $this->Paginator->sort('invoice_number'); ?></th>
			<th><?php echo $this->Paginator->sort('ded1'); ?></th>
			<th><?php echo $this->Paginator->sort('ded2'); ?></th>
			<th><?php echo $this->Paginator->sort('check_amount'); ?></th>
			<th><?php echo $this->Paginator->sort('check_number'); ?></th>
			<th><?php echo $this->Paginator->sort('bank'); ?></th>
			<th><?php echo $this->Paginator->sort('check_dat e'); ?></th>
			<th><?php echo $this->Paginator->sort('check_type'); ?></th>
			<th><?php echo $this->Paginator->sort('currency'); ?></th>
			<th><?php echo $this->Paginator->sort('deposit_date'); ?></th>
			<th><?php echo $this->Paginator->sort('deposit_channel'); ?></th>
			<th><?php echo $this->Paginator->sort('clearing_type_code'); ?></th>
			<th><?php echo $this->Paginator->sort('drawee_bank_code'); ?></th>
			<th><?php echo $this->Paginator->sort('drawee_bank_branch_code'); ?></th>
			<th><?php echo $this->Paginator->sort('check_pickup_date'); ?></th>
			<th><?php echo $this->Paginator->sort('collector_remarks'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($collections as $collection): ?>
	<tr>
		<td><?php echo h($collection['Collection']['id']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['collection_type']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['name']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['created']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['modified']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($collection['OfficialReceipt']['or_number'], array('controller' => 'official_receipts', 'action' => 'view', $collection['OfficialReceipt']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($collection['Collector']['name'], array('controller' => 'collectors', 'action' => 'view', $collection['Collector']['id'])); ?>
		</td>
		<td><?php echo h($collection['Collection']['invoice_number']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['ded1']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['ded2']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['check_amount']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['check_number']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['bank']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['check_dat e']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['check_type']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['currency']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['deposit_date']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['deposit_channel']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['clearing_type_code']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['drawee_bank_code']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['drawee_bank_branch_code']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['check_pickup_date']); ?>&nbsp;</td>
		<td><?php echo h($collection['Collection']['collector_remarks']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $collection['Collection']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $collection['Collection']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $collection['Collection']['id']), null, __('Are you sure you want to delete # %s?', $collection['Collection']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Collection'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Official Receipts'), array('controller' => 'official_receipts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Official Receipt'), array('controller' => 'official_receipts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Collectors'), array('controller' => 'collectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collector'), array('controller' => 'collectors', 'action' => 'add')); ?> </li>
	</ul>
</div>