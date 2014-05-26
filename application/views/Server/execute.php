<div class="header">
    <h1 class="page-title">Execute</h1>
</div>
<div class="btn-toolbar">&nbsp;</div>

<div class="well" >
<form id="tab3" method="post" action="index.php?load=Server/Execute">
    <textarea name="code"  class="input-xlarge" style="width:950px;"><?php echo $this->data['code']; ?></textarea>
    <div>
        Database : <select style="width:auto;" name="db">
            <?php
            foreach ($this->data['databases']['databases'] as $db) {
                echo '<option value="' . $db['name'] . '">' . $db['name'] . '</option>';
            }
            ?>    
        </select>
    </div>
    <div>
        <button class="btn btn-primary"><?php I18n::p('Execute'); ?></button>
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