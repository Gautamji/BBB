<h1>Create Category</h1>
<?php
echo $this->Form->create('Category');
// echo $this->Form->input('user_id');
echo $this->Form->input('title');
echo $this->Form->end('Save');

?>
