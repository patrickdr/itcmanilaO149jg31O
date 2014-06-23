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
    $("input[name='data[ORDispatch][select_all]']").on('click', function(){
      $('input[name="data[ORDispatch][id][]"]').prop('checked', $(this).is(":checked"));
    });    
  });
</script>
<div class="officialReceipts form">
<?php echo $this->Form->create('ORSearch', array('type' => 'get')); ?>
	<fieldset>
		<legend><?php echo __('Search Official Receipt'); ?></legend>
	<?php
    echo $this->Form->input('customer_id', array('empty' => '--- Customer ---', 'selected' => $customerId));	
		echo $this->Form->input('seller_id', array('empty' => '--- Seller ---', 'selected' => $sellerId));
    echo $this->Form->input('seller_affiliate_id', array('empty' => '--- Seller Affiliates---', 'options' => $sellerAffiliates, 'selected' => (isset($this->request->query['seller_affiliate_id'])) ? $this->request->query['seller_affiliate_id'] : ""));
    echo $this->Form->input('collector_id', array('label' => false));
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
<?php echo $this->Form->end(__('Search')); ?>
<?php echo $this->Form->create('ORDispatch'); ?>
  
  <h3><?php echo __('Select OR to Return'); ?></h3>
  <div class="current">
    <table cellpadding="0" cellspacing="0">
      <tr>
        <th><?= $this->Form->checkbox('select_all') ?><?php echo __('Select All'); ?></th>
        <th><?php echo __('Seller'); ?></th>
        <th><?php echo __('Seller Affiliate'); ?></th>
        <th><?php echo __('Customer'); ?></th>
        <th><?php echo __('OR Number'); ?></th>
        <th><?php echo __('Date Received'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
      </tr>
      <?php foreach($ORs as $officialReceipt): ?>
        <tr>
          <td>
            <?= $this->Form->checkbox('or_id', array('value' => $officialReceipt['OfficialReceipt']['id'], 'name' => 'data[ORDispatch][id][]')); ?>
          </td>
          <td>
            <?php echo $this->Html->link($officialReceipt['Seller']['name'], array('controller' => 'sellers', 'action' => 'view', $officialReceipt['Seller']['id'])); ?>
          </td>
          <td>
            <?php echo $this->Html->link($officialReceipt['SellerAffiliate']['name'], array('controller' => 'sellers', 'action' => 'view', $officialReceipt['SellerAffiliate']['id'])); ?>
          </td>    
          <td>
            <?php echo $this->Html->link($officialReceipt['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $officialReceipt['Customer']['id'])); ?>
          </td>
          <td><?php echo h($officialReceipt['OfficialReceipt']['or_number']); ?>&nbsp;</td>
          <td><?php echo h($officialReceipt['OfficialReceipt']['date_received']); ?>&nbsp;</td>
          <td class="actions">
            <?php echo $this->Html->link(__('View'), array('action' => 'view', $officialReceipt['OfficialReceipt']['id'])); ?>
            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $officialReceipt['OfficialReceipt']['id'])); ?>
            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $officialReceipt['OfficialReceipt']['id']), null, __('Are you sure you want to delete # %s?', $officialReceipt['OfficialReceipt']['id'])); ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>  
<?php echo $this->Form->end(__('Return')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Official Receipts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Collectors'), array('controller' => 'collectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Receive OR'), array('action' => 'add')); ?></li>
    <li><?php echo $this->Html->link(__('Dispatch OR'), array('action' => 'dispatch')); ?></li>
    <li><?php echo $this->Html->link(__('Return OR'), array('action' => 'dispatch')); ?></li>
    <li><?php echo $this->Html->link(__('OR Balance'), array('action' => 'dispatch')); ?></li>
    <li><?php echo $this->Html->link(__('Remit OR'), array('action' => 'dispatch')); ?></li></li>    
		<li><?php echo $this->Html->link(__('New Collector'), array('controller' => 'collectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sellers'), array('controller' => 'sellers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seller'), array('controller' => 'sellers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
