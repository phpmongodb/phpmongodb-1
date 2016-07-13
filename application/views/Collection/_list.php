 <?php if (!Application::isReadonly() && !empty($this->data['total'])) { ?>
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
                    $idType=gettype($this->data['record']['document'][$i]['_id']);
                    $pkv=$this->data['record']['document'][$i]['_id'];
                    if($idType=='object'){
                        $idType=  get_class($this->data['record']['document'][$i]['_id']);
                        if($idType=='MongoDate'){                            
                            $pkv=$pkv->sec.','.$pkv->usec;
                        }
                    }
                    echo '&nbsp<input type="checkbox" name="ids[]" value="' . $pkv.'-'.$idType. '" class="checkbox-remove" />';
                    echo '&nbsp<a href="javascript:void(0)"  onclick="callAjax(\'' . Theme::URL('Collection/EditRecord', array('db' => $this->db, 'collection' => $this->collection, 'id' => $pkv, 'format' => $format, 'id_type' =>$idType)) . '\')" class="icon-edit" title="Edit">' . I18n::t('') . '</a>';
                    echo '&nbsp<a href="' . Theme::URL('Collection/DeleteRecord', array('db' => $this->db, 'collection' => $this->collection, 'id' =>$pkv, 'id_type' =>$idType )) . '" class="icon-remove" title="Delete">' . I18n::t('') . '</a>';
                }
                echo "<pre>";
                if($format=='document'){
                    echo htmlentities(print_r($cursor,TRUE), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                }else{
                    print_r($cursor);
                }
                echo "</pre>";
            }
            ?>

            
        </div>
        <?php
    }
    if(empty($this->data['total'])){
        echo I18n::p('N_R_F');
    }
    ?>
    
</div>

<?php Theme::pagination($this->data['total']); ?>