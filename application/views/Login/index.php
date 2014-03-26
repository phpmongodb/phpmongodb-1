<div class="dialog">
    <div class="block">
        <p class="block-heading">Sign In</p>
        <div class="block-body">
            <form id="tab2" method="post" action="index.php">
                <label><?php I18n::p('USERNAME'); ?></label>
                <input name="username" type="text" class="span12">
                <label><?php I18n::p('PASSWORD'); ?></label>
                <input name="password" type="password" class="span12" value="" autocomplete="<?php echo isset(Config::$autocomplete) && Config::$autocomplete==TRUE ?'on':'off';?>">
                <?php
                if (Config::$authentication['authentication']) {
                    ?>
                    <label><?php I18n::p('Database'); ?></label>
                    <input name="db" type="text" class="span12" value="" autocomplete="off">
                <?php } ?>
                <button class="btn btn-primary pull-right"><?php I18n::p('LOGIN'); ?></button>

                <div class="clearfix"></div>
                <input type="hidden"  name="load" value="Login/Index"/>
            </form>
        </div>
    </div>
</div>
