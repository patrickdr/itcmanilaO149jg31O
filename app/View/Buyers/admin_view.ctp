<div class="buyers view">
<h2><?php echo __('Buyer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($buyer['Buyer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($buyer['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $buyer['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Seller'); ?></dt>
		<dd>
			<?php echo $this->Html->link($buyer['Seller']['name'], array('controller' => 'sellers', 'action' => 'view', $buyer['Seller']['id'])); ?>
			&nbsp;
		</dd>    
		<dt><?php echo __('Area'); ?></dt>
		<dd>
			<?php echo $this->Html->link($buyer['Area']['code'], array('controller' => 'areas', 'action' => 'view', $buyer['Area']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($buyer['Address']['address']); ?>
			&nbsp;
		</dd>      
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($buyer['Buyer']['code']); ?>
			&nbsp;
		</dd>
 
		<dt><?php echo __('CustomerBuyerCode'); ?></dt>
		<dd>
			<?php echo h($buyer['Buyer']['customer_buyer_code']); ?>
			&nbsp;
		</dd>    
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($buyer['Buyer']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($buyer['Buyer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($buyer['Buyer']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Person'); ?></dt>
		<dd>
			<?php echo h($buyer['Buyer']['contact_person']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Number'); ?></dt>
		<dd>
			<?php echo h($buyer['Buyer']['contact_number']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Buyer'), array('action' => 'edit', $buyer['Buyer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Buyer'), array('action' => 'delete', $buyer['Buyer']['id']), null, __('Are you sure you want to delete # %s?', $buyer['Buyer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Buyers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Buyer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Areas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Itineraries'), array('controller' => 'itineraries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itinerary'), array('controller' => 'itineraries', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Itineraries'); ?></h3>
	<?php if (!empty($buyer['Itinerary'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Buyer Id'); ?></th>
		<th><?php echo __('Itinerary Type'); ?></th>
		<th><?php echo __('Trip Type'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Trip Number'); ?></th>
		<th><?php echo __('Remarks'); ?></th>
		<th><?php echo __('Date Received'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($buyer['Itinerary'] as $itinerary): ?>
		<tr>
			<td><?php echo $itinerary['id']; ?></td>
			<td><?php echo $itinerary['buyer_id']; ?></td>
			<td><?php echo $itinerary['itinerary_type']; ?></td>
			<td><?php echo $itinerary['trip_type']; ?></td>
			<td><?php echo $itinerary['name']; ?></td>
			<td><?php echo $itinerary['trip_number']; ?></td>
			<td><?php echo $itinerary['remarks']; ?></td>
			<td><?php echo $itinerary['date_received']; ?></td>
			<td><?php echo $itinerary['created']; ?></td>
			<td><?php echo $itinerary['modified']; ?></td>
			<td><?php echo $itinerary['type']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'itineraries', 'action' => 'view', $itinerary['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'itineraries', 'action' => 'edit', $itinerary['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'itineraries', 'action' => 'delete', $itinerary['id']), null, __('Are you sure you want to delete # %s?', $itinerary['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Itinerary'), array('controller' => 'itineraries', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
