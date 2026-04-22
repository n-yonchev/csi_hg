<?php /* Smarty version 2.6.9, created on 2020-02-27 14:38:56
         compiled from deliinfodocu.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'deliinfodocu.ajax.tpl', 23, false),array('modifier', 'nl2br', 'deliinfodocu.ajax.tpl', 27, false),)), $this); ?>
<table align=center>
<tr>
<td class="he7"> адресат
<td class="he7"> адрес
<td class="he7"> метод
<td class="he7"> взет
<td class="he7"> връчен
<td class="he7"> върнат
<td class="he7"> статус
<td class="he7"> бележки
		<?php $_from = $this->_tpl_vars['ARDELI']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['eldata']):
?>
<tr>
<td class="ro7"> <?php echo $this->_tpl_vars['eldata']['adresat']; ?>

<td class="ro7"> <?php echo $this->_tpl_vars['eldata']['address']; ?>

<td class="ro7"> <?php echo $this->_tpl_vars['ARPOSTTYPE_2'][$this->_tpl_vars['eldata']['idposttype']]; ?>

<td class="ro7"> <?php echo ((is_array($_tmp=$this->_tpl_vars['eldata']['date1'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
&nbsp;
<td class="ro7"> <?php echo ((is_array($_tmp=$this->_tpl_vars['eldata']['date2'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
&nbsp;
<td class="ro7"> <?php echo ((is_array($_tmp=$this->_tpl_vars['eldata']['date3'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
&nbsp;
<td <?php if ($this->_tpl_vars['eldata']['isertype']): ?>class="ertype" title="статуса не отговаря на метода"<?php else: ?>class="ro7"<?php endif; ?>> <?php echo $this->_tpl_vars['eldata']['statname']; ?>
&nbsp;
<td class="ro7"> <?php echo ((is_array($_tmp=$this->_tpl_vars['eldata']['notes'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
&nbsp;
		<?php endforeach; endif; unset($_from); ?>
</table>