<script type="text/javascript">
  var Customer =  {
    init : function(){
      Customer.customerSelect = $('select[name="data[Itinerary][customer_id]"]');
    },
    onChange : function(){
      Customer.customerId = Customer.customerSelect.val();
      window.location.href = "?customer_id=" + Customer.customerId;
    }
  };
  var Seller =  {
    init : function(){
      Seller.sellerSelect = $('select[name="data[Itinerary][seller_id]"]');
    },
    onChange : function(){
      Seller.sellerId = Seller.sellerSelect.val();
      var customerQuery = "";
      <?php if(isset($this->request->query['customer_id'])): ?>
        customerQuery = "<?php echo "?customer_id=".$this->request->query['customer_id']; ?>";
      <?php endif; ?>     
      window.location.href = customerQuery + "&seller_id=" + Seller.sellerId;
    }
  };    
  $(document).ready(function(){
    Customer.init();
    Seller.init();
    Customer.customerSelect.on('change', Customer.onChange);
    Seller.sellerSelect.on('change', Seller.onChange);
  });
</script>
<div class="buyers form">
<?php echo $this->Form->create('Itinerary', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Upload Itinerary'); ?></legend>
	<?php 
    echo $this->Form->input('customer_id', array('options' => $customers, 'label' => 'Customer', 'empty' => '---Select one---', 'selected' => $customerId ));
    echo $this->Form->input('seller_id', array('options' => $sellers, 'label' => 'Seller', 'empty' => '---Select one ---', 'selected' => isset($this->request->query['seller_id']) ? $this->request->query['seller_id'] : 0));
    echo $this->Form->input('seller_affiliate', array('empty' => '---Seller Affiliate---', 'options' => $sellerAffiliates));
    echo $this->Form->input('itinerary_number');
    echo $this->Form->input('date_received', array('type' => 'date'));
    echo $this->Form->input('file', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
  <?= $this->Element('Others/admin_navigation') ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Itineraries'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Areas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('controller' => 'areas', 'action' => 'add')); ?> </li>

		<li><?php echo $this->Html->link(__('New Itinerary'), array('controller' => 'itineraries', 'action' => 'add')); ?> </li>
	</ul>
</div>
