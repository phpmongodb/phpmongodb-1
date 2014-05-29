<?php defined('PMDDA') or die('Restricted access'); ?>
<div class="sidebar-nav">

    <?php
    $dbList = Widget::get('DBList');
    if (is_array($dbList['databases'])) {
    $chttp=new Chttp();
    $dbName = $chttp->getParam('db');
    if (empty($dbName)) {
        ?>
        
        <ul  class="nav nav-list collapse in bodymargin">
            <?php
            foreach ($dbList['databases'] as $db) {
                ?>
                <a href="<?php echo Theme::URL('Collection/Index', array('db' => $db['name'])); ?>" class="nav-header" >
                    <i class="icon-database"></i><?php echo $db['name']; ?><span class="label label-info"><?php echo !empty($db['noOfCollecton'])?$db['noOfCollecton']:'';?></span></a>
            <?php } ?>


        </ul>
        <?php
    } else {
        foreach ($dbList['databases'] as $db) {

            if ($dbName == $db['name']) {
                $collectionList = Widget::get('CollectonList');
                
                ?>
                <a href="#accounts-menu" class="nav-header" data-toggle="collapse">
                    <i class="icon-database"></i><?php echo $db['name']; ?><span class="label label-info"><?php echo $db['noOfCollecton'];?></span></a>
                <?php 
                if ($collectionList) { 
                    
                    ?>
                    <ul id="accounts-menu" class="nav nav-list collapse in">
                        <?php foreach ($collectionList as $collection) {?>
                        <li ><a href="<?php echo Theme::URL('Collection/Record', array('db' => $db['name'], 'collection' => $collection['name'])); ?>"><i class="icon-collection"></i><?php echo $collection['name'],' ('.$collection['count'],')'; ?></a></li>
                        <?php } ?>
                    </ul>
                    <?php
                    
                }
            } else {
                ?>
                <a href="<?php echo Theme::URL('Collection/Index', array('db' => $db['name'])); ?>" class="nav-header" >
                    <i class="icon-database"></i><?php echo $db['name']; ?><span class="label label-info"><?php echo $db['noOfCollecton'];?></span></a>
                        <?php
                    }
                }
            }
    }
            ?>
</div>
