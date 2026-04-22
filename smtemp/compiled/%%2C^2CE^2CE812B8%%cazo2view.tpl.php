<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:44
         compiled from cazo2view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'cazo2view.tpl', 77, false),array('modifier', 'tomoney2', 'cazo2view.tpl', 101, false),array('modifier', 'date_format', 'cazo2view.tpl', 119, false),array('modifier', 'replace', 'cazo2view.tpl', 184, false),array('function', 'math', 'cazo2view.tpl', 205, false),)), $this); ?>
<style>
.inte2 {background-color:beige;}
.sut0 {cursor:help;font:bold 8pt verdana;border: 1px solid red;color:red;}
.sut3 {cursor:help;font:bold 8pt verdana;background-color:silver;}
.sut6 {cursor:help;font:bold 8pt verdana;background-color:lightgreen !important;}
.sut9 {cursor:help;font:bold 8pt verdana;background-color:lightsalmon !important;}
</style>
					<?php $this->assign('mark0', "class='sut0' title='[T]'"); ?>
					<?php $this->assign('mark3', "class='sut3' title='[T]'"); ?>
					<?php $this->assign('mark6', "class='sut6' title='[T]&#xA;участва в изчисляване на лимита'"); ?>
					<?php $this->assign('mark9', "class='sut9' title='[T]&#xA;НЕ участва в изчисляване на лимита'"); ?>
<table class="d_table" cellspacing='0' cellpadding='0' <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoplan.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
	<thead>
		<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">
<div style="float:left">
предмет на изпълнение
&nbsp;&nbsp;&nbsp;
<a href="#" onclick="$('#t2link').click();return false;" title="обнови"><img src="images/refresh.gif"></a>
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
			<td><span> описание </span></td>
			<td class='sep'>&nbsp;</td>
<td> т.26 </td>
			<td class='sep'>&nbsp;</td>
			<td><span> тип</span></td>
			<td class='sep'>&nbsp;</td>	
<td align=right> сума
			<td class='sep'>&nbsp;</td>
			<td><span> от дата</span></td>
			<td class='sep'>&nbsp;</td>	
			<td><span> взискател</span></td>
			<td class='sep'>&nbsp;</td>
<td> длъж
		<?php if ($this->_tpl_vars['FLAGNOCHANGE']): ?>
		<?php else: ?>
			<td class='sep'>&nbsp;</td>	
			<td><span> &nbsp;</span></td>
		<?php endif; ?>
			<td class='sep'>&nbsp;</td>
<td align=center> 
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
<td> <?php echo $this->_tpl_vars['elem']['text']; ?>
 </td>
			<td class='sep'>&nbsp;</td>
<td align=center> <?php if ($this->_tpl_vars['elem']['isintax']): ?>да<?php else: ?>-<?php endif; ?> </td>
			<td class='sep'>&nbsp;</td>
				<?php $this->assign('arindx', $this->_tpl_vars['elem']['idtype']); ?>
			<td> <?php echo $this->_tpl_vars['ARTYPE'][$this->_tpl_vars['arindx']];  echo $this->_tpl_vars['txsubtype']; ?>
</td>
			<td class='sep'>&nbsp;</td>
			<td align=right> 
							<?php if ($this->_tpl_vars['elem']['idtype'] == 3 || $this->_tpl_vars['elem']['idtype'] == 5): ?>
