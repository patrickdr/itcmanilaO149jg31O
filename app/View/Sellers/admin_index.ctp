<div class="sellers index">
	<h2><?php echo __('Sellers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('area_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('seller_id', 'Base Seller'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($sellers as $seller): ?>
	<tr>
		<td><?php echo h($seller['Seller']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($seller['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $seller['Customer']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($seller['Area']['code'], array('controller' => 'areas', 'action' => 'view', $seller['Area']['id'])); ?>
		</td>
		<td><?php echo h($seller['Seller']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($seller['ParentSeller']['name'], array('controller' => 'sellers', 'action' => 'view', $seller['ParentSeller']['id'])); ?>
		</td>
		<td><?php echo h($seller['Seller']['address']); ?>&nbsp;</td>
		<td><?php echo h($seller['Seller']['created']); ?>&nbsp;</td>
		<td><?php echo h($seller['Seller']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $seller['Seller']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $seller['Seller']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $seller['Seller']['id']), null, __('Are you sure you want to delete # %s?', $seller['Seller']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Seller'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Areas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sellers'), array('controller' => 'sellers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seller'), array('controller' => 'sellers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buyers'), array('controller' => 'buyers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Buyer'), array('controller' => 'buyers', 'action' => 'add')); ?> </li>
	</ul>
</div>
