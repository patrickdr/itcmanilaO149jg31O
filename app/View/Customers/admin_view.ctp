<div class="customers view">
<h2><?php echo __('Customer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Person'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['contact_person']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Number'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['contact_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
  <?= $this->Element('Others/admin_navigation') ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Customer'), array('action' => 'edit', $customer['Customer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Customer'), array('action' => 'delete', $customer['Customer']['id']), null, __('Are you sure you want to delete # %s?', $customer['Customer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Areas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buyers'), array('controller' => 'buyers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Buyer'), array('controller' => 'buyers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sellers'), array('controller' => 'sellers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seller'), array('controller' => 'sellers', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Buyers'); ?></h3>
	<?php if (!empty($customer['Buyer'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Customer Id'); ?></th>
		<th><?php echo __('Area Id'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Contact Person'); ?></th>
		<th><?php echo __('Contact Number'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($customer['Buyer'] as $buyer): ?>
		<tr>
			<td><?php echo $buyer['id']; ?></td>
			<td><?php echo $buyer['customer_id']; ?></td>
			<td><?php echo $buyer['area_id']; ?></td>
			<td><?php echo $buyer['code']; ?></td>
			<td><?php echo $buyer['name']; ?></td>
			<td><?php echo $buyer['created']; ?></td>
			<td><?php echo $buyer['modified']; ?></td>
			<td><?php echo $buyer['contact_person']; ?></td>
			<td><?php echo $buyer['contact_number']; ?></td>
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
	<h3><?php echo __('Related Sellers'); ?></h3>
	<?php if (!empty($customer['Seller'])): ?>
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
	<?php foreach ($customer['Seller'] as $seller): ?>
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
