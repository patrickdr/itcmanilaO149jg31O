<script type="text/javascript">
  var Customer =  {
    init : function(){
      Customer.customerSelect = $('select[name="data[Collection][customer_id]"]');
    },
    onChange : function(){
      Customer.customerId = Customer.customerSelect.val();
      window.location.href = "?customer_id=" + Customer.customerId;
    }
  };
  var Seller =  {
    init : function(){
      Seller.sellerSelect = $('select[name="data[Collection][seller_id]"]');
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
<div class="ppm form">
  <?php echo $this->Form->create('Collection', array('type' => 'post')); ?>
  <fieldset>
    <legend><?php echo __('Generate PPM txt'); ?></legend>  
    <?= $this->Form->input('customer_id', array('empty' => '-- Customer --', 'selected' => (isset($this->request->query['customer_id'])) ? $this->request->query['customer_id'] : "" )) ?>
    <?= $this->Form->input('seller_id', array('empty' => '-- Seller --', 'selected' => (isset($this->request->query['seller_id'])) ? $this->request->query['seller_id'] : "")) ?>
    <?= $this->Form->input('seller_affiliate', array('empty' => '-- Seller Affiliate--', 'selected' => (isset($this->request->query['seller_affiliate'])) ? $this->request->query['seller_affiliate'] : "")) ?>
    <?= $this->Form->input('check_type', array('empty' => '-- Check Type --', 'selected' => (isset($this->request->query['check_type'])) ? $this->request->query['check_type'] : "")) ?>
    <?= $this->Form->input('deposit_channel', array('empty' => '-- Deposit Channel --', 'selected' => (isset($this->request->query['deposit_channel'])) ? $this->request->query['deposit_channel'] : "")) ?>
  </fieldset>
  <?php echo $this->Form->end('Generate') ?>
</div>
<div class="actions">
  <?= $this->Element('Others/admin_navigation') ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
    <li><?php echo $this->Html->link(__('List Collection'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Official Receipts'), array('controller' => 'official_receipts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Official Receipt'), array('controller' => 'official_receipts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Collectors'), array('controller' => 'collectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collector'), array('controller' => 'collectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
