<?php /* Smarty version 2.6.9, created on 2024-04-18 11:16:54
         compiled from outtem.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'outtem.tpl', 87, false),)), $this); ?>
<style>
.doso {background-color:khaki;cursor:pointer;}
</style>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
<td class='d_table_title' colspan='200'>списък на шаблоните за изходящи документи</td>
		</tr>
		<tr>
<td class='d_table_button' colspan='200'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td>
		</tr>
	</thead>
	<tr class='header'>
<td> описание </td>
		<td class='sep'>&nbsp;</td>
<td> адресат </td>
							<?php if ($this->_tpl_vars['ISREGITAX']): ?>
		<td class='sep'>&nbsp;</td>
<td> такса </td>
		<td class='sep'>&nbsp;</td>
<td> предмет </td>
							<?php else: ?>
							<?php endif; ?>
		<td class='sep'>&nbsp;</td>
<td> създаден </td>
		<td class='sep'>&nbsp;</td>
<td> файл </td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td align=center> акт </td>
		<td class='sep'>&nbsp;</td>
							<?php if ($this->_tpl_vars['ONLYCOUN'] == 0): ?>
								<?php $this->assign('mylink', $this->_tpl_vars['LINKONLY1']); ?>
							<?php else: ?>
								<?php $this->assign('mylink', $this->_tpl_vars['LINKONLY0']); ?>
							<?php endif; ?>
<td align=center> <span style="cursor:pointer;" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['mylink'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>&diams;</span>
брой<br>изх.док 
																<?php if ($this->_tpl_vars['ISPOST']): ?>
		<td class='sep'>&nbsp;</td>
<td align=center> връчване </td>
								<?php else: ?>
								<?php endif; ?>
		<td class='sep'>&nbsp;</td>
<td align=center> под<br>режд </td>
	</tr>
	<tbody>
<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
																<?php if ($this->_tpl_vars['ONLYCOUN'] <> 0 && $this->_tpl_vars['ARCOUN'][$this->_tpl_vars['elem']['id']] == 0): ?>
								<?php else: ?>
				<?php if ($this->_tpl_vars['elem']['ishidden'] == 0): ?>
					<?php $this->assign('mycl', ""); ?>
				<?php else: ?>
					<?php $this->assign('mycl', 'trdocu'); ?>
				<?php endif; ?>
	<tr class="<?php echo $this->_tpl_vars['mycl']; ?>
" onmouseover='this.className="tr_hover";' onmouseout='this.className="<?php echo $this->_tpl_vars['mycl']; ?>
";'>
<td> <?php echo $this->_tpl_vars['elem']['text']; ?>
</td>
		<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['adresat']; ?>
&nbsp;</td>
							<?php if ($this->_tpl_vars['ISREGITAX']): ?>
<font color=blue>
		<td class='sep'>&nbsp;</td>
<td><font color=blue> <?php echo $this->_tpl_vars['elem']['regitax']; ?>
 </font></td>
		<td class='sep'>&nbsp;</td>
<td><font color=blue> <?php echo $this->_tpl_vars['elem']['regitext']; ?>
 </font></td>
							<?php else: ?>
							<?php endif; ?>
		<td class='sep'>&nbsp;</td>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 &nbsp;
		<td class='sep'>&nbsp;</td>
<td title="<?php echo $this->_tpl_vars['elem']['filename']; ?>
" style="cursor:help;">
							<?php if ($this->_tpl_vars['elem']['suff'] == 'html'): ?>
<?php echo $this->_tpl_vars['elem']['suff']; ?>

							<?php else: ?>
<font color=red> <?php echo $this->_tpl_vars['elem']['suff']; ?>
 </font>
							<?php endif; ?>
		<td class='sep'>&nbsp;</td>
<td  align=center><a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай данните"></a></td>
		<td class='sep'>&nbsp;</td>
<td <?php if ($this->_tpl_vars['elem']['isassigned']): ?>class="issigreen"<?php endif; ?>  align=center><a href="<?php echo $this->_tpl_vars['elem']['issi']; ?>
" class="nyroModal" target="_blank" style="font-size: 9px">[ИССИ]</a></td>
		<td class='sep'>&nbsp;</td>
<td  align=center><a href="<?php echo $this->_tpl_vars['elem']['clon']; ?>
" class="nyroModal" target="_blank"><img src="images/clone.gif" title="клонирай шаблона"></a></td>
		<td class='sep'>&nbsp;</td>
							<?php if ($this->_tpl_vars['elem']['suff'] == 'html'): ?>
<td  align=left><a href="<?php echo $this->_tpl_vars['elem']['html']; ?>
" class="nyroModal" target="_blank"><img src="images/editcont.gif" title="корегирай съдържанието"></a></td>
							<?php else: ?>
<td  align=left>
<a href='file:///<?php echo $this->_tpl_vars['LETEDI']; ?>
:/<?php echo $this->_tpl_vars['elem']['filename']; ?>
' target='_blank'><img src='images/word.gif' title='Корегирай в WORD'></a>
<a href="<?php echo $this->_tpl_vars['elem']['uplo']; ?>
" class="nyroModal" target="_blank"><img src="images/get.gif" title="смени файла"></a>
</td>
							<?php endif; ?>
		<td class='sep'>&nbsp;</td>
				<?php if ($this->_tpl_vars['elem']['ishidden'] == 0): ?>
					<?php $this->assign('mytx', "да"); ?>
					<?php $this->assign('myti', "скрий"); ?>
					<?php $this->assign('mycl', $this->_tpl_vars['elem']['hidd']); ?>
				<?php else: ?>
					<?php $this->assign('mytx', "<font color=red>не</font>"); ?>
					<?php $this->assign('myti', "покажи"); ?>
					<?php $this->assign('mycl', $this->_tpl_vars['elem']['acti']); ?>
				<?php endif; ?>
<td align=center>
<span class="finahist" title="<?php echo $this->_tpl_vars['myti']; ?>
" onclick="document.location.href='<?php echo $this->_tpl_vars['mycl']; ?>
'; return false;">
<?php echo $this->_tpl_vars['mytx']; ?>
 </span>
</td>
		<td class='sep'>&nbsp;</td>
<td align=right> <?php echo $this->_tpl_vars['ARCOUN'][$this->_tpl_vars['elem']['id']]; ?>

								<?php if ($this->_tpl_vars['ISPOST']): ?>
		<td class='sep'>&nbsp;</td>
<td> 
<nobr>
<?php echo $this->_tpl_vars['ARPOSTTYPE_2'][$this->_tpl_vars['elem']['idposttype']]; ?>

										<?php if (empty ( $this->_tpl_vars['elem']['postadresat'] ) && empty ( $this->_tpl_vars['elem']['postaddress'] )): ?>
										<?php else: ?>
<img src="images/view.png" class="tpos" rel="#cpos<?php echo $this->_tpl_vars['elem']['id']; ?>
" title="информация за връчването" style="cursor:help;">
										<?php endif; ?>
								<?php else: ?>
								<?php endif; ?>
<span id="cpos<?php echo $this->_tpl_vars['elem']['id']; ?>
" style="display: none">
<table>
<tr>
<td> метод <td><b><?php echo $this->_tpl_vars['ARPOSTTYPE'][$this->_tpl_vars['elem']['idposttype']]; ?>
</b>
<tr>
<td> адресат <td><b><?php echo $this->_tpl_vars['elem']['postadresat']; ?>
</b>
<tr>
<td> адрес <td><b><?php echo $this->_tpl_vars['elem']['postaddress']; ?>
</b>
</table>
</span>
</nobr>
		<td class='sep'>&nbsp;</td>
<td align=center class="case" title="подреждане" 
onmouseover="$(this).addClass('doso');" onmouseout="$(this).removeClass('doso');"
onclick="$.nyroModalManual({url:'<?php echo $this->_tpl_vars['elem']['sort']; ?>
',forceType:'iframe'});"
> П
	</tr>
																<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
		</tbody>
	</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {
	$('.ttag').cluetip({ width: 260, local:true, cursor:'pointer' });
	$('.tpos').cluetip({ width: 360, local:true, cursor:'pointer' });
});
</script>