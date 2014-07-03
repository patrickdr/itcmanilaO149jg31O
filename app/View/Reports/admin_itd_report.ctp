<script type="text/javascript">
  // var Customer =  {
  //   init : function(){
  //     Customer.customerSelect = $('select[name="customer_id"]');
  //   },
  //   onChange : function(){ console.log('heart');
  //     Customer.customerId = Customer.customerSelect.val();
  //     window.location.href = "?customer_id=" + Customer.customerId;
  //   }
  // };

  var CollectorNames =  {
    init : function(){
      CollectorNames.collectionNameSelect = $('select[name="collector_name"]');
    }
  };

  // var Seller =  {
  //   init : function(){
  //     Seller.sellerSelect = $('select[name="seller_id"]');
  //   },
  //   onChange : function(){
  //     Seller.sellerId = Seller.sellerSelect.val();
  //     var customerQuery = "";
  //     <?php if(isset($this->request->query['customer_id'])): ?>
  //       customerQuery = "<?php echo "?customer_id=".$this->request->query['customer_id']; ?>";
  //     <?php endif; ?>
  //     window.location.href = customerQuery + "&seller_id=" + Seller.sellerId;
  //   }
  // };
  $(document).ready(function(){
    // Customer.init();
    // Seller.init();
    // CollectionTypes.init();
    CollectorNames.init();
    // Customer.customerSelect.on('change', Customer.onChange);
    // Seller.sellerSelect.on('change', Seller.onChange);
  //   $("input[name='data[ORDispatch][select_all]']").on('click', function(){
  //     $('input[name="data[ORDispatch][id][]"]').prop('checked', $(this).is(":checked"));
  //   });
  });
</script>

<div class="Itinerary form">
<?php echo $this->Form->create('ITDReport', array('type' => 'get')); ?>

	<fieldset>
		<legend><?php echo __('ITD Report'); ?></legend>
    <?php if ($error_msg) { ?>
      <p class="error"><?php echo $error_msg; ?></p>
    <?php } ?>
    <?php if ($success_msg) { ?>
      <p class="success"><?php echo $success_msg; ?></p>
    <?php } ?>
	<?php
    echo $this->Form->input('date', array('type' => 'date', 'label' => 'Trip Date'));
    echo $this->Form->input('collector_id', array('empty' => '--- Collector Names ---',
                                                     'options' => $collector_names,
                                                     'selected' => (isset($this->request->query['collector_id'])) ? $this->request->query['collector_id'] : "",
                                                     'label' => 'Collector Name'));

    echo $this->Form->input('dispatch_number');

    // echo $this->Form->input('created', array('type' => 'date', 'label' => 'Date Created'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Generate and Download')); ?>
</div>
