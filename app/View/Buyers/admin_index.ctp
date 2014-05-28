<script type="text/javascript">
  var Search = {
    init : function(){
      Search.Form = $('#SearchAdminIndexForm');
    }
  };
  var Customer =  {
    init : function(){
      Customer.customerSelect = $('select[name="customer_id"]');
    },
    onChange : function(){
      Customer.customerId = Customer.customerSelect.val();
      Search.Form.submit();
      //window.location.href = "?customer_id=" + Customer.customerId;
    }
  };
  var Seller =  {
    init : function(){
      Seller.sellerSelect = $('select[name="seller_id"]');
    },
    onChange : function(){
      Seller.sellerId = Seller.sellerSelect.val();
      Search.Form.submit();
      //window.location.href = "&seller_id=" + Seller.sellerId;
    }
  };  
  $(document).ready(function(){
    Search.init();
    Customer.init();
    Seller.init();
    Customer.customerSelect.on('change', Customer.onChange);
    Seller.sellerSelect.on('change', Seller.onChange);
  });
</script>
<div class="buyers index">
  <h2><?php echo __('Search Buyers'); ?></h2>
  <?php echo $this->Form->create('Search', array('type' => 'get')); ?>
  <table cellpadding="0" cellspacing="0">
    <td><?= $this->Form->input('customer_id', array('empty' => '---Select---', 'selected' => isset($this->request->query['customer_id']) ? $this->request->query['customer_id'] : "")) ?></td>
    <td><?= $this->Form->input('seller_id', array('empty' => '---Select---', 'selected' => isset($this->request->query['seller_id']) ? $this->request->query['seller_id'] : ""))  ?></td>
    <td><?= $this->Form->input('name', array('label' => 'BuyerName', 'value' => isset($this->request->query['name']) ? $this->request->query['name'] : ""))  ?></td>
    <td><?= $this->Form->submit('Search')  ?></td>
  </table>
  <?php echo $this->Form->end(); ?>
	<h2><?php echo __('Buyers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
    <th><?php echo $this->Paginator->sort('customer_id', 'CustomerName'); ?></th>
    <th><?php echo $this->Paginator->sort('seller_id', 'SellerName'); ?></th>
    <th><?php echo $this->Paginator->sort('SellerAffiliate.seller_id', 'SellerAffiliate'); ?></th>
    <th><?php echo $this->Paginator->sort('area_id'); ?></th>
    <th><?php echo $this->Paginator->sort('code', 'BuyerCode'); ?></th>
    <th><?php echo $this->Paginator->sort('customer_buyer_code', 'CustomerBuyerCode'); ?></th>
    <th><?php echo $this->Paginator->sort('name'); ?></th>
    <th><?php echo $this->Paginator->sort('contact_person'); ?></th>
    <th><?php echo $this->Paginator->sort('contact_number'); ?></th>
    <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($buyers as $buyer): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($buyer['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $buyer['Customer']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($buyer['Seller']['name'], array('controller' => 'sellers', 'action' => 'view', $buyer['Seller']['id'])); ?>
		</td> 
    <td>
			<?php
        if($buyer['SellerAffiliate']['name']){
          echo $this->Html->link($buyer['SellerAffiliate']['name'], array('controller' => 'sellers', 'action' => 'view', $buyer['SellerAffiliate']['id'])); 
        }
       ?>
		</td>     
		<td>
			<?php echo h($buyer['Area']['code']); ?>
		</td>
		<td><?php echo h($buyer['Buyer']['code']); ?>&nbsp;</td>
    <td><?php echo h($buyer['Buyer']['customer_buyer_code']); ?>&nbsp;</td>
		<td><?php echo h($buyer['Buyer']['name']); ?>&nbsp;</td>
		<td><?php echo h($buyer['Buyer']['contact_person']); ?>&nbsp;</td>
		<td><?php echo h($buyer['Buyer']['contact_number']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $buyer['Buyer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $buyer['Buyer']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $buyer['Buyer']['id']), null, __('Are you sure you want to delete # %s?', $buyer['Buyer']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
  <?= $this->Element('Others/admin_navigation') ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Buyer'), array('action' => 'add')); ?></li>
    <li><?php echo $this->Html->link(__('Upload Buyers'), array('action' => 'upload')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Areas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Itineraries'), array('controller' => 'itineraries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itinerary'), array('controller' => 'itineraries', 'action' => 'add')); ?> </li>
	</ul>
</div>
