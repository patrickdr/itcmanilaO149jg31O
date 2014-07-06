<div class="officialReceipts view">
<h2><?php echo __('Official Receipt'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($officialReceipt['OfficialReceipt']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Collector'); ?></dt>
		<dd>
			<?php echo $this->Html->link($officialReceipt['Collector']['name'], array('controller' => 'collectors', 'action' => 'view', $officialReceipt['Collector']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Seller'); ?></dt>
		<dd>
			<?php echo $this->Html->link($officialReceipt['Seller']['name'], array('controller' => 'sellers', 'action' => 'view', $officialReceipt['Seller']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($officialReceipt['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $officialReceipt['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Or Number'); ?></dt>
		<dd>
			<?php echo h($officialReceipt['OfficialReceipt']['or_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($officialReceipt['OfficialReceipt']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Received'); ?></dt>
		<dd>
			<?php echo h($officialReceipt['OfficialReceipt']['date_received']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($officialReceipt['OfficialReceipt']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($officialReceipt['OfficialReceipt']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
  <?= $this->Element('Others/admin_navigation') ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?= $this->Element('Others/admin_or') ?> 
		<li><?php echo $this->Html->link(__('Edit Official Receipt'), array('action' => 'edit', $officialReceipt['OfficialReceipt']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Official Receipt'), array('action' => 'delete', $officialReceipt['OfficialReceipt']['id']), null, __('Are you sure you want to delete # %s?', $officialReceipt['OfficialReceipt']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Official Receipts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Official Receipt'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Collectors'), array('controller' => 'collectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collector'), array('controller' => 'collectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sellers'), array('controller' => 'sellers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seller'), array('controller' => 'sellers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
