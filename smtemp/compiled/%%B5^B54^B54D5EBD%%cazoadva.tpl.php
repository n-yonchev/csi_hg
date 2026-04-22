<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazoadva.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney2', 'cazoadva.tpl', 60, false),array('modifier', 'date_format', 'cazoadva.tpl', 62, false),)), $this); ?>
<script type="text/javascript">
	$($.fn.nyroModal.settings.openSelector).nyroModal();	
</script>

<table class="d_table" cellspacing='0' cellpadding='0' <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoplan.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
		<thead>
		<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">
		<div style="float:left" oncontextmenu="$('#tadvalink').click();return false;">
вноски по аванс.такси
</div>
			<?php if ($this->_tpl_vars['FLAGNOCHANGE'] && ! $this->_tpl_vars['FINALOGGED']): ?>
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
<td>сума</td>
		<td class='sep'>&nbsp;</td>
<td>дата</td>
		<td class='sep'>&nbsp;</td>	
<td>тип
		<td class='sep'>&nbsp;</td>	
<td>взискател</td>
		<td class='sep'>&nbsp;</td>	
<td>&nbsp;</td>
				<?php if ($this->_tpl_vars['FLAGNOCHANGE'] && ! $this->_tpl_vars['FINALOGGED']): ?>
				<?php else: ?>
<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
				<?php endif; ?>
		</tr>
		<tbody>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<tr  onmouseover='this.className="trhove";' onmouseout='this.className="";'>
<td align="right"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['amount'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
 </td>
		<td class='sep'>&nbsp;</td>
<td align="left"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 </td>
		<td class='sep'>&nbsp;</td>
					<?php if ($this->_tpl_vars['elem']['iscash'] == 1): ?>
						<?php $this->assign('mytype', 1); ?>
					<?php else: ?>
						<?php $this->assign('mytype', 2); ?>
					<?php endif; ?>
<td align="left"> <?php echo $this->_tpl_vars['ARPATYPE'][$this->_tpl_vars['mytype']]; ?>

		<td class='sep'>&nbsp;</td>
<td align="left"> <?php echo $this->_tpl_vars['elem']['clainame']; ?>

		<td class='sep'>&nbsp;</td>
<td align="left"> 
				<?php if (empty ( $this->_tpl_vars['elem']['descrip'] )): ?>
				<?php else: ?>
<img src="images/view.png" title='<?php echo $this->_tpl_vars['elem']['descrip']; ?>
' style="cursor:help">
				<?php endif; ?>
</td>
				<?php if ($this->_tpl_vars['FLAGNOCHANGE'] && ! $this->_tpl_vars['FINALOGGED']): ?>
				<?php else: ?>
		<td class='sep'>&nbsp;</td>
<td align="left">
<nobr>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['editadva']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['deleadva']; ?>
" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
					<?php if ($this->_tpl_vars['elem']['iscash'] == 1): ?>
<a href="#" onclick="fuprin('<?php echo $this->_tpl_vars['elem']['prinadva']; ?>
');return false;"><img src="images/print.gif" title="отпечати ПКО"></a>
					<?php else: ?>
					<?php endif; ?>
</nobr>
</td>
				<?php endif; ?>
		</tr>			
		<?php endforeach; endif; unset($_from); ?>
		</tbody>
</table>

				<table class="d_table" width=100%>
		<tr>
<td class="recapitulation"> общо по взискатели
<td class="recapitulation" align=right> дъл<br>жими
<td class="recapitulation" align=right> вне<br>сени
<td class="recapitulation" align=right> невне<br>сени
		<?php $_from = $this->_tpl_vars['ARCLAI']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['claiid'] => $this->_tpl_vars['clainame']):
?>
		<tr>
<td> <?php echo $this->_tpl_vars['clainame']; ?>

<td align=right> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['ARSUM1'][$this->_tpl_vars['claiid']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=right> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['ARSUM2'][$this->_tpl_vars['claiid']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=right> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['ARSUM3'][$this->_tpl_vars['claiid']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>
		<tr class="recapitulation">
<td> общо
<td align=right> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['ARSUMA'][1])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=right> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['ARSUMA'][2])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=right> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['ARSUMA'][3])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php if ($this->_tpl_vars['ARSUMA'][3] < 0): ?>
		<tr class="red7bg">
<td colspan=10> 
ВНИМАНИЕ.
Внесените аванс.такси надвишават дължимите.
Добави още такси към предмета на изпълнение.
						<?php else: ?>
						<?php endif; ?>
		<tr class="recapitulation">
<td colspan=2> изработени по делото
<span class="info2" rel="#listinfo2" title="списък изработени документи" style="cursor:help"> 
<img src="images/view.png"> </span>
<td align=right> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['SU1'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<tr class="recapitulation">
<td colspan=2> невнесени от изработените
<td align=right> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['SU2'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<span id="listinfo2" style="display: none">
		<table class="caseperc">
<th> тип изх.документ
<th> броя
<th> такса
<th align=right> сума
<?php $_from = $this->_tpl_vars['DATA2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<tr>
<td> <?php echo $this->_tpl_vars['elem']['typetext']; ?>

<td align=right> <?php echo $this->_tpl_vars['elem']['coun']; ?>

<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['regitax'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['suma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

<?php endforeach; endif; unset($_from); ?>
		</table>
</span>
<script type="text/javascript">
$(document).ready(function() {
$('.info2').cluetip({
//	cluetipClass: 'rounded', 
		local: true,
	arrows: true, 
	width: 400,
	sticky: true,
	mouseOutClose: true,
	closeText: '<b>x</b>',
	closePosition: 'title'
	});
});
</script>