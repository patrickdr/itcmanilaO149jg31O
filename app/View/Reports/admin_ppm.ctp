<script type="text/javascript">
  var Customer =  {
    init : function(){
      Customer.customerSelect = $('select[name="customer_id"]');
    },
    onChange : function(){
      Customer.customerId = Customer.customerSelect.val();
      window.location.href = "?customer_id=" + Customer.customerId;
    }
  };
  var Seller =  {
    init : function(){
      Seller.sellerSelect = $('select[name="seller_id"]');
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
  <?php echo $this->Form->create('Collection', array('type' => 'get')); ?>
  <fieldset>
    <legend><?php echo __('Generate PPM txt'); ?></legend>  
    <?= $this->Form->input('customer_id') ?>
    <?= $this->Form->input('seller_id') ?>
    <?= $this->Form->input('seller_affiliate') ?>
    <?= $this->Form->input('check_type') ?>
    <?= $this->Form->input('deposit_channel') ?>
  </fieldset>
  <?php echo $this->Form->end('Generate') ?>
</div>
<div class="actions">
  <?= $this->Element('Others/admin_navigation') ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

	</ul>
</div>
