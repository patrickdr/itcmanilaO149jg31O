<div class="itineraries index">
	<h2><?php echo __('Itineraries'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Buyer.name'); ?></th>
      <th><?php echo __('SellerName'); ?></th>
      <th><?php echo __('SellerAffiliate'); ?></th>
			<th><?php echo $this->Paginator->sort('trip_type'); ?></th>      
			<th><?php echo $this->Paginator->sort('trip_id'); ?></th>
      <th><?php echo $this->Paginator->sort('itinerary_number', 'IT number'); ?></th>
			<th><?php echo $this->Paginator->sort('remarks'); ?></th>
			<th><?php echo $this->Paginator->sort('date_received'); ?></th>
			<th><?php echo $this->Paginator->sort('contact_number'); ?></th>
			<th><?php echo $this->Paginator->sort('contact_person'); ?></th>
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
		<td><?php echo h($itinerary['Itinerary']['trip_id']); ?>&nbsp;</td>
    <td><?php echo h($itinerary['Itinerary']['itinerary_number']); ?>&nbsp;</td>
		<td><?php echo h(String::truncate($itinerary['Itinerary']['remarks'], 20, array('ellipsis' => '...'))); ?>&nbsp;</td>
		<td><?php echo h(date('Y-m-d', strtotime($itinerary['Itinerary']['date_received']))); ?>&nbsp;</td>
    <td><?php echo h(String::truncate($itinerary['Itinerary']['contact_number'], 15, array('ellipsis' => '...'))); ?>&nbsp;</td>
		<td><?php echo h($itinerary['Itinerary']['contact_person']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $itinerary['Itinerary']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $itinerary['Itinerary']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $itinerary['Itinerary']['id']), null, __('Are you sure you want to delete # %s?', $itinerary['Itinerary']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Itinerary'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Buyers'), array('controller' => 'buyers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Buyer'), array('controller' => 'buyers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Trips'), array('controller' => 'trips', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trip'), array('controller' => 'trips', 'action' => 'add')); ?> </li>
    <li><?php echo $this->Html->link(__('Upload ITD'), array('controller' => 'itineraries', 'action' => 'upload')); ?> </li>
	</ul>
</div>
