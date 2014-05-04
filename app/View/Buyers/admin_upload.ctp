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
<?php echo $this->Form->create('Buyer', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Buyer'); ?></legend>
	<?php
    echo $this->Form->input('customer_id', array('options' => $customers, 'label' => 'Customer', 'empty' => '---Select one---', 'selected' => $customerId ));
    echo $this->Form->input('seller_id', array('options' => $sellers, 'label' => 'Seller', 'empty' => '---Select one ---'));
    echo $this->Form->input('file', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
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
