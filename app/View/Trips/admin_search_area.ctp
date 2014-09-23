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
  <?php foreach ($itineraries as $itinerary): ?>
    <?php if(isset($itinerary['Buyer']['id'])): ?>
    <tr>
      <td><?php echo $this->Form->checkbox('itinerary_id', array( 'class' => 'contest-select', 'value' => $itinerary['Itinerary']['id'], 'name' => "data[Itinerary][select][]" ));?></td>
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