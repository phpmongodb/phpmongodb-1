<?php defined('PMDDA') or die('Restricted access'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>PHPmongoDB </title>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="mongoDB">
        <meta name="author" content="">

        <link rel="stylesheet" type="text/css" href="<?php echo Theme::getPath(); ?>bootstrap/css/bootstrap.css">

        <link rel="stylesheet" type="text/css" href="<?php echo Theme::getPath(); ?>css/style.css?v=<?php echo Theme::getVersion('/application/themes/default/css/style.css');?> ">

        <link rel="icon" href="<?php echo Theme::getPath(); ?>images/favicon.ico" type="image/x-icon" />

        <script src="<?php echo Theme::getPath(); ?>js/jquery-1.8.1.min.js" type="text/javascript"></script>

        <!-- Demo page code -->

        <style type="text/css">
            #line-chart {
                height:300px;
                width:800px;
                margin: 0px auto;
                margin-top: 1em;
            }
            .brand { font-family: georgia, serif; }
            .brand .first {
                color: #ccc;
                font-style: italic;
            }
            .brand .second {
                color: #fff;
                font-weight: bold;
            }
        </style>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="<?php echo Theme::getPath(); ?>lib/html5.js"></script>
        <![endif]-->


    </head>

    <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
    <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
    <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
    <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!--> 
    <body class=""> 
        <!--<![endif]-->

        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav pull-right">
                    <?php if($isLogedIn){ ?>
                    <li><a href="<?php echo Theme::URL('Server/Execute'); ?>" ><?php echo I18n::t('Execute');?></a></li>
                    <li><a href="<?php echo Theme::URL('Database/Index'); ?>" ><?php echo I18n::t('DB');?></a></li>
                    <li><a href="<?php echo Theme::URL('Index/Status'); ?>" ><?php echo I18n::t('STATUS');?></a></li>
                    <li><a href="<?php echo Theme::URL('Login/Logout'); ?>"  ><?php echo I18n::t('LOGOUT');?></a></li>
                    <?php }?>
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i><?php echo I18n::t('LAN');?>
                            <i class="icon-caret-down"></i>
                        </a>

                        
                        <ul class="dropdown-menu">
                            <?php
                                $languageList = Widget::get('languageList');
                                foreach($languageList as $key=>$val){
                                    
                                
                            ?>
                            <li><a tabindex="-1" href="<?php echo Theme::URL('Index/SetLanguage',array('language'=>$key)); ?>"><?php echo $val;?></a></li>
                            <?php }?>
                        </ul>
                    </li>

                </ul>
                <a class="brand" href="<?php echo Theme::getHome(); ?>"><span class="second">{ </span><span class="first">PHP</span> <span class="second">mongoDB }</span></a>
            </div>
        </div>
