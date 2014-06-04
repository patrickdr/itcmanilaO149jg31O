<script>
  var Itinerary = {
    init : function(){
      Itinerary.baseArea = $('.base');
      Itinerary.addButton = $('.addAreaButton');
      Itinerary.areaWrapper = $('.fieldset-areas');
      Itinerary.addArea();
      Itinerary.addButton.on('click', Itinerary.onAddArea);
      Itinerary.areaForm = $('.AreaSearch');
      Itinerary.areaSelects = $('.areaCodes');
      Itinerary.areaSelects.on('change', Itinerary.onSearch);
      Itinerary.tripForm = $('.AddTrip');     
    },
    search : function(){
      $.ajax({
          url : "/admin/trips/search_area",
          type: 'post',
          data: Itinerary.areaForm.data,
          dataType: 'html',
          success: function(response) {
            $('.search-result').html(response);
          }
      });        
    },
    onSearch : function(){
      Itinerary.areaForm.data = Itinerary.areaForm.serializeArray();
      Itinerary.search();
    },
    addArea : function(){
      var cloned = Itinerary.baseArea.clone();
      console.log(cloned);
      cloned.insertBefore(Itinerary.addButton);
      cloned.show();
      Itinerary.areaSelects = $('.areaCodes');
      Itinerary.areaSelects.on('change', Itinerary.onSearch);
    },
    onAddArea : function(event) {
      event.preventDefault();
      Itinerary.addArea();
    }
  };
  $(document).ready(function(){
    Itinerary.init();
  });
</script>
<?= 
  $this->Form->input('area_id', array(
    'id' => false, 
    'div' => array('class' => 'base'), 
    'label' => false,
    'name' => 'area_id[]',
    'class' => 'areaCodes',
    'empty' => '--- Select Area ---'
    )
  ) 
?>
<div class="trips form">
  <?= $this->Form->create(null, array('type' => 'get', 'class' => 'AreaSearch', 'url' => '/admin/trips/add')) ?>
    <fieldset class="fieldset-areas">
      <legend><?php echo __('Select Area'); ?></legend>
    <?php
      if(isset($this->request->query['area_id'])){
        foreach($this->request->query['area_id'] as $areaId){
          echo $this->Form->input('area_id', array(
            'id' => false, 
            'div' => array('class' => 'base'), 
            'label' => false,
            'name' => 'area_id[]',
            'class' => 'areaCodes',
            'selected' => $areaId,
            'empty' => '--- Select Area ---'
            )
          );           
        }
      }
      echo $this->Html->link('Add another area', '#', array('class' => 'addAreaButton'));
    ?>
    </fieldset>    
  <?= $this->Form->end() ?>
  <?php echo $this->Form->create('Trip', array('class' => 'AddTrip')); ?>
    <fieldset>
      <legend><?php echo __('Admin Add Trip'); ?></legend>
    <?php
      echo $this->Form->input('id');
      echo $this->Form->input('collector_id');
      echo $this->Form->input('trip_type');
    ?>
    </fieldset>
    <h3><?php echo __('Assigned Trips'); ?></h3>
    <div class="current">
      <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Select'); ?></th>
            <th><?php echo __('Buyer name'); ?></th>
            <th><?php echo __('Trip Type'); ?></th>
            <th><?php echo __('Trip no.'); ?></th>
            <th><?php echo __('IT number'); ?></th>
            <th><?php echo __('Remarks'); ?></th>
            <th><?php echo __('Date Received'); ?></th>
            <th><?php echo __('Contact no.'); ?></th>
            <th><?php echo __('Contact person'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($trips as $itinerary): ?>
          <?php if(isset($itinerary['Buyer']['id'])): ?>
          <tr>
            <td><?php echo $this->Form->checkbox('itinerary_id', array( 'class' => 'contest-select', 'value' => $itinerary['Itinerary']['id'], 'name' => "data[Itinerary][select][]", 'checked' => 'checked' ));?></td>
            <td>
              <?php echo $this->Html->link(
                String::truncate($itinerary['Buyer']['name'], 15, array('ellipsis' => '...')), 
                array(
                  'controller' => 'buyers', 
                  'action' => 'view', 
                  $itinerary['Buyer']['id']
                ),
                array(
                  'title' => $itinerary['Buyer']['name']
                )
              ); ?>
            </td>
            <td>
              <?php echo h($itinerary['Itinerary']['trip_type']); ?>
            </td>
            <td><?php echo h($itinerary['Itinerary']['trip_number']); ?>&nbsp;</td>
            <td><?php echo h($itinerary['Itinerary']['itinerary_number']); ?>&nbsp;</td>
            <td><?php echo h(String::truncate($itinerary['Itinerary']['remarks'], 20, array('ellipsis' => '...'))); ?>&nbsp;</td>
            <td><?php echo h($itinerary['Itinerary']['date_received']); ?>&nbsp;</td>
            <td><?php echo h(String::truncate($itinerary['Itinerary']['contact_number'], 15, array('ellipsis' => '...'))); ?>&nbsp;</td>
            <td><?php echo h($itinerary['Itinerary']['contact_person']); ?>&nbsp;</td>
            <td class="actions">
              <?php echo $this->Html->link(__('View'), array('action' => 'view', 'controller' => 'itineraries', $itinerary['Itinerary']['id'])); ?>
            </td>
          </tr>
          <?php endif; ?>
        <?php endforeach; ?>        
      </table>
    </div>
    <h3><?php echo __('Unassigned Trips'); ?></h3>
    <div class="search-result">
      <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Select'); ?></th>
            <th><?php echo __('Buyer name'); ?></th>
            <th><?php echo __('Trip Type'); ?></th>
            <th><?php echo __('Trip no.'); ?></th>
            <th><?php echo __('IT number'); ?></th>
            <th><?php echo __('Remarks'); ?></th>
            <th><?php echo __('Date Received'); ?></th>
            <th><?php echo __('Contact no.'); ?></th>
            <th><?php echo __('Contact person'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
      </table>
    </div>
  <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
  <?= $this->Element('Others/admin_navigation') ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Trips'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Collectors'), array('controller' => 'collectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collector'), array('controller' => 'collectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Itineraries'), array('controller' => 'itineraries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itinerary'), array('controller' => 'itineraries', 'action' => 'add')); ?> </li>
	</ul>
</div>
