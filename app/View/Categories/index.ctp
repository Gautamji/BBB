<h1>Categories</h1>
<?php
foreach($categories as $category){
    echo '<div>';
    echo $this->Html->link( $category['Category']['title'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id']));
    echo '</div>';
}
unset($category);

?>