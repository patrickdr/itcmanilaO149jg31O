 <?php
 echo $this->Form->create('User', array('type' => 'file'));
 echo $this->Form->input('file', array('type' => 'file'));
 echo $this->Form->submit();
 echo $this->Form->end();
 ?>