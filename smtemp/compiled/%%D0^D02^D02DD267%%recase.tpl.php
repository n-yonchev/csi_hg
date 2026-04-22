<?php /* Smarty version 2.6.9, created on 2020-03-10 16:57:01
         compiled from recase.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'recase.tpl', 2, false),array('modifier', 'date_format', 'recase.tpl', 26, false),)), $this); ?>
<?php if ($this->_tpl_vars['FLPRIN']): ?>
	<?php $this->assign('txpage', ((is_array($_tmp="стр.")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['PAGENO']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['PAGENO'])));  else: ?>
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
<?php endif; ?>


				<?php if (isset ( $this->_tpl_vars['DATE']['date'] ) && $this->_tpl_vars['FLPRIN']): ?>
					<?php $this->assign('abou', ((is_array($_tmp=$this->_tpl_vars['DATE']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y"))); ?>
				<?php else: ?>
					<?php $this->assign('abou', ((is_array($_tmp=$this->_tpl_vars['YEAR'])) ? $this->_run_mod_handler('cat', true, $_tmp, " год.") : smarty_modifier_cat($_tmp, " год."))); ?>
				<?php endif; ?>
	<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
			<tr>
<td class='d_table_title' colspan='200'> Регистър на заведените дела за <?php echo $this->_tpl_vars['abou']; ?>
 <?php echo $this->_tpl_vars['txpage']; ?>
</td>
			</tr>
			<tr>
				<td class='d_table_button' colspan='200'>
				<?php if ($this->_tpl_vars['FLPRIN']): ?>
				<?php else: ?>
	<?php if (isset ( $this->_tpl_vars['DATE']['date'] )): ?>
		<?php if (empty ( $this->_tpl_vars['DATE']['date2'] )): ?>
за дата <b><?php echo ((is_array($_tmp=$this->_tpl_vars['DATE']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b>
&nbsp;
		<?php else: ?>
за периода от <b><?php echo ((is_array($_tmp=$this->_tpl_vars['DATE']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b> до <b><?php echo ((is_array($_tmp=$this->_tpl_vars['DATE']['date2'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b>
&nbsp;
		<?php endif; ?>
	<?php else: ?>
	<?php endif;  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => $this->_tpl_vars['DATE']['linkget'],'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => "период")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
&nbsp;
	<?php if (isset ( $this->_tpl_vars['DATE']['linkall'] )): ?>
<a href="<?php echo $this->_tpl_vars['DATE']['linkall']; ?>
">
<img src="images/all.gif" title='всички редове'>
</a>
&nbsp;
	<?php else: ?>
	<?php endif; ?>
&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('ONCLICK' => "fuprin('".($this->_tpl_vars['CURINT'])."');",'TITLE' => "<img src='css/blue/button/printer.gif' alt='' /> Принтирай")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>
				</td>
			</tr>
		</thead>
			<tr class='header'>	
<td> изп.дело </td>
				<td class='sep'>&nbsp;</td>
<td> молба образуване </td>
				<td class='sep'>&nbsp;</td>
<td> дело източник </td>
				<td class='sep'>&nbsp;</td>
												<?php if ($this->_tpl_vars['FLPRIN']): ?>
<td> име на ЧСИ </td>
				<td class='sep'>&nbsp;</td>
<td> № ЧСИ </td>
				<td class='sep'>&nbsp;</td>
												<?php else: ?>
												<?php endif; ?>
<td> взискател </td>
				<td class='sep'>&nbsp;</td>
<td> длъжник </td>
				<td class='sep'>&nbsp;</td>
<td> вид размер вземане </td>
				<td class='sep'>&nbsp;</td>
<td> произход вземане </td>
				<td class='sep'>&nbsp;</td>
<td> дата </td>
			</tr>
		<tbody>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<tr  onmouseover='this.className="trdocu";' onmouseout='this.className="";'>

<td valign=top> <?php echo $this->_tpl_vars['elem']['fullnumb']; ?>

				<td class='sep'>&nbsp;</td>
<td valign=top> 
	<?php if (empty ( $this->_tpl_vars['elem']['firstdocu']['seri'] )): ?>
&nbsp;
	<?php else:  echo $this->_tpl_vars['elem']['firstdocu']['seri']; ?>
/<?php echo $this->_tpl_vars['elem']['firstdocu']['year']; ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['firstdocu']['crea'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 
	<?php endif; ?>
</td>
				<td class='sep'>&nbsp;</td>
<td valign=top>
	<?php if (empty ( $this->_tpl_vars['elem']['conome'] ) && empty ( $this->_tpl_vars['elem']['coyear'] )): ?>
&nbsp;
	<?php else:  echo $this->_tpl_vars['ARSORT'][$this->_tpl_vars['elem']['idsort']]; ?>
 <?php echo $this->_tpl_vars['elem']['conome']; ?>
/<?php echo $this->_tpl_vars['elem']['coyear']; ?>
 
	<?php endif; ?>
	<?php if (empty ( $this->_tpl_vars['elem']['idcofrom'] )): ?>
&nbsp;
	<?php else:  echo $this->_tpl_vars['ARFROM'][$this->_tpl_vars['elem']['idcofrom']]; ?>

	<?php endif; ?>
				<td class='sep'>&nbsp;</td>
												<?php if ($this->_tpl_vars['FLPRIN']): ?>
<td valign=top> <?php echo $this->_tpl_vars['ROOFFI']['shortname']; ?>
</td>
				<td class='sep'>&nbsp;</td>
<td valign=top align=center> <?php echo $this->_tpl_vars['ROOFFI']['serial']; ?>
</td>
				<td class='sep'>&nbsp;</td>
												<?php else: ?>
												<?php endif; ?>
			<?php $this->assign('idcase', $this->_tpl_vars['elem']['id']); ?>
<td valign=top>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_recaseelem.tpl", 'smarty_include_vars' => array('DATALIST' => $this->_tpl_vars['DATACLAI'][$this->_tpl_vars['idcase']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<td class='sep'>&nbsp;</td>
<td valign=top>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_recaseelem.tpl", 'smarty_include_vars' => array('DATALIST' => $this->_tpl_vars['DATADEBT'][$this->_tpl_vars['idcase']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<td class='sep'>&nbsp;</td>
<td valign=top>
<?php echo $this->_tpl_vars['elem']['claimdescrip']; ?>

				<td class='sep'>&nbsp;</td>
<td valign=top>
<?php echo $this->_tpl_vars['ARCLAIORIG'][$this->_tpl_vars['elem']['idclaimorig']]; ?>

				<td class='sep'>&nbsp;</td>
<td valign=top>
	<?php if (empty ( $this->_tpl_vars['elem']['statdate'] )): ?>
&nbsp;
	<?php else: ?>
			<?php $this->assign('mystin', $this->_tpl_vars['elem']['statdate']['indx']); ?>
			<?php $this->assign('mystda', $this->_tpl_vars['elem']['statdate']['time']);  echo $this->_tpl_vars['TXTRANSTAT'][$this->_tpl_vars['mystin']]; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['mystda'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

	<?php endif; ?>

			</tr>
		<?php endforeach; endif; unset($_from); ?>
		</tbody>
	
	<?php if ($this->_tpl_vars['FLPRIN']): ?>
	<?php else:  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<iframe id="fraint" width=1 height=1 style="visibility:hidden"></iframe>
		<script>
		function fuprin(p1){
			var op= document.getElementById("fraint").src= p1;
		}
		</script>
	<?php endif; ?>
			</table>