<?php if (!Application::isReadonly()) { ?>
<div class="nav-sub-panel" >
    <label><input type="checkbox" name="check-all" id="check-all" value="" style="margin: 0"> Check All/ Uncheck All</label>
    <a class="icon-remove" title="Delete" href="javascript:void(0)" id="delete-all" >Delete</a>
    <input type="hidden" name="db-hidden" id="db-hidden" value="<?php echo $this->db;?>" />
    <input type="hidden" name="collection-hidden" id="collection-hidden" value="<?php echo $this->collection;?>" />
</div> 
<?php }?>
<div class="well">
    <?php
    $showTab = true;
    foreach ($this->data['format'] as $format) {
        if (!isset($this->data['record'][$format]))
            continue;
        ?>
        <?php
        if ($showTab) {
            ?>    
            <ul class="nav nav-tabs">
                <li id="li-json"class="active"><a href="javascript:void(0)" data-list-record="json"><?php I18n::p('JSON'); ?></a></li>
                <li id="li-array"><a href="javascript:void(0)" data-list-record="array"><?php I18n::p('Array'); ?></a></li>
                <li id="li-document"><a href="javascript:void(0)" data-list-record="document"><?php I18n::p('MongoCursor'); ?></a></li>
            </ul>
            <?php
            $showTab = false;
        }
        ?>
        <div id="record-<?php echo $format; ?>" style="display: <?php echo $format === 'json' ? 'block' : 'none'; ?>">
            <?php
            $i = -1;
            foreach ($this->data['record'][$format] as $cursor) {
                ++$i;

                if (isset($this->data['record']['document'][0]['_id']) && !Application::isReadonly()) {
                    echo '&nbsp<input type="checkbox" name="ids[]" value="' . $this->data['record']['document'][$i]['_id'] . '" class="checkbox-remove" />';
                    echo '&nbsp<a href="javascript:void(0)"  onclick="callAjax(\'' . Theme::URL('Collection/EditRecord', array('db' => $this->db, 'collection' => $this->collection, 'id' => $this->data['record']['document'][$i]['_id'], 'format' => $format, 'id_type' => gettype($this->data['record']['document'][$i]['_id']))) . '\')" class="icon-edit" title="Edit">' . I18n::t('') . '</a>';
                    echo '&nbsp<a href="' . Theme::URL('Collection/DeleteRecord', array('db' => $this->db, 'collection' => $this->collection, 'id' => $this->data['record']['document'][$i]['_id'], 'id_type' => gettype($this->data['record']['document'][$i]['_id']))) . '" class="icon-remove" title="Delete">' . I18n::t('') . '</a>';
                }
                echo "<pre>";
                print_r($cursor);
                echo "</pre>";
            }
            ?>

            
        </div>
        <?php
    }
    ?>
    
</div>
   
<?php Theme::pagination($this->getModel()->totalRecord($this->db, $this->collection)); ?>