<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazoevenview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'cazoevenview.tpl', 34, false),array('modifier', 'date_format', 'cazoevenview.tpl', 37, false),)), $this); ?>
<table class="d_table" cellspacing='0' cellpadding='0' <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoplan.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
	<thead>
		<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">
<div style="float:left">
събития
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
			<?php if ($this->_tpl_vars['FLAGNOCHANGE']): ?>
			<?php else: ?>
<div class='d_table_button' style="float:right">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => "caseeditzone.php".($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
			<?php endif; ?>
		</tr>
	</thead>
	<tr class='header'>
<td> дата </td>
			<td class='sep'>&nbsp;</td>
<td> събитие </td>
		<?php if ($this->_tpl_vars['FLAGNOCHANGE']): ?>
		<?php else: ?>
			<td class='sep'>&nbsp;</td>	
			<td><span> &nbsp;</span></td>
		<?php endif; ?>
	</tr>
	<tbody>

		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
				<?php $this->assign('arindx', $this->_tpl_vars['elem']['idsubtype']); ?>
			<?php if (empty ( $this->_tpl_vars['ARSUBT'][$this->_tpl_vars['arindx']] )): ?>
				<?php $this->assign('txsubtype', ""); ?>
			<?php else: ?>
				<?php $this->assign('txsubtype', ((is_array($_tmp="/")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ARSUBT'][$this->_tpl_vars['arindx']]) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ARSUBT'][$this->_tpl_vars['arindx']]))); ?>
			<?php endif; ?>
<tr onmouseover='this.className="trhove";' onmouseout='this.className="";'>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

			<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['text']; ?>
 </td>
		<?php if ($this->_tpl_vars['FLAGNOCHANGE']):  $this->assign('cosp', '0'); ?>
		<?php else:  $this->assign('cosp', '4'); ?>
			<td class='sep'>&nbsp;</td>
			<td> 
<nobr>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['delrec']; ?>
" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
</nobr>
			</td>
		<?php endif; ?>
		</tr>
		<?php endforeach; endif; unset($_from); ?>

</tbody>
</table>

<script type="text/javascript">
	$('a.nyroModal').nyroModal();
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_frame.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


