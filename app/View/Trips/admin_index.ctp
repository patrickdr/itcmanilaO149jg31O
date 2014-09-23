<div class="trips index">
	<h2><?php echo __('Trips'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('collector_id'); ?></th>
			<th><?php echo $this->Paginator->sort('trip_type'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($trips as $trip): ?>
	<tr>
		<td><?php echo h($trip['Trip']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($trip['Collector']['name'], array('controller' => 'collectors', 'action' => 'view', $trip['Collector']['id'])); ?>
		</td>
		<td><?php echo h($trip['Trip']['trip_type']); ?>&nbsp;</td>
		<td><?php echo h($trip['Trip']['created']); ?>&nbsp;</td>
		<td><?php echo h($trip['Trip']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $trip['Trip']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $trip['Trip']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $trip['Trip']['id']), null, __('Are you sure you want to delete # %s?', $trip['Trip']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Trip'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Collectors'), array('controller' => 'collectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collector'), array('controller' => 'collectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Itineraries'), array('controller' => 'itineraries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itinerary'), array('controller' => 'itineraries', 'action' => 'add')); ?> </li>
	</ul>
</div>
