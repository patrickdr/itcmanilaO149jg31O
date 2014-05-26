<script type="text/javascript">
  var Customer =  {
    init : function(){
      Customer.customerSelect = $('select[name="data[Buyer][customer_id]"]');
    },
    onChange : function(){
      Customer.customerId = Customer.customerSelect.val();
      window.location.href = "?customer_id=" + Customer.customerId;
    }
  };
  $(document).ready(function(){
    Customer.init();
    Customer.customerSelect.on('change', Customer.onChange);
  });
</script>
<div class="buyers form">
<?php echo $this->Form->create('Buyer'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Buyer'); ?></legend>
	<?php
		echo $this->Form->input('customer_id', array('empty' => '---Buyer---', 'selected' => isset($this->request->query['customer_id']) ? $this->request->query['customer_id'] : 0 ));
    echo $this->Form->input('seller_id', array('empty' => '---Seller---'));
		echo $this->Form->input('area_id');
		echo $this->Form->input('code');
		echo $this->Form->input('name');
		echo $this->Form->input('contact_person');
		echo $this->Form->input('contact_number');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
  <?= $this->Element('Others/admin_navigation') ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Buyers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Areas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Itineraries'), array('controller' => 'itineraries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itinerary'), array('controller' => 'itineraries', 'action' => 'add')); ?> </li>
	</ul>
  
</div>
