<?php /* Smarty version 2.6.9, created on 2020-03-09 10:44:26
         compiled from outd.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'outd.tpl', 36, false),)), $this); ?>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
			<td class='d_table_title' colspan='200'>изход€щи документи</td>
		</tr>
	</thead>
		<tr class='header'>
			<td> изх. номер&nbsp;</td>
			<td class='sep'>&nbsp;</td>
			<td> изведен&nbsp;</td>
			<td class='sep'>&nbsp;</td>
<td> адресат</td>
			<td class='sep'>&nbsp;</td>
			<td> тип&nbsp;</td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
			<td class='sep'>&nbsp;</td>
			<td> дело </td>
			<td class='sep'>&nbsp;</td>
			<td> деловодител </td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
			<td class='sep'>&nbsp;</td>
<td>образ</td>
		</tr>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
					<?php if ($this->_tpl_vars['elem']['serial'] == 0): ?>
			<td class="contleft"> 
					<?php else: ?>
			<td class="contleft"> <?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>

					<?php endif; ?>
			<td class='sep'>&nbsp;</td>
			<td class="contleft"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['registered'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

			<td class='sep'>&nbsp;</td>
<td class="contleft"> <?php echo $this->_tpl_vars['elem']['adresat']; ?>

			<td class='sep'>&nbsp;</td>
			<td class="contleft"> <?php echo $this->_tpl_vars['elem']['typetext']; ?>


			<td class='sep'>&nbsp;</td>
			<td align=right>
														<?php if ($this->_tpl_vars['elem']['suff'] == 'html'): ?>
<?php if (empty ( $this->_tpl_vars['elem']['content'] )): ?>
	<font color=red> празен </font>
<?php else: ?>
	<a href="<?php echo $this->_tpl_vars['elem']['view']; ?>
" class="nyroModal" target="_blank">
	<img src="images/view.png" title="разгледай документа">
	</a>
<?php endif; ?>
							<?php else: ?>
<a href="file:///<?php echo $this->_tpl_vars['LETDOC']; ?>
:/<?php echo $this->_tpl_vars['elem']['id']; ?>
.doc" target="_blank">
<img src="images/word.gif" title="разгледай">
</a>
							<?php endif; ?>
			<td class='sep'>&nbsp;</td>
			<td>
<a href="<?php echo $this->_tpl_vars['elem']['dele']; ?>
" class="nyroModal" target="_blank">
<img src="images/free.gif" title="изтрий документа">
</a>
			<td class='sep'>&nbsp;</td>
			<td class="contleft"> <?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>

			<td class='sep'>&nbsp;</td>
			<td class="contleft"> <?php echo $this->_tpl_vars['elem']['ownernam']; ?>

			<td class='sep'>&nbsp;</td>
<td align=center>
<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
"> <img src="images/view.png" title="делото подробно">
</a></td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=left>
					<?php $this->assign('iddocu', $this->_tpl_vars['elem']['id']); ?>
					<?php $this->assign('scancoun', $this->_tpl_vars['ARSCANCOUN'][$this->_tpl_vars['iddocu']]); ?>
		<?php if ($this->_tpl_vars['scancoun'] == 0): ?>
&nbsp;
		<?php else: ?>
<img src="images/tranclos.gif" style="cursor:pointer" title="виж изображение" onclick="w2=window.open('<?php echo $this->_tpl_vars['elem']['scanview']; ?>
','win2');w2.focus();">
			<?php if ($this->_tpl_vars['scancoun'] == 1): ?>
			<?php else: ?>
<sup><?php echo $this->_tpl_vars['ARSCANCOUN'][$this->_tpl_vars['iddocu']]; ?>
</sup>
			<?php endif; ?>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
			
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</table>