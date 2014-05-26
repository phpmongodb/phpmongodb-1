<div class="header">
    <h1 class="page-title"><i class="icon-database"></i><a href="<?php echo Theme::URL('Collection/Index', array('db' => $this->db)); ?>"><?php echo $this->db; ?></a> (<i class="icon-collection"></i><?php echo $this->collection; ?>) </h1>
</div>
<div class="btn-toolbar">

    <a class="btn <?php echo $this->application->view === 'record' ? 'active' : ''; ?>" onclick="callAjax('<?php echo Theme::URL('Collection/Record', array('db' => $this->db, 'collection' => $this->collection)); ?>')" href="javascript:void(0)"><?php I18n::p('BROWSE'); ?></a>
    <?php if (!Application::isReadonly()) { ?>
        <?php if ($this->application->view === 'record') { ?>
            <button class="btn " id="btn-insert"><?php I18n::p('INSERT'); ?></button>
        <?php } else { ?>
            <a class="btn <?php echo $this->application->view === 'insert' ? 'active' : ''; ?>" onclick="callAjax('<?php echo Theme::URL('Collection/Insert', array('db' => $this->db, 'collection' => $this->collection)); ?>')" href="javascript:void(0)"><?php I18n::p('INSERT'); ?></a>
        <?php } ?>
    <?php } ?>
    <a class="btn <?php echo $this->application->view === 'export' ? 'active' : ''; ?>" onclick="callAjax('<?php echo Theme::URL('Collection/Export', array('db' => $this->db, 'collection' => $this->collection)); ?>');" href="javascript:void(0)"><?php I18n::p('EXPORT'); ?></a>
    <?php if (!Application::isReadonly()) { ?>
        <a class="btn <?php echo $this->application->view === 'import' ? 'active' : ''; ?>" onclick="callAjax('<?php echo Theme::URL('Collection/Import', array('db' => $this->db, 'collection' => $this->collection)); ?>')" href="javascript:void(0)"><?php I18n::p('IMPORT'); ?></a>
    <?php } ?>
    <a class="btn <?php echo $this->application->view === 'indexes' ? 'active' : ''; ?>" onclick="callAjax('<?php echo Theme::URL('Collection/Indexes', array('db' => $this->db, 'collection' => $this->collection)); ?>')" href="javascript:void(0)"><?php I18n::p('INDEXES'); ?></a>
    <a class="btn <?php echo $this->application->view === 'search' ? 'active' : ''; ?>" onclick="callAjax('<?php echo Theme::URL('Collection/Search', array('db' => $this->db, 'collection' => $this->collection)); ?>')" href="javascript:void(0)"><?php I18n::p('SEARCH'); ?></a>
</div>
