<div class="header">
    <h1 class="page-title">Execute</h1>
</div>
<div class="btn-toolbar">&nbsp;</div>

<div class="well" >
    <form id="execute-form" name="form" method="post" action="index.php?load=Server/Execute&theme=false">
        <textarea name="code"  class="input-xlarge" style="width:950px;" id="execute_code"><?php echo $this->data['code']; ?></textarea>
        <table id="tbl-fiedl-value">
        </table>
        <div>
            Database : <select style="width:auto;" name="db" id="execute_db">
                <?php
                foreach ($this->data['databases']['databases'] as $db) {
                    $selected = ($this->data['db'] == $db['name'] ? 'selected="selected"' : '');
                    echo '<option value="' . $db['name'] . '" ' . $selected . '>' . $db['name'] . '</option>';
                }
                ?>    
            </select>
            Argument<a href="javascript:void(0)" class="icon-plus" title="<?php I18n::p('ADD'); ?>"  onclick="PMDE.appendBox()">&nbsp;</a>
        </div>
        <div>
            <a href="javascript:void(0)" onclick="PMDE.execute()" class="btn btn-primary"><?php I18n::p('Execute'); ?></a>
        </div>

    </form>

    <p>
        <?php
        if (!empty($this->data['response'])) {
            echo "<pre>";
            print_r($this->data['response']);
            echo "</pre>";
        }
        ?> 
    </p>
</div>
<div id="execute-response"></div>