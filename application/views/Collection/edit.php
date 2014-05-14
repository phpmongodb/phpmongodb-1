<?php require_once '_menu.php'; ?>
<div class="well" id="container-insert" >
    <ul class="nav nav-tabs">
        <li class="<?php echo $this->data['format'] === 'array'?'active':''; ?>">
            <a href="#Array" data-toggle="tab"><?php I18n::p('Array');?></a>
        </li>
        <li class="<?php echo $this->data['format'] === 'json'?'active':''; ?>">
            <a href="#JSON" data-toggle="tab"><?php I18n::p('JSON');?></a>
        </li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane <?php echo $this->data['format'] === 'array' ? 'active in' : 'fade'; ?>" id="Array">
            <form id="tab2" method="post" action="index.php">
                _id : <input type="text" name="id" id="id_edit" value="<?php echo "\n" . $this->data['id']; ?>" readonly="" class="input-xlarge" />
                <textarea name="data" rows="16" class="input-xlarge" style="width:950px;">
<?php echo "\n" . $this->data['record']['array']; ?>
                </textarea>
                <div>
                    <button class="btn btn-primary"><?php I18n::p('SAVE');?></button>
                </div>
                <input type="hidden" name="id_type" value="<?php echo $this->request->getParam('id_type'); ?>" />
                <input type="hidden"  name="load" value="Collection/EditRecord"/>
                <input type="hidden" name="format" value="array" />
                <input type="hidden" name="db" value="<?php echo $this->db; ?>" />
                <input type="hidden" name="collection" value="<?php echo $this->collection; ?>" />
            </form>
        </div>
        <div class="tab-pane <?php echo $this->data['format'] === 'json' ? 'active in' : 'fade'; ?>" id="JSON">
            <form id="tab3" method="post" action="index.php">
                _id : <input type="text" name="id" id="id_edit" value="<?php echo "\n" . $this->data['id']; ?>" readonly="" class="input-xlarge" />

                <textarea name="data" rows="16" class="input-xlarge" style="width:950px;">
<?php echo "\n" . $this->data['record']['json']; ?>
                </textarea>
                <div>
                    <button class="btn btn-primary"><?php I18n::p('SAVE');?></button>
                </div>
                <input type="hidden" name="id_type" value="<?php echo $this->request->getParam('id_type'); ?>" />
                <input type="hidden"  name="load" value="Collection/EditRecord"/>
                <input type="hidden" name="format" value="json" />
                <input type="hidden" name="db" value="<?php echo $this->db; ?>" />
                <input type="hidden" name="collection" value="<?php echo $this->collection; ?>" />
            </form>
        </div>
    </div>

</div>