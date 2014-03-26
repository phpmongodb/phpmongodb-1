<?php defined('PMDDA') or die('Restricted access'); ?>
<?php $isLogedIn=Application::getInstance('Session')->isLogedIn(); ?>
<?php include('header.php'); ?>
<?php $isLogedIn ?include('sidebar.php'):'';?>


<div class="bodymargin <?php echo $isLogedIn?'content':'content-gap';?>">
    <!--Call View -->
    <div class="container-fluid">
        <div class="row-fluid">
            <?php
            
            $sucess = isset(View::getMessage()->sucess);
            $error = isset(View::getMessage()->error);
            
            ?>
            <?php if ($sucess || $error) { ?>
                <div class="alert <?php echo $sucess == true ? 'alert-info' : '' ?>">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Note:</strong> <?php echo $error == true ? View::getMessage()->error : View::getMessage()->sucess; ?>
                </div>
            <?php } ?>
            <div id="middle-content">
                <?php echo View::getContent(); ?>
            </div>
        </div>
    </div>

</div>
<?php include('footer.php'); ?>





