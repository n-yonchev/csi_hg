<?php /* Smarty version 2.6.9, created on 2024-04-18 11:15:21
         compiled from issi_log.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strlen', 'issi_log.tpl', 37, false),array('modifier', 'truncate', 'issi_log.tpl', 40, false),)), $this); ?>
<table  class="d_table" cellspacing='0' cellpadding='0' align=center>
    <thead>
    <tr>
        <td class='d_table_title' colspan='200'>ИССИ логове</td>
    </tr>
    </thead>
    <tr class='header'>
        <td> дата на регистрите&nbsp;</td>
        <td class='sep'>&nbsp;</td>
        <td> успешно изпратена&nbsp;</td>
        <td class='sep'>&nbsp;</td>
        <td> успешно обработена&nbsp;</td>
        <td class='sep'>&nbsp;</td>
        <td> съобщение от ИССИ&nbsp;</td>
    </tr>

    <?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['element']):
?>
        <tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
    <td <?php if (! $this->_tpl_vars['element']['request_success'] || ! $this->_tpl_vars['element']['data_success']): ?>style="background-color: #fa6e61"<?php endif; ?> align="center"><?php echo $this->_tpl_vars['element']['data_date']; ?>
</td>
            <td class='sep'>&nbsp;</td>
            <td align="center">
                <?php if ($this->_tpl_vars['element']['request_success']): ?>
                    да
                <?php else: ?>
                    не
                <?php endif; ?>
            </td>
            <td class='sep'>&nbsp;</td>
            <td align="center">
                <?php if ($this->_tpl_vars['element']['data_success']): ?>
                    да
                <?php else: ?>
                    не
                <?php endif; ?>
            </td>
            <td class='sep'>&nbsp;</td>
            <td <?php if (( ((is_array($_tmp=$this->_tpl_vars['element']['success_message'])) ? $this->_run_mod_handler('strlen', true, $_tmp) : strlen($_tmp)) > 150 ) || ( ((is_array($_tmp=$this->_tpl_vars['element']['error_message'])) ? $this->_run_mod_handler('strlen', true, $_tmp) : strlen($_tmp)) > 150 )): ?>class="deliinfo issi-message" rel="issilogmsg.ajax.php?log=<?php echo $this->_tpl_vars['element']['id']; ?>
" title="Съобщение"<?php endif; ?>>
                <?php if ($this->_tpl_vars['element']['request_success']): ?>
                    <?php if ($this->_tpl_vars['element']['data_success']): ?>
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['element']['success_message'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 150, "...", true) : smarty_modifier_truncate($_tmp, 150, "...", true)); ?>

                    <?php else: ?>
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['element']['error_message'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 150, "...", true) : smarty_modifier_truncate($_tmp, 150, "...", true)); ?>

                    <?php endif; ?>
                <?php else: ?>
                    Неуспешно изпълнена заявка.
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; endif; unset($_from); ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script>
$(document).ready(function() {
	$('.deliinfo').cluetip({ width: 660, cursor:'help' });
});
</script>