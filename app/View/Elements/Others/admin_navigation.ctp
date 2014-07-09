<h3><?php echo __('Navigation Menu'); ?></h3>
<ul>
  <li><?php echo $this->Html->link(__('Dashboard'), '/admin'); ?></li>
  <li><?php echo $this->Html->link(__('Customers'), array('controller' => 'customers', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Sellers'), array('controller' => 'sellers', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Seller Affiliates'), array('controller' => 'sellers', 'action' => 'affiliates', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Buyers'), array('controller' => 'buyers', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Unassigned ITs'), array('controller' => 'itineraries', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Assigned ITs'), array('controller' => 'itineraries', 'action' => 'assigned', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Trips'), array('controller' => 'trips', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Collectors'), array('controller' => 'collectors', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Areas'), array('controller' => 'areas', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Official Receipts'), array('controller' => 'official_receipts', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Collections'), array('controller' => 'collections', 'action' => 'index', 'admin' => true)); ?></li>
<?php
  // Add any additional links
  if (isset($additionalLinks)) :
    $additionalLinks = (array) $additionalLinks;
    foreach ($additionalLinks as $linkParams) :
?>
  <li><?php echo call_user_func_array(array($this->Html, 'link'), $linkParams); ?></li>
<?php
    endforeach;
  endif;
?>
</ul>
<h3><?php echo __('Reports'); ?></h3>
<ul>
  <li><?php echo $this->Html->link(__('Excel to PPM'), array('controller' => 'reports', 'action' => 'xls_ppm', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Generate PPM'), array('controller' => 'collections', 'action' => 'ppm', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Or Inventory'), array('action' => 'or_inventory')); ?></li>
  <li><?php echo $this->Html->link(__('Collection Report'), array('action' => 'collection_report')); ?> </li>
  <li><?php echo $this->Html->link(__('ITD Report'), array('action' => 'itd_report')); ?> </li>
  <li><?php echo $this->Html->link(__('Check Transmittal'), array('action' => 'check_transmittal')); ?> </li>

</ul>
