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

  var CollectionTypes =  {
    init : function(){
      CollectionTypes.collectionTypeSelect = $('select[name="collection_type"]');
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
    CollectionTypes.init();
    Customer.customerSelect.on('change', Customer.onChange);
    Seller.sellerSelect.on('change', Seller.onChange);
  //   $("input[name='data[ORDispatch][select_all]']").on('click', function(){
  //     $('input[name="data[ORDispatch][id][]"]').prop('checked', $(this).is(":checked"));
  //   });
  });
</script>

<div class="Collections form">
<?php echo $this->Form->create('CollectionSearch', array('type' => 'get')); ?>

	<fieldset>
		<legend><?php echo __('Collection Report'); ?></legend>
    <?php if ($error_msg) { ?>
      <p class="error"><?php echo $error_msg; ?></p>
    <?php } ?>
	<?php
    echo $this->Form->input('customer_id', array('empty' => '--- Customer ---', 'selected' => $customer_id));
		echo $this->Form->input('seller_id', array('empty' => '--- Seller ---', 'selected' => $seller_id));

    echo $this->Form->input('seller_affiliate_id', array('empty' => '--- Seller Affiliates---',
                                                         'options' => $seller_affiliates,
                                                         'selected' => (isset($this->request->query['seller_affiliate_id'])) ? $this->request->query['seller_affiliate_id'] : ""));
    echo $this->Form->input('deposit_channel_id', array('empty' => '--- Deposit Channels ---',
                                                         'options' => $deposit_channels,
                                                         'selected' => (isset($this->request->query['deposit_channel_id'])) ? $this->request->query['deposit_channel_id'] : ""));
		echo $this->Form->input('deposit_date', array('type' => 'date'));
    echo $this->Form->input('collection_date', array('type' => 'date'));

    // echo $this->Form->input('created', array('type' => 'date', 'label' => 'Date Created'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Generate and Download')); ?>
</div>
<div class="actions">
  <?= $this->Element('Others/admin_navigation') ?>
</div>