<nobr>мес <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['amount'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</nobr>
<br>
<nobr>общо <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['capital'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</nobr>
							<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['elem']['amount'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

							<?php endif; ?>
			<td class='sep'>&nbsp;</td>	
							<?php if ($this->_tpl_vars['elem']['idtype'] == 1 && empty ( $this->_tpl_vars['elem']['fromdate'] )): ?>
<td> <font color=red>без-олихв</font> </td>
							<?php else: ?>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['fromdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

							<?php endif; ?>
							<?php if ($this->_tpl_vars['elem']['idtype'] == 3 && ! empty ( $this->_tpl_vars['elem']['todate'] )): ?>
<br> 
<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['todate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

							<?php else: ?>
							<?php endif; ?>
			<td class='sep'>&nbsp;</td>
				<?php $this->assign('arindx', $this->_tpl_vars['elem']['idclaimer']); ?>
			<td> <?php echo $this->_tpl_vars['ARCLAI'][$this->_tpl_vars['arindx']]; ?>
</td>
			<td class='sep'>&nbsp;</td>
<td align=center class="ttip inte2" rel="#de<?php echo $this->_tpl_vars['ekey']; ?>
" title="длъжници" style="cursor:help;"> <?php echo $this->_tpl_vars['elem']['counde']; ?>

<span id="de<?php echo $this->_tpl_vars['ekey']; ?>
" style="display: none">
				<?php $_from = $this->_tpl_vars['elem']['listde']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['iddebt'] => $this->_tpl_vars['elemdebt']):
?>
					<?php echo $this->_tpl_vars['ARDEBT'][$this->_tpl_vars['elemdebt']]; ?>
<br/>
				<?php endforeach; endif; unset($_from); ?>
</span>
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
			</td>
		<?php endif; ?>
<td class='sep'>&nbsp;</td>
				<?php $this->assign('type2', $this->_tpl_vars['ARSU4T'][$this->_tpl_vars['elem']['idt2']]); ?>
				<?php $this->assign('text2', $this->_tpl_vars['ARSU2TYPE'][$this->_tpl_vars['elem']['idt2']]); ?>
				<?php if ($this->_tpl_vars['type2'] == 0): ?>
<td <?php echo ((is_array($_tmp=$this->_tpl_vars['mark0'])) ? $this->_run_mod_handler('replace', true, $_tmp, "[T]", $this->_tpl_vars['text2']) : smarty_modifier_replace($_tmp, "[T]", $this->_tpl_vars['text2'])); ?>
> ?
				<?php elseif ($this->_tpl_vars['type2'] == 3): ?>
<td <?php echo ((is_array($_tmp=$this->_tpl_vars['mark3'])) ? $this->_run_mod_handler('replace', true, $_tmp, "[T]", $this->_tpl_vars['text2']) : smarty_modifier_replace($_tmp, "[T]", $this->_tpl_vars['text2'])); ?>
> з
				<?php elseif ($this->_tpl_vars['type2'] == 6): ?>
<td <?php echo ((is_array($_tmp=$this->_tpl_vars['mark6'])) ? $this->_run_mod_handler('replace', true, $_tmp, "[T]", $this->_tpl_vars['text2']) : smarty_modifier_replace($_tmp, "[T]", $this->_tpl_vars['text2'])); ?>
> у
				<?php elseif ($this->_tpl_vars['type2'] == 9): ?>
<td <?php echo ((is_array($_tmp=$this->_tpl_vars['mark9'])) ? $this->_run_mod_handler('replace', true, $_tmp, "[T]", $this->_tpl_vars['text2']) : smarty_modifier_replace($_tmp, "[T]", $this->_tpl_vars['text2'])); ?>
> н
				<?php else: ?>
<td> ??????????
				<?php endif; ?>
		</tr>
	<?php if ($this->_tpl_vars['elem']['interest']+0 == 0): ?>
	<?php else: ?>
<tr>
<td class="inte2" colspan=5> лихва <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['amount'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
 период <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['fromdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['CURRDATE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td>
<td class="inte2" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['interest'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

	<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

			<?php echo smarty_function_math(array('equation' => "a*b",'a' => 0.3,'b' => $this->_tpl_vars['RECATOT'],'assign' => 'reca30'), $this);?>


<tr>
<td colspan=50>
		<table align=right>
<tr>
<td align=right class="recapitulation" width=90> <b>общо дълг</b>
<td align=right class="recapitulation" width=90> <b>дълг за т.26</b>
<td align=right class="recapitulation" width=90> <b>такса по т.26 вкл.ДДС</b>
<td align=right class="recapitulation" width=90> <b>общо дължима сума</b>
<td align=right class="recapitulation" width=90> <b>20 % от общо дълж.сума</b>
<tr>
<td align=right> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['RECASUM'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b>
<td align=right> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['RECAT26'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b>
<td align=right> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['RECATAX'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b>
<td align=right> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['RECATOT'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b>
			<?php echo smarty_function_math(array('equation' => "a*b",'a' => 0.2,'b' => $this->_tpl_vars['RECATOT'],'assign' => 'reca20'), $this);?>

<td align=right> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['reca20'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b>
		</table>

<tr>
<td colspan=50>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazo2x2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</tbody>
</table>


<script type="text/javascript">
	$('a.nyroModal').nyroModal();
</script>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {
	$('.ttip').cluetip({ width: 300, local:true, cursor:'pointer' });
	<?php if (isset ( $this->_tpl_vars['FORCLINK'] )): ?>
////////////////////////////$.nyroModalManual({forceType:'iframe', url:'caseeditzone.php<?php echo $this->_tpl_vars['FORCLINK']; ?>
'});
	<?php else: ?>
	<?php endif; ?>
});
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_frame.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


