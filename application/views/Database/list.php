<?php defined('PMDDA') or die('Restricted access'); ?>
  
    <ul  class="nav nav-list collapse in">
        <?php
        
        foreach ($this->data['databases'] as $db) {
            ?>
        <li ><a href="<?php echo Theme::URL('Collection/Index', array('db' => $db['name'])); ?>"><?php echo $db['name']; ?></a></li>
        <?php } ?>


    </ul>
