<?php /* Smarty version 2.6.9, created on 2020-02-28 11:21:15
         compiled from comple.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'comple.tpl', 56, false),)), $this); ?>
							<?php if ($this->_tpl_vars['YEARFLAG']): ?>
<div class='tabs_line' >
	<table class='tabs' style='' cellspacing='0'  cellpadding='0' border='0' >
	<tr>
	<?php $_from = $this->_tpl_vars['YEARLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<td class='tabs_sep'>&nbsp;</td> 
		<?php if ($this->_tpl_vars['YEAR'] == $this->_tpl_vars['ekey']): ?>
			<td class='tabs_left_selected'></td>
			<td class='tabs_middle_selected'><span><?php echo $this->_tpl_vars['ekey']; ?>
</span></td>
			<td class='tabs_right_selected'></td>
		<?php else: ?>	
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_left'></td>
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_middle'><span><?php echo $this->_tpl_vars['ekey']; ?>
</span></td>
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_right'></td>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</tr>
	</table>
</div>
							<?php else: ?>
							<?php endif; ?>

		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='18'>
списък на делата с непълни основни данни
<br>
на деловодител <?php echo $this->_tpl_vars['USERDATA']['name']; ?>
 за <?php echo $this->_tpl_vars['YEAR']; ?>
 година 
		</thead>
		<tr class='header'>
<td align=left> дело
		<td class='sep'>&nbsp;</td>	
<td> образувано </td>
		<td class='sep'>&nbsp;</td>	
<td> идва от </td>
		<td class='sep'>&nbsp;</td>	
<td> титул </td>
		<td class='sep'>&nbsp;</td>	
<td> вид </td>
		<td class='sep'>&nbsp;</td>	
<td> ред за отчета </td>
		<td class='sep'>&nbsp;</td>	
<td> характер </td>
		<td class='sep'>&nbsp;</td>	
<td> взем.вид-размер </td>
		<td class='sep'>&nbsp;</td>	
<td> взем.произход </td>
		
		<tbody>
<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'
		onclick="window.location.href='<?php echo $this->_tpl_vars['elem']['edit']; ?>
';" style="cursor:pointer;">
<td align=left> <?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>

		<td class='sep'>&nbsp;</td>
<td align=left> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

		<td class='sep'>&nbsp;</td>
<td align=left> <?php echo $this->_tpl_vars['ARFROM'][$this->_tpl_vars['elem']['idcofrom']]; ?>

		<td class='sep'>&nbsp;</td>
<td align=left> <?php echo $this->_tpl_vars['ARTITU'][$this->_tpl_vars['elem']['idtitu']]; ?>

		<td class='sep'>&nbsp;</td>
<td align=left> <?php echo $this->_tpl_vars['ARSORT'][$this->_tpl_vars['elem']['idsort']]; ?>

		<td class='sep'>&nbsp;</td>
<td align=left> <?php echo $this->_tpl_vars['ARREPO'][$this->_tpl_vars['elem']['idrepo']]; ?>

		<td class='sep'>&nbsp;</td>
<td align=left> <?php echo $this->_tpl_vars['ARCHAR'][$this->_tpl_vars['elem']['idchar']]; ?>

		<td class='sep'>&nbsp;</td>
<td align=left> <?php echo $this->_tpl_vars['elem']['claimdescrip']; ?>

		<td class='sep'>&nbsp;</td>
<td align=left> <?php echo $this->_tpl_vars['elem']['origname']; ?>

<?php endforeach; endif; unset($_from); ?>
		</tbody>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</table>