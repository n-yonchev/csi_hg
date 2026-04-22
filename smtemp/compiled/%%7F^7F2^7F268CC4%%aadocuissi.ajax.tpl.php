<?php /* Smarty version 2.6.9, created on 2024-04-18 11:15:41
         compiled from aadocuissi.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  if ($this->_tpl_vars['EDIT'] == 0): ?>
	<?php $this->assign('_title', 'въведи нов тип');  else: ?>
	<?php $this->assign('_title', 'корегирай тип ИССИ');  endif;  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.header.tpl", 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['_title'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br>
Тип на документа спрямо ИССИ
<br>
<select name="id_doc_sub_category">
<?php $_from = $this->_tpl_vars['ISSI_CAT']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cat_ekey'] => $this->_tpl_vars['cat_elem']):
?>
	<?php if (! empty ( $this->_tpl_vars['ISSI_SUB_CAT_GROUPED'][$this->_tpl_vars['cat_elem']['id']] )): ?>
		<optgroup label="<?php echo $this->_tpl_vars['cat_elem']['name']; ?>
">
		<?php $_from = $this->_tpl_vars['ISSI_SUB_CAT_GROUPED'][$this->_tpl_vars['cat_elem']['id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<option <?php if ($_POST['id_doc_sub_category'] == $this->_tpl_vars['elem']['id']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['elem']['id']; ?>
"><?php echo $this->_tpl_vars['elem']['name']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
		</optgroup>
	<?php endif;  endforeach; endif; unset($_from); ?>
</select>
	
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>