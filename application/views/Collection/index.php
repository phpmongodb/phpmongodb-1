<div class="header">
    <h1 class="page-title"><i class="icon-database"></i><?php echo $this->db; ?></h1>
</div>
<div class="row-fluid">
    <div class="block span6">
        <div class="block-heading">
            <a href="#widget2container" data-toggle="collapse"><?php I18n::p('COLLECTION'); ?></a>
        </div>
        <div id="widget2container" class="block-body collapse in">
            <table class="table list">
                <thead>
                    <tr>
                        <th><?php I18n::p('NAME'); ?></th>
                        <th><?php I18n::p('T_C'); ?></th>
                        <th >&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->data['collectionList'] as $collection) { ?>
                        <tr>
                            <td><p><i class="icon-user"></i> <a  href="<?php echo Theme::URL('Collection/Record', array('db' => $this->db, 'collection' => $collection['name'])); ?>"><?php echo $collection['name']; ?></a></p></td>

                            <td><?php echo $collection['count']; ?></td>
                             <?php if(!Application::isReadonly()) {?>
                            <td>
                                <a  href="#myModal" data-edit-collection="<?php echo urlencode($collection['name']); ?>" role="button" data-toggle="modal" title="Edit" class="icon-edit">
                                    &nbsp;
                                </a>
                                <a href="#myModal" data-delete-collection="<?php echo urlencode($collection['name']); ?>"role="button" data-toggle="modal" title="Remove" class="icon-remove">
                                    &nbsp;
                                </a>
                            </td>
                            <?php }?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php 
        if(!Application::isReadonly())
            require_once '_create.php'; 
    ?>
</div>
<?php 
        if(!Application::isReadonly())
            require_once '_form.php'; 
    ?>
