<div class="header">
    <h1 class="page-title"><?php I18n::p('DB'); ?></h1>
</div>
<div class="row-fluid">
    <div class="block span6">
        <div class="block-heading">
            <a href="#widget2container" data-toggle="collapse"><?php I18n::p('DB'); ?></a>
        </div>
        <div id="widget2container" class="block-body collapse in">
            <table class="table list">
                <thead>
                    <tr>
                        <th><?php I18n::p('NAME'); ?></th>
                        <th><?php I18n::p('S_O_D'); ?></th>
                        <th >&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($this->data['dbList']['databases']) && is_array($this->data['dbList']['databases'])) {
                        foreach ($this->data['dbList']['databases'] as $db) {
                            ?>
                            <tr>
                                <td><a href="<?php echo Theme::URL('Collection/Index', array('db' => $db['name'])); ?>"><?php echo $db['name']; ?></i></td>
                                <td><?php echo $db['sizeOnDisk']; ?></td>
                                <?php if (!Application::isReadonly()) { ?>
                                    <td>
                                        <a href="#myModal" data-edit-db="<?php echo $db['name']; ?>" role="button" data-toggle="modal" class="icon-edit" title="Edit">&nbsp;</a>
                                        <a href="#myModal" data-delete-db="<?php echo $db['name']; ?>" role="button" data-toggle="modal" class="icon-remove" title="Remove">&nbsp;</a>
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    if (!Application::isReadonly())
        require_once '_create.php';
    ?>
</div>
<?php
if (!Application::isReadonly())
    require_once '_form.php';
?>