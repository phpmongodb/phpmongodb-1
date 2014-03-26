<div class="block span6">
        <p class="block-heading" id="block-heading"><?php I18n::p('C_DB');?></p>
        <div class="block-body">
            <form id="form-create-database" method="post" class="form-inline" action="index.php">
                <label><?php I18n::p('NAME');?></label>
                <input type="text" value="" id="database" name="db" class="input-xlarge" required="required">
                <input type="hidden" id="load-create" name="load" value="Database/Save" />
                <button class="btn " name="btnCreateDb"><i class="icon-save" ></i><?php I18n::p('SAVE');?> </button>
            </form>
        </div>
    </div>