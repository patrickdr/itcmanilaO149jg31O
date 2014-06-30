<script type="text/javascript">
  var Customer =  {
    init : function(){
      Customer.customerSelect = $('select[name="customer_id"]');
    },
    onChange : function(){ console.log('heart');
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
    console.log('test');
    Customer.customerSelect.on('change', Customer.onChange);
    Seller.sellerSelect.on('change', Seller.onChange);
  //   $("input[name='data[ORDispatch][select_all]']").on('click', function(){
  //     $('input[name="data[ORDispatch][id][]"]').prop('checked', $(this).is(":checked"));
  //   });
  });
</script>

<div class="officialReceipts form">
<?php echo $this->Form->create('ORSearch', array('type' => 'get')); ?>
<?php //echo $this->error_msg; ?>
	<fieldset>
		<legend><?php echo __('Official Receipt Inventory'); ?></legend>
	<?php
    echo $this->Form->input('customer_id', array('empty' => '--- Customer ---', 'selected' => $customerId));
		echo $this->Form->input('seller_id', array('empty' => '--- Seller ---', 'selected' => $sellerId));
		echo $this->Form->input('date_received', array('type' => 'date'));
	?>
	</fieldset>
  <fieldset>
    <legend><?php echo __('Official Receipt Numbers'); ?></legend>
    <?php
      echo $this->Form->input('prefix', array('label' => 'Official Receipt Number Prefix'));
      echo $this->Form->input('from', array('label' => 'OR number from'));
      echo $this->Form->input('to', array('label' => 'OR number to'));
    ?>

  </fieldset>
<?php echo $this->Form->end(__('Generate and Download')); ?>
</div>
