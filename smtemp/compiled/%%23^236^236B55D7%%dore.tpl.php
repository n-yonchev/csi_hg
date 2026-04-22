<?php /* Smarty version 2.6.9, created on 2020-03-13 11:00:35
         compiled from dore.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'dore.tpl', 2, false),array('modifier', 'date_format', 'dore.tpl', 26, false),array('modifier', 'replace', 'dore.tpl', 142, false),)), $this); ?>
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
				<td class='d_table_title' colspan='200'>Входящ регистър за <?php echo $this->_tpl_vars['abou']; ?>
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
				<td><span> дата </span></td>
				<td class='sep'>&nbsp;</td>
				<td><span> вх.номер</span></td>
				<td class='sep'>&nbsp;</td>
				<td><span> изп.дело</span></td>
				<td class='sep'>&nbsp;</td>
				<td><span> подател</span></td>
				<td class='sep'>&nbsp;</td>
				<td><span> описание</span></td>
				<td class='sep'>&nbsp;</td>
				<td><span> бележки</span></td>
		<td class='sep'>&nbsp;</td>
<td>образ
			</tr>
		<tbody>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
				<td valign=top> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</td>
				<td class='sep'>&nbsp;</td>
				<td valign=top> <?php echo $this->_tpl_vars['elem']['serial']; ?>

												</td>
				<td class='sep'>&nbsp;</td>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
							<td align="left" valign=top>
						<?php $_from = $this->_tpl_vars['elem']['caselist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cuca']):
?>
							<?php echo $this->_tpl_vars['cuca']; ?>
&nbsp;
						<?php endforeach; endif; unset($_from); ?>
							</td>
						<?php else: ?>
<td valign=top align=center>
	<?php if (empty ( $this->_tpl_vars['elem']['caselist'] )): ?>
&nbsp;
	<?php elseif (count ( $this->_tpl_vars['elem']['caselist'] ) == 1):  echo $this->_tpl_vars['elem']['caselist'][0]; ?>

	<?php else: ?>
<img src="images/view.png" title='<?php $_from = $this->_tpl_vars['elem']['caselist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cuca']):
 echo $this->_tpl_vars['cuca']; ?>
&nbsp;<?php endforeach; endif; unset($_from); ?>'>
	<?php endif; ?>
						<?php endif; ?>
				<td class='sep'>&nbsp;</td>
				<td valign=top> <?php echo $this->_tpl_vars['elem']['from']; ?>
</td>
				<td class='sep'>&nbsp;</td>
				<td valign=top> <?php echo $this->_tpl_vars['elem']['text']; ?>
</td>
				<td class='sep'>&nbsp;</td>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
							<td valign=top align=left>
							<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elem']['notes'])) ? $this->_run_mod_handler('replace', true, $_tmp, ";", "; ") : smarty_modifier_replace($_tmp, ";", "; ")))) ? $this->_run_mod_handler('replace', true, $_tmp, ",", ", ") : smarty_modifier_replace($_tmp, ",", ", ")); ?>

						<?php else: ?>
<td valign=top align=center>
	<?php if (empty ( $this->_tpl_vars['elem']['notes'] )): ?>
&nbsp;
	<?php else: ?>
<img src="images/view.png" title='<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elem']['notes'])) ? $this->_run_mod_handler('replace', true, $_tmp, ";", "; ") : smarty_modifier_replace($_tmp, ";", "; ")))) ? $this->_run_mod_handler('replace', true, $_tmp, ",", ", ") : smarty_modifier_replace($_tmp, ",", ", ")); ?>
'>
	<?php endif; ?>
						<?php endif; ?>
				<td class='sep'>&nbsp;</td>
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