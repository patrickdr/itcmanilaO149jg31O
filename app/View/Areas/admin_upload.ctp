<div class="areas form">
<?php echo $this->Form->create('Area', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Admin Multiple Areas'); ?></legend>
	<?php
    
     echo $this->Form->input('file', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
  <?= $this->Element('Others/admin_navigation') ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Areas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buyers'), array('controller' => 'buyers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Buyer'), array('controller' => 'buyers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sellers'), array('controller' => 'sellers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seller'), array('controller' => 'sellers', 'action' => 'add')); ?> </li>
	</ul>
</div>
