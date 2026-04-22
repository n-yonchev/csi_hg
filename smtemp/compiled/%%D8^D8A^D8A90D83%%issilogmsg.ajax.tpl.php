<?php /* Smarty version 2.6.9, created on 2024-05-29 16:42:16
         compiled from issilogmsg.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'issilogmsg.ajax.tpl', 5, false),)), $this); ?>

</div>
    <?php if ($this->_tpl_vars['LOG']['request_success']): ?>
        <?php if ($this->_tpl_vars['LOG']['data_success']): ?>
            <?php echo ((is_array($_tmp=$this->_tpl_vars['LOG']['success_message'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 3000, "...", true) : smarty_modifier_truncate($_tmp, 3000, "...", true)); ?>

        <?php else: ?>
            <?php echo $this->_tpl_vars['LOG']['error_message']; ?>

        <?php endif; ?>
    <?php else: ?>
        Неуспешно изпълнена заявка.
    <?php endif; ?>
</div>