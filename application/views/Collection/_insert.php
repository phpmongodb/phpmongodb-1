<div class="well" id="container-insert" style="<?php echo isset($this->data['isAjax'])?'display:block':'display:none';?>">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#keyValue" data-toggle="tab"><?php I18n::p('F_V');?></a></li>
        <li ><a href="#Array" data-toggle="tab"><?php I18n::p('Array');?></a></li>
        <li><a href="#JSON" data-toggle="tab"><?php I18n::p('JSON');?></a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active in" id="keyValue">
            <form id="tab1" method="post" action="index.php">
                <table id="tbl-fiedl-value">
                    <tr>
                        <th><?php I18n::p('ATTRIBUTE');?></th>
                        <th><?php I18n::p('VALUE');?></th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <td><input type="text" class="input-xlarge" name="fields[]" required="required" placeholder="Enter Key"></td>
                        <td><textarea  rows="2" class="input-xlarge" name="values[]" required="required" placeholder="Enter Value"></textarea></td>
                        <td>
                            <a href="javascript:void(0)" class="icon-plus" title="<?php I18n::p('ADD');?>"  onclick="PMDI.appendTR('insert')">&nbsp;</a>
                        </td>
                    </tr>
                   
                </table>
                <div>
                    
                    <button class="btn btn-primary"><?php I18n::p('SAVE');?></button>
                </div>
                <input type="hidden"  name="load" value="Collection/SaveRecord"/>
                <input type="hidden" name="type" value="FieldValue" />
                <input type="hidden" name="db" value="<?php echo $this->db; ?>" />
                <input type="hidden" name="collection" value="<?php echo $this->collection; ?>" />
            </form>
        </div>
        <div class="tab-pane fade" id="Array">
            <form id="tab2" method="post" action="index.php">
                <textarea name="data" rows="16" class="input-xlarge" style="width:950px;">array (
)</textarea>
                <div>
                    <button class="btn btn-primary"><?php I18n::p('SAVE');?></button>
                </div>
                <input type="hidden"  name="load" value="Collection/SaveRecord"/>
                <input type="hidden" name="type" value="Array" />
                <input type="hidden" name="db" value="<?php echo $this->db; ?>" />
                <input type="hidden" name="collection" value="<?php echo $this->collection; ?>" />
            </form>
        </div>
        <div class="tab-pane fade" id="JSON">
            <form id="tab3" method="post" action="index.php">
                <textarea name="data" rows="16" class="input-xlarge" style="width:950px;">{
  
}</textarea>
                <div>
                    <button class="btn btn-primary"><?php I18n::p('SAVE');?></button>
                </div>
                <input type="hidden"  name="load" value="Collection/SaveRecord"/>
                <input type="hidden" name="type" value="JSON" />
                <input type="hidden" name="db" value="<?php echo $this->db; ?>" />
                <input type="hidden" name="collection" value="<?php echo $this->collection; ?>" />
            </form>
        </div>
    </div>
</div>