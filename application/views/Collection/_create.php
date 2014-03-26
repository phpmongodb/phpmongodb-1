<div class="block span6">
        <p class="block-heading" id="block-heading"><?php echo I18n::t('CAE_COL');?></p>
        <div class="block-body">
            <form id="form-create-collection" method="post" class="form-inline" action="index.php">
                <label style="width:70px;"><?php I18n::p('NAME'); ?></label>
                <input type="text" value="" id="collection_name" name="collection" class="input-xlarge" required="required"><br><br>
                <label style="width:70px;"><?php I18n::p('IS_CAPPED'); ?></label>
                <input type="checkbox" value="1" id="collection_capped" name="capped"><br><br>
                <label style="width:70px;"><?php I18n::p('SIZE'); ?></label>
                <input type="text" value="" id="collection_size" name="size" class="input-xlarge "><br><br>
                <label style="width:70px;"><?php I18n::p('Max'); ?></label>
                <input type="text" value="" id="collection_max" name="max" class="input-xlarge"><br><br>
                <input type="hidden" id="load-create" name="load" value="Collection/CreateCollection" />
                <input type="hidden" name="db" value="<?php echo $this->db; ?>" />
                <label style="width:70px;">&nbsp;</label>

                <button class="btn btn-primary" name="save"><?php I18n::p('CREATE'); ?> </button>

            </form>
        </div>
    </div>