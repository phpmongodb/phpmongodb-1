<?php require_once '_menu.php'; ?>

<form method="post" action="index.php" enctype="multipart/form-data">
    <div class="row-fluid">
        <div class="block " id="block_export_method">
            <a href="javascript:void(0)" class="block-heading" data-toggle="collapse"><?php echo I18n::t('I_I_T_C',$this->collection );?> </a>
            <div class="block-body">
                <?php I18n::p('JSON_FILE');?> <input type="file" name="import_file" id="import_file"/>
            </div>
        </div>
        
        <input type="hidden" name="db" id="db-export" value="<?php echo $this->db; ?>" />
        <input type="hidden" name="collection" id="collection_export" value="<?php echo $this->collection; ?>" />
        <input type="hidden" name="load" value="Collection/Import" />
        <input class="btn btn-primary btn-large" type="submit" name="btnExport" Value="<?php I18n::p('IMPORT');?>" />
    </div>
</form>    
 
