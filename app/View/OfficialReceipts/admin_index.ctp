<div class="officialReceipts index">

  <h2><?php echo __('Search Official Receipts'); ?></h2>
  <?php echo $this->Form->create('Search', array('type' => 'get')); ?>
  <table cellpadding="0" cellspacing="0">
    <td><?= $this->Form->input('seller_id', array('empty' => '---Select---', 'selected' => isset($this->request->query['seller_id']) ? $this->request->query['seller_id'] : "")) ?></td>
    <td><?= $this->Form->input('seller_affiliate_id', array('empty' => '---Select---', 'selected' => isset($this->request->query['seller_affiliate_id']) ? $this->request->query['seller_affiliate_id'] : ""))  ?></td>
    <td><?= $this->Form->input('status', array('empty' => '---Select---', 'selected' => isset($this->request->query['status']) ? $this->request->query['status'] : "", 'options' => $this->OfficialReceipt->getStatuses()))  ?></td>
    <td><?= $this->Form->submit('Search')  ?></td>
  </table>
  <?php echo $this->Form->end(); ?>
  
	<h2><?php echo __('Official Receipts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('seller_id'); ?></th>
      <th><?php echo $this->Paginator->sort('seller_affiliate_id'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('or_number'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('date_received'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($officialReceipts as $officialReceipt): ?>
	<tr>
		<td><?php echo h($officialReceipt['OfficialReceipt']['id']); ?>&nbsp;</td>

		<td>
			<?php echo $this->Html->link($officialReceipt['Seller']['name'], array('controller' => 'sellers', 'action' => 'view', $officialReceipt['Seller']['id'])); ?>
		</td>
		<td>
      <?php echo $this->Html->link($officialReceipt['SellerAffiliate']['name'], array('controller' => 'sellers', 'action' => 'view', $officialReceipt['SellerAffiliate']['id'])); ?>
		</td>    
		<td>
			<?php echo $this->Html->link($officialReceipt['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $officialReceipt['Customer']['id'])); ?>
		</td>
		<td><?php echo h($officialReceipt['OfficialReceipt']['or_number']); ?>&nbsp;</td>
		<td><?php echo h($this->OfficialReceipt->stringify('status', $officialReceipt['OfficialReceipt']['status'])); ?>&nbsp;</td>
		<td><?php echo h($officialReceipt['OfficialReceipt']['date_received']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $officialReceipt['OfficialReceipt']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $officialReceipt['OfficialReceipt']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $officialReceipt['OfficialReceipt']['id']), null, __('Are you sure you want to delete # %s?', $officialReceipt['OfficialReceipt']['id'])); ?>
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
  <?= $this->Element('Others/admin_navigation') ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
    <?= $this->Element('Others/admin_or') ?> 
		<li><?php echo $this->Html->link(__('New Collector'), array('controller' => 'collectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sellers'), array('controller' => 'sellers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seller'), array('controller' => 'sellers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
