<?php require_once '_menu.php'; ?>
<div class="well" id="container-indexes">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#IndexesList" data-toggle="tab"><?php I18n::p('LIST');?></a></li>
        <?php if(!Application::isReadonly()){?>
        <li ><a href="#IndexesCreate" data-toggle="tab"><?php I18n::p('CREATE');?></a></li>
        <?php }?>
    </ul>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active in" id="IndexesList">
            <table class="table">
                <thead>
                    <tr>
                        <th>v</th>
                        <th>key</th>
                        <th>name</th>
                        <th>unique</th>
                        <th>ns</th>
                        <th>background</th>
<!--                        <th><?php //I18n::p('ACTION');?></th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->data['indexes'] as $index) { ?>
                        <tr>
                            <td><?php echo $index['v']; ?></td>
                            <td><?php echo $this->data['cryptography']->highlight($this->data['cryptography']->arrayToJSON($index['key'])); ?></td>
                            <td><?php echo $index['name']; ?></td>
                            <td><?php echo (isset($index['unique']) ? ($index['unique'] ? 'true' : 'false') : ''); ?></td>
                            <td><?php echo $index['ns']; ?></td>
                            <td><?php echo isset($index['background']) ? (is_double($index['background']) ? 'NumberLong(' . $index['background'] . ')' : $index['background']) : ''; ?>
                            <?php if(!Application::isReadonly()){?>
                            <td><?php echo $index['name'] !== '_id_' ? '<a href="' . Theme::URL('Collection/DeleteIndexes', array('db' => $this->db, 'collection' => $this->collection, 'name' => $index['name'])) . '">Delete</a>' : ''; ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>     
        <?php 
        if(!Application::isReadonly())
            require_once '_create_index.php'; 
    ?>

    </div>
</div>
 

