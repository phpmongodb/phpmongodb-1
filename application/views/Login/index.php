<?php $autocomplete= isset(Config::$autocomplete) && Config::$autocomplete==TRUE ?'on':'off';?>
<div class="dialog">
    <div class="block">
        <p class="block-heading">Sign In</p>
        <div class="block-body">
            <form id="tab2" method="post" action="index.php">
                <label><?php I18n::p('USERNAME'); ?></label>
                <input name="username" type="text" class="span12" autocomplete="<?php echo $autocomplete;?>">
                <label><?php I18n::p('PASSWORD'); ?></label>
                <input name="password" type="password" class="span12" value="" autocomplete="<?php echo $autocomplete;?>">
                <?php
                if (Config::$authentication['authentication']) {
                    ?>
                    <label><?php I18n::p('Database'); ?></label>
                    <input name="db" type="text" class="span12" value="" autocomplete="<?php echo $autocomplete;?>">
                <?php } ?>
                <button class="btn btn-primary pull-right"><?php I18n::p('LOGIN'); ?></button>

                <div class="clearfix"></div>
                <input type="hidden"  name="load" value="Login/Index"/>
            </form>
        </div>
    </div>
</div>
