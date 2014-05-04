<div class="sellers view">
<h2><?php echo __('Seller'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($seller['Seller']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($seller['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $seller['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Area'); ?></dt>
		<dd>
			<?php echo $this->Html->link($seller['Area']['code'], array('controller' => 'areas', 'action' => 'view', $seller['Area']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($seller['Seller']['name']); ?>
			&nbsp;
		</dd>
    
		<dt><?php echo __('Parent Seller'); ?></dt>
		<dd>
			<?php echo $this->Html->link($seller['ParentSeller']['name'], array('controller' => 'sellers', 'action' => 'view', $seller['ParentSeller']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($seller['Address']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($seller['Seller']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($seller['Seller']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Seller'), array('action' => 'edit', $seller['Seller']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Seller'), array('action' => 'delete', $seller['Seller']['id']), null, __('Are you sure you want to delete # %s?', $seller['Seller']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sellers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seller'), array('action' => 'add')); ?> </li>
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
<div class="related">

	<h3><?php echo __('Related Buyers'); ?></h3>
	<?php if (!$seller['Buyer']): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Customer Id'); ?></th>
		<th><?php echo __('Area Id'); ?></th>
		<th><?php echo __('Seller Id'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Customer Buyer Code'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Contact Person'); ?></th>
		<th><?php echo __('Contact Number'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($seller['Buyer'] as $buyer): ?>
		<tr>
			<td><?php echo $buyer['id']; ?></td>
			<td><?php echo $buyer['customer_id']; ?></td>
			<td><?php echo $buyer['area_id']; ?></td>
			<td><?php echo $buyer['seller_id']; ?></td>
			<td><?php echo $buyer['code']; ?></td>
			<td><?php echo $buyer['customer_buyer_code']; ?></td>
			<td><?php echo $buyer['name']; ?></td>
			<td><?php echo $buyer['contact_person']; ?></td>
			<td><?php echo $buyer['contact_number']; ?></td>
			<td><?php echo $buyer['created']; ?></td>
			<td><?php echo $buyer['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'buyers', 'action' => 'view', $buyer['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'buyers', 'action' => 'edit', $buyer['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'buyers', 'action' => 'delete', $buyer['id']), null, __('Are you sure you want to delete # %s?', $buyer['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Buyer'), array('controller' => 'buyers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Seller Affiliates'); ?></h3>
	<?php if (!empty($seller['SellerAffiliate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Customer Id'); ?></th>
		<th><?php echo __('Area Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Seller Id'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($seller['SellerAffiliate'] as $seller): ?>
		<tr>
			<td><?php echo $seller['id']; ?></td>
			<td><?php echo $seller['customer_id']; ?></td>
			<td><?php echo $seller['area_id']; ?></td>
			<td><?php echo $seller['name']; ?></td>
			<td><?php echo $seller['seller_id']; ?></td>
			<td><?php echo $seller['address']; ?></td>
			<td><?php echo $seller['created']; ?></td>
			<td><?php echo $seller['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sellers', 'action' => 'view', $seller['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sellers', 'action' => 'edit', $seller['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sellers', 'action' => 'delete', $seller['id']), null, __('Are you sure you want to delete # %s?', $seller['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Seller'), array('controller' => 'sellers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
