<?php require_once '_menu.php'; ?>
<?php if($this->data['record']){?>
<div class="row-fluid">
    <div id="block_export_method" class="block ">
        <a href="<?php echo Theme::URL('Collection/Export',array('db'=>$this->db,'collection'=>$this->collection)); ?>" class="block-heading" ><?php I18n::p('BACK');?></a>
        <textarea  rows="10" style="width:1040px;"><?php echo $this->data['record'];?></textarea>
    </div>    
</div>     
<?php }else{?>
<form method="post" action="index.php">
    <div class="row-fluid">
        <div class="block " id="block_export_method">
            <a href="javascript:void(0)" class="block-heading" data-toggle="collapse"><?php I18n::p('E_M');?></a>
            <div class="block-body">
                <input type="radio" id="quick_export" value="quick" name="quick_or_custom" checked="checked">&nbsp;<?php I18n::p('Q_D_O_T_M_O');?><br>
                <input type="radio" id="custom_export" value="custom" name="quick_or_custom">&nbsp;<?php I18n::p('C_D_A_P_O');?>
            </div>
        </div>
        <div class="block " style="display:none;" id="block_export_rows">
            <a href="javascript:void(0)" class="block-heading" data-toggle="collapse"><?php I18n::p('ROWS');?></a>
            <div class="block-body">
                <input type="radio" checked="checked" id="dump_all_export" value="all" name="all_or_some">&nbsp;<?php I18n::p('D_A_R');?><br>
                <input type="radio" id="dump_some_export" value="custom" name="all_or_some">&nbsp;<?php I18n::p('D_S_R');?>
                <table id="dump_some_row_export" style="margin-left: 40px;display:none;">
                    <tr>
                        <td><?php I18n::p('N_O_R');?></td>
                        <td><input type="text"  value="" size="5" name="limit" id="limit_to_export"></td>
                    </tr>
                    <tr>
                        <td><?php I18n::p('R_T_B_A');?></td>
                        <td><input type="text"  value="" size="5" name="skip" id="limit_from_export"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="block" id="block_export_output" style="display:none;">
            <a href="javascript:void(0)" class="block-heading" data-toggle="collapse"><?php I18n::p('OUTPUT');?></a>
            <div class="block-body">
           <input type="radio"  id="save_export" value="save" name="text_or_save" checked="checked">&nbsp;<?php I18n::p('S_O_T_A_F');?><br>
                <table id="save_output_to_a_file" style="margin-left: 40px;">
                    <tr>
                        <td><?php I18n::p('F_N');?> </td>
                        <td><input type="text"  value="<?php echo $this->collection;?>"  name="file_name" id="file_name_export"></td>
                    </tr>
                    <tr><td><?php I18n::p('COMPRESSED');?> </td>
                        <td><select name="compression" id="compression_export">
                                <option value="none"><?php I18n::p('None');?></option>
                                <option value="zip">zipped</option>
                                <option value="gzip">gzipped</option>
                                <option value="bzip2">bzipped</option>
                            </select></td></tr>
                </table>
                <input type="radio"  id="text_export" value="text" name="text_or_save">&nbsp;<?php I18n::p('V_O_A_T');?><br>
            </div>
        </div>
        <div class="block " id="block_export_data_dump_options" style="display:none;">
            <a href="#tablewidget" class="block-heading" data-toggle="collapse"><?php I18n::p('D_D_O');?></a>
            <div class="block-body">
                <input type="radio" checked="checked" id="json_export" value="quick" name="json">&nbsp;<?php I18n::p('JSON');?><br>
               
            </div>
        </div>
        <input type="hidden" name="db" id="db-export" value="<?php echo $this->db; ?>" />
        <input type="hidden" name="collection" id="collection_export" value="<?php echo $this->collection; ?>" />
        <input type="hidden" name="load" value="Collection/Export" />
        <input class="btn btn-primary btn-large" type="submit" name="btnExport" Value="<?php I18n::p('EXPORT');?>" />
    </div>
</form>    
<script>
    $(document).ready(function() {
       PMDE.init();
    });
 </script>    
<?php }?>