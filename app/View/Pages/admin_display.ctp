<div class="dashboard index">
	<ul class="sections">
		<li><?= $this->Html->link('Customers', array('controller' => 'customers', 'action' => 'index', 'admin' => true)) ?></li>
		<li><?= $this->Html->link('Sellers', array('controller' => 'sellers', 'action' => 'index', 'admin' => true)) ?></li>
		<li><?= $this->Html->link('Seller Affiliates', array('controller' => 'sellers', 'action' => 'affiliates', 'admin' => true)) ?></li>
		<li><?= $this->Html->link('Buyers', array('controller' => 'buyers', 'action' => 'index', 'admin' => true)) ?></li>
		<li><?= $this->Html->link('Itineraries', array('controller' => 'itineraries', 'action' => 'index', 'admin' => true)) ?></li>
		<li><?= $this->Html->link('Trips', array('controller' => 'trips', 'action' => 'index', 'admin' => true)) ?></li>
		<li><?= $this->Html->link('Areas', array('controller' => 'areas', 'action' => 'index', 'admin' => true)) ?></li>
    <li><?= $this->Html->link('Collectors', array('controller' => 'collectors', 'action' => 'index', 'admin' => true)) ?></li>
    <li><?= $this->Html->link('Reports', array('controller' => 'reports', 'action' => 'index', 'admin' => true)) ?></li>
    <li><?= $this->Html->link('Collections', array('controller' => 'collections', 'action' => 'index', 'admin' => true)) ?></li>
	</ul>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout', 'admin' => true)); ?></li>
	</ul>
  <?= $this->element('others/admin_navigation') ?>
</div>