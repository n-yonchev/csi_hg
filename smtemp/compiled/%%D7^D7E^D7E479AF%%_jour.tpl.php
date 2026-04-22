<?php /* Smarty version 2.6.9, created on 2020-03-02 13:41:29
         compiled from _jour.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '_jour.tpl', 7, false),)), $this); ?>
						<?php $this->assign('mycrea', ""); ?>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<tr onmouseover='this.className="trdocu";' onmouseout='this.className="";'>
						<?php $this->assign('focrea', ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y"))); ?>
						<?php if ($this->_tpl_vars['mycrea'] == $this->_tpl_vars['focrea']): ?>
			<td valign=top> &nbsp;
						<?php else: ?>
			<td valign=top> <?php echo $this->_tpl_vars['focrea']; ?>

							<?php $this->assign('mycrea', $this->_tpl_vars['focrea']); ?>
						<?php endif; ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepaprin.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<td valign=top align=center> <?php echo $this->_tpl_vars['elem']['seno']; ?>
 &nbsp;
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepaprin.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php if (isset ( $this->_tpl_vars['elem']['caselist'] )): ?>
<td valign=top align=left> 
<?php if ($this->_tpl_vars['PRIN']):  echo $this->_tpl_vars['elem']['caselist'][0]; ?>
&nbsp;
	<?php if (count ( $this->_tpl_vars['elem']['caselist'] ) > 1): ?>
...
	<?php else: ?>
	<?php endif;  else: ?>
	<?php if (count ( $this->_tpl_vars['elem']['caselist'] ) > 1): ?>
<img src="images/view.png" title='<?php $_from = $this->_tpl_vars['elem']['caselist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cuca']):
 echo $this->_tpl_vars['cuca']; ?>
&nbsp;<?php endforeach; endif; unset($_from); ?>'>
	<?php else:  echo $this->_tpl_vars['elem']['caselist'][0]; ?>

	<?php endif;  endif; ?>
				<?php elseif (empty ( $this->_tpl_vars['elem']['caseseri'] ) && empty ( $this->_tpl_vars['elem']['caseyear'] )): ?>
			<td valign=top align=left> &nbsp;
				<?php else: ?>
			<td valign=top align=left> <?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>
 &nbsp;
				<?php endif; ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepaprin.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<td valign=top> <?php echo $this->_tpl_vars['elem']['descrip']; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepaprin.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<td valign=top> <?php echo $this->_tpl_vars['elem']['person']; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepaprin.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
							<?php if ($this->_tpl_vars['elem']['type'] == 0): ?>
								<?php $this->assign('tdtext', "ръчно въведен"); ?>
							<?php elseif ($this->_tpl_vars['elem']['type'] == 1): ?>
								<?php $this->assign('tdtext', "входящ"); ?>
							<?php elseif ($this->_tpl_vars['elem']['type'] == 2): ?>
								<?php $this->assign('tdtext', "изх."); ?>
							<?php elseif ($this->_tpl_vars['elem']['type'] == 3): ?>
								<?php $this->assign('tdtext', "постъпление"); ?>
							<?php elseif ($this->_tpl_vars['elem']['type'] == 4): ?>
								<?php $this->assign('tdtext', "ПДИ"); ?>
							<?php elseif ($this->_tpl_vars['elem']['type'] == 5): ?>
								<?php $this->assign('tdtext', "плащане"); ?>
							<?php elseif ($this->_tpl_vars['elem']['type'] == 6): ?>
								<?php $this->assign('tdtext', "връчване"); ?>
							<?php else: ?>
								<?php $this->assign('tdtext', "?"); ?>
							<?php endif; ?>
			<td valign=top> <?php echo $this->_tpl_vars['tdtext']; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepaprin.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<td valign=top align=right> 
				<?php if (empty ( $this->_tpl_vars['elem']['serial'] ) && empty ( $this->_tpl_vars['elem']['year'] )): ?>
			&nbsp;
				<?php else: ?>
			<?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>
 &nbsp;
				<?php endif; ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepaprin.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php if ($this->_tpl_vars['PRIN']): ?>
						<?php else: ?>
							<?php if ($this->_tpl_vars['elem']['type'] == 0): ?>
<td align=center>
<nobr>
<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="<?php echo $this->_tpl_vars['elem']['dele']; ?>
" class="nyroModal" target="_blank">
<img src="images/free.gif" title="изтрий">
</a>
</nobr>
</td>
							<?php else: ?>
<td> &nbsp;
							<?php endif; ?>
						<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>