<div class="trips view">
<h2><?php echo __('Trip'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($trip['Trip']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Collector'); ?></dt>
		<dd>
			<?php echo $this->Html->link($trip['Collector']['name'], array('controller' => 'collectors', 'action' => 'view', $trip['Collector']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trip Type'); ?></dt>
		<dd>
			<?php echo h($trip['Trip']['trip_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($trip['Trip']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($trip['Trip']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
  <?= $this->Element('Others/admin_navigation') ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Trip'), array('action' => 'edit', $trip['Trip']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Trip'), array('action' => 'delete', $trip['Trip']['id']), null, __('Are you sure you want to delete # %s?', $trip['Trip']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Trips'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trip'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Collectors'), array('controller' => 'collectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collector'), array('controller' => 'collectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Itineraries'), array('controller' => 'itineraries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itinerary'), array('controller' => 'itineraries', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Itineraries'); ?></h3>
	<?php if (!empty($trip['Itinerary'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
			<th><?php echo __('Buyer.name'); ?></th>
      <th><?php echo __('SellerName'); ?></th>
      <th><?php echo __('SellerAffiliate'); ?></th>
			<th><?php echo __('Trip Type'); ?></th>      
			<th><?php echo __('Acknowledged By'); ?></th>
      <th><?php echo __('Acknowledged Receipt', 'IT number'); ?></th>
			<th><?php echo __('Acknowledged Date'); ?></th>
			<th><?php echo __('Date Received'); ?></th>
			<th><?php echo __('Reason code'); ?></th>
			<th><?php echo __('Result Status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($itineraries as $itinerary): ?>
	<tr>
		<td>
			<?php echo $this->Html->link(
        String::truncate($itinerary['Buyer']['name'], 15, array('ellipsis' => '...')), 
        array(
          'controller' => 'buyers', 
          'action' => 'view', 
          $itinerary['Buyer']['id']
        ),
        array(
          'title' => $itinerary['Buyer']['name']
        )
      ); ?>
		</td>
    <td>
      <?php if(isset($itinerary['SellerAffiliate']['ParentSeller'])): ?>
        <?php echo $this->Html->link($itinerary['SellerAffiliate']['ParentSeller']['name'], array('controller' => 'sellers', 'action' => 'view', $itinerary['SellerAffiliate']['ParentSeller']['id'])); ?>
      <?php else: ?>
        <?php echo $this->Html->link($itinerary['Seller']['name'], array('controller' => 'sellers', 'action' => 'view', $itinerary['Seller']['id'])); ?>
      <?php endif; ?>
    </td>
    <td>
      <?php
        if($itinerary['SellerAffiliate']['name']){
          echo $this->Html->link($itinerary['SellerAffiliate']['name'], array('controller' => 'sellers', 'action' => 'view', $itinerary['SellerAffiliate']['id'])); 
        }
       ?>
    </td>
		<td>
			<?php echo h($itinerary['Itinerary']['trip_type']); ?>
		</td>
		<td><?php echo h($itinerary['Itinerary']['acknowledged_by']); ?>&nbsp;</td>
    <td><?php echo h($itinerary['Itinerary']['acknowledged_receipt']); ?>&nbsp;</td>
		<td><?php echo h(String::truncate($itinerary['Itinerary']['acknowledged_date'], 20, array('ellipsis' => '...'))); ?>&nbsp;</td>
		<td><?php echo h(date('Y-m-d', strtotime($itinerary['Itinerary']['date_received']))); ?>&nbsp;</td>
    <td><?php echo h(String::truncate($itinerary['Itinerary']['reason_id'], 15, array('ellipsis' => '...'))); ?>&nbsp;</td>
		<td><?php echo h($this->Itinerary->stringify('results', $itinerary['Itinerary']['result_status'])); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('controller' => 'itineraries', 'action' => 'view', $itinerary['Itinerary']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('controller' => 'itineraries', 'action' => 'edit', $itinerary['Itinerary']['id'])); ?>
      <?php echo $this->Html->link(__('Update'), array('controller' => 'itineraries', 'action' => 'update', $itinerary['Itinerary']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'itineraries', 'action' => 'delete', $itinerary['Itinerary']['id']), null, __('Are you sure you want to delete # %s?', $itinerary['Itinerary']['id'])); ?>
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
