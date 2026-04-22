<?php /* Smarty version 2.6.9, created on 2020-02-27 15:33:15
         compiled from finacashpers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney2', 'finacashpers.tpl', 31, false),array('function', 'math', 'finacashpers.tpl', 32, false),)), $this); ?>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'> списък на сумите в брой<br> <?php echo $this->_tpl_vars['FILTTX']; ?>
</td>
		</tr>
		</thead>
					<?php if (count ( $this->_tpl_vars['LIST'] ) == 0): ?>
<tr>
<td colspan=5 align=center>
<br>
<b>няма събрани суми</b>
<br>&nbsp;
					<?php else: ?>
		<tr class='header'>
<td> събрал
		<td class='sep'>&nbsp;</td>
<td align=right> сума 
		</tr>

							<?php $this->assign('suma', 0);  $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<tr>
<td> <?php echo $this->_tpl_vars['elem']['person']; ?>

		<td class='sep'>&nbsp;</td>
<td align=right bgcolor="#dddddd" title="виж сумите">
<a href="<?php echo $this->_tpl_vars['elem']['pers']; ?>
" class="nyroModal" target="_blank">
<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['suma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</a>
						<?php echo smarty_function_math(array('equation' => "a+b",'a' => $this->_tpl_vars['suma'],'b' => $this->_tpl_vars['elem']['suma'],'assign' => 'suma'), $this);?>

		</tr>
	<?php endforeach; endif; unset($_from); ?>
		<tr class='header'>
<td> ОБЩО
		<td class='sep'>&nbsp;</td>
<td align=right><?php echo ((is_array($_tmp=$this->_tpl_vars['suma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

</table>

					<?php endif; ?>