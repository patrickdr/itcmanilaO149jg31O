<div class="itineraries view">
<h2><?php echo __('Itinerary'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Seller'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itinerary['Seller']['name'], array('controller' => 'sellers', 'action' => 'view', $itinerary['Seller']['id'])); ?>
			&nbsp;
		</dd>    
		<dt><?php echo __('Buyer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itinerary['Buyer']['name'], array('controller' => 'buyers', 'action' => 'view', $itinerary['Buyer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Itinerary Number'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['itinerary_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trip Type'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['trip_type']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Trip Number'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['trip_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Check Amount'); ?></dt>
		<dd>
			<?php echo h(number_format($itinerary['Itinerary']['amount'], 2)); ?>
			&nbsp;
		</dd>      
		<dt><?php echo __('Remarks'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['remarks']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Received'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['date_received']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Person'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['contact_person']); ?>
			&nbsp;
		</dd>  
		<dt><?php echo __('Contact Number'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['contact_number']); ?>
			&nbsp;
		</dd> 
		<dt><?php echo __('Requestor'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['requestor']); ?>
			&nbsp;
		</dd>    
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['modified']); ?>
			&nbsp;
		</dd>

	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Itinerary'), array('action' => 'edit', $itinerary['Itinerary']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Itinerary'), array('action' => 'delete', $itinerary['Itinerary']['id']), null, __('Are you sure you want to delete # %s?', $itinerary['Itinerary']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Itineraries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itinerary'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buyers'), array('controller' => 'buyers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Buyer'), array('controller' => 'buyers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Trips'), array('controller' => 'trips', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trip'), array('controller' => 'trips', 'action' => 'add')); ?> </li>
	</ul>
</div>
