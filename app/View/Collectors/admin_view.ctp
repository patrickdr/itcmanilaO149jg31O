<div class="collectors view">
<h2><?php echo __('Collector'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($collector['Collector']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($collector['Collector']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($collector['Collector']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Number'); ?></dt>
		<dd>
			<?php echo h($collector['Collector']['contact_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($collector['Collector']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($collector['Collector']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Collector'), array('action' => 'edit', $collector['Collector']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Collector'), array('action' => 'delete', $collector['Collector']['id']), null, __('Are you sure you want to delete # %s?', $collector['Collector']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Collectors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collector'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Trips'), array('controller' => 'trips', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trip'), array('controller' => 'trips', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Trips'); ?></h3>
	<?php if (!empty($collector['Trip'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Collector Id'); ?></th>
		<th><?php echo __('Itinerary Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($collector['Trip'] as $trip): ?>
		<tr>
			<td><?php echo $trip['id']; ?></td>
			<td><?php echo $trip['collector_id']; ?></td>
			<td><?php echo $trip['itinerary_id']; ?></td>
			<td><?php echo $trip['created']; ?></td>
			<td><?php echo $trip['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'trips', 'action' => 'view', $trip['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'trips', 'action' => 'edit', $trip['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'trips', 'action' => 'delete', $trip['id']), null, __('Are you sure you want to delete # %s?', $trip['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Trip'), array('controller' => 'trips', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
