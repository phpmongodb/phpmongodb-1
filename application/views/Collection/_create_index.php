<div class="tab-pane fade" id="IndexesCreate">
    <form id="tab1" method="post" action="index.php">
        <table id="tbl-create-indexes">
            <tr>
                <td style="width:160px;"><?php I18n::p('NAME'); ?></td>
                <td colspan="2"><input type="text" class="input-xlarge" name="name" required="required"></td>
            </tr>
            <tr>
                <td><?php I18n::p('FIELDS'); ?></td>
                <td><input type="text" class="input-xlarge" name="fields[]" required="required"></td>
                <td>
                    <select name="orders[]" style="width:auto;">
                        <option value="1">ASC</option>
                        <option value="-1">DESC</option>
                    </select>
                </td>
                <td>&nbsp;<a href="javascript:void(0)" onclick="PMDIN.appendTR();" class="icon-plus" title="Add">&nbsp;</a>&nbsp;</td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width:160px;"><?php I18n::p('UNIQUE'); ?></td>
                <td colspan="2"><input type="checkbox"  value="1" name="unique" id="index_unique" onclick="PMDIN.isCheck(this)"></td>
            </tr>
            <tr id="drop_duplicates" style="display: none">
                <td>Drop duplicates?</td>
                <td colspan="2"><input type="checkbox"  value="1" name="drop"></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
        </table>
        <div>
            <button class="btn btn-primary"><?php I18n::p('CREATE'); ?></button>
        </div>
        <input type="hidden"  name="load" value="Collection/CreateIndexes"/>
        <input type="hidden" name="db" value="<?php echo $this->db; ?>" />
        <input type="hidden" name="collection" value="<?php echo $this->collection; ?>" />
    </form>
</div>