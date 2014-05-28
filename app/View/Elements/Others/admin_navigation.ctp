<h3><?php echo __('Navigation Menu'); ?></h3>
<ul>
  <li><?php echo $this->Html->link(__('Dashboard'), '/admin'); ?></li>
  <li><?php echo $this->Html->link(__('Customers'), array('controller' => 'customers', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Sellers'), array('controller' => 'sellers', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Seller Affiliates'), array('controller' => 'sellers', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Buyers'), array('controller' => 'buyers', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Itineraries'), array('controller' => 'itineraries', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Trips'), array('controller' => 'trips', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Collectors'), array('controller' => 'collectors', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link(__('Areas'), array('controller' => 'areas', 'action' => 'index', 'admin' => true)); ?></li>
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