<?php
  $colspan = ($affiliate) ? 7 : 6;
?>
<div class="sellers index">
  <h2><?php echo __('Search Buyers'); ?></h2>
  <?php echo $this->Form->create('Search', array('type' => 'get')); ?>
  <table cellpadding="0" cellspacing="0">
    <td><?= $this->Form->input('customer_id', array('empty' => "--- Customer ---", 'value' => isset($this->request->query['customer_id']) ? $this->request->query['customer_id'] : "")) ?></td>
    <td>
      <?= $this->Form->input('name', array('label' => 'SellerName', 'value' => isset($this->request->query['name']) ? $this->request->query['name'] : ""))  ?>
    </td>    
    <td><?= $this->Form->submit('Search')  ?></td>
  </table>
  <?php echo $this->Form->end(); ?>
	<h2><?php echo __('Sellers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			
      <?php if($affiliate):?>
        <th><?php echo $this->Paginator->sort('ParentSeller.name', 'SellerName'); ?></th>
        <th><?php echo $this->Paginator->sort('name', 'SellerAffiliate'); ?></th>
      <?php else: ?>
        <th><?php echo $this->Paginator->sort('name', 'SellerName'); ?></th>
      <?php endif; ?>
      <th><?php echo $this->Paginator->sort('customer_id', 'CustomerName'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($sellers as $seller): ?>
	<tr>
		
    <?php if($affiliate) : ?>
      <td><?php echo h($seller['ParentSeller']['name']); ?>&nbsp;</td>
      <td><?php echo h($seller['Seller']['name']); ?>&nbsp;</td>
    <?php else: ?>
      <td><?php echo h($seller['Seller']['name']); ?>&nbsp;</td>
    <?php endif; ?>
    <td>
			<?php echo $this->Html->link($seller['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $seller['Customer']['id'])); ?>
		</td>
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
  <?= $this->Element('Others/admin_navigation') ?>
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
