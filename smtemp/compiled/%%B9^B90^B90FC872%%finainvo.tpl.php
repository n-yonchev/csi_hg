<?php /* Smarty version 2.6.9, created on 2026-01-04 14:45:32
         compiled from finainvo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'finainvo.tpl', 279, false),array('modifier', 'tomo3', 'finainvo.tpl', 300, false),)), $this); ?>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<style>
.head {font: bold 7pt verdana; background-color:#bbbbbb;}
.cell {font: bold 7pt verdana; background-color:#dddddd;}
.c1link {font: normal 8pt verdana; background-color:wheat; padding: 2px 8px; cursor:pointer;}
.zero {font: normal 8pt verdana; background-color:#ff9999; padding: 2px 8px;}
.mark {font: normal 8pt verdana; background-color:red;color:white; padding: 2px 8px;}
.p1 {font: normal 8pt verdana;}
.p1:hover {color:red;border-bottom: 1px solid red;}
.suma {background-color:#d5e2f2;color:red;}
.dateinvo {font:normal 7pt verdana;border:0px solid black; color:black;}
</style>
<script>
var linklist= new Array();
</script>
<style>
.h2 {font: normal 8pt verdana; background-color:#bbbbbb;}
.r2 {font: normal 8pt verdana; border-bottom:1px solid black;}
</style>

						<?php if ($this->_tpl_vars['ISYEARLIST']): ?>
<div class='tabs_line' >
	<table class='tabs' cellspacing='0' cellpadding='0' border='0' >
	<tr>
	<?php $_from = $this->_tpl_vars['YEARLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<td class='tabs_sep'>&nbsp;</td>
		<?php if ($this->_tpl_vars['YEAR'] == $this->_tpl_vars['ekey']): ?>
			<td class='tabs_left_selected'></td>
			<td class='tabs_middle_selected'>
				<span <?php if ($this->_tpl_vars['EURO_FIRST_YEAR'] >= $this->_tpl_vars['ekey']): ?> style="color: purple; font-style: italic;" <?php endif; ?>>
					<?php echo $this->_tpl_vars['ekey']; ?>

				</span>
			</td>
			<td class='tabs_right_selected'></td>
		<?php else: ?>	
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_left'></td>
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_middle'>
				<span <?php if ($this->_tpl_vars['EURO_FIRST_YEAR'] >= $this->_tpl_vars['ekey']): ?> style="color: purple; font-style: italic;" <?php endif; ?>>
					<?php echo $this->_tpl_vars['ekey']; ?>

				</span>
			</td>
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_right'></td>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</tr>
	</table>
</div>
						<?php else: ?>
						<?php endif; ?>

<?php if ($this->_tpl_vars['EURO_FIRST_YEAR'] >= $this->_tpl_vars['YEAR']): ?>
		<table align=center>
		<tr><td style="font:normal 8pt verdana;color:red;">
	<td style="background-color: red; color: white; font-weight: bold; font-size: 14px; padding: 5px">
		ВНИМАНИЕ.
		<br>
		Сумите по фактурите от тази година са в лева.
<td style="font:normal 8pt verdana;color:red;">
		</table>
<?php endif; ?>

				<?php if (isset ( $this->_tpl_vars['CLAILIST'] )): ?>
					<table align=center>
					<tr>
					<td valign=top>
						<table>
						<tr>
<td class="h2" colspan=6 align=center> взискатели <?php echo $this->_tpl_vars['TEXTHEAD']; ?>

&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $this->_tpl_vars['CLAICREA']; ?>
" class='nyroModal' target='_blank'>
<img src="images/adda.gif" title='добави'}><a>
						<tr>
<td class="h2"> ЕИК
<td class="h2"> ЕГН
<td class="h2"> име
<td class="h2"> &nbsp;
				<?php $_from = $this->_tpl_vars['CLAILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
						<tr>
<td class="r2"> <?php echo $this->_tpl_vars['elem']['bulstat']; ?>
&nbsp;
<td class="r2"> <?php echo $this->_tpl_vars['elem']['egn']; ?>
&nbsp;
<td class="r2"> <?php echo $this->_tpl_vars['elem']['name']; ?>
&nbsp;
<td class="r2"> 
<a href="<?php echo $this->_tpl_vars['elem']['claimodi']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
				<?php endforeach; endif; unset($_from); ?>
						</table>
					<td valign=top>
						<table>
						<tr>
<td class="h2" colspan=6 align=center> длъжници <?php echo $this->_tpl_vars['TEXTHEAD']; ?>

&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $this->_tpl_vars['DEBTCREA']; ?>
" class='nyroModal' target='_blank'>
<img src="images/adda.gif" title='добави'}><a>
						<tr>
<td class="h2"> ЕИК
<td class="h2"> ЕГН
<td class="h2"> име
<td class="h2"> &nbsp;
				<?php $_from = $this->_tpl_vars['DEBTLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
						<tr>
<td class="r2"> <?php echo $this->_tpl_vars['elem']['bulstat']; ?>
&nbsp;
<td class="r2"> <?php echo $this->_tpl_vars['elem']['egn']; ?>
&nbsp;
<td class="r2"> <?php echo $this->_tpl_vars['elem']['name']; ?>
&nbsp;
<td class="r2"> 
<a href="<?php echo $this->_tpl_vars['elem']['debtmodi']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
				<?php endforeach; endif; unset($_from); ?>
						</table>
					</table>
				<?php else: ?>
				<?php endif; ?>

		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='40'>
<div style="float:left;">
списък на фактурите/сметките <?php echo $this->_tpl_vars['TEXTHEAD']; ?>

&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="images/word.gif" title="изведи целия списък" style="cursor:pointer"
				onclick="fuprin2('<?php echo $this->_tpl_vars['WORDLINK']; ?>
'); return false;">
&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="images/excel.gif" title="изведи целия списък" style="cursor:pointer"
				onclick="fuprin2('<?php echo $this->_tpl_vars['EXCELINK']; ?>
'); return false;">
																	<?php if (isset ( $this->_tpl_vars['YEMO'] )): ?>
															<?php else: ?>
<br>
<div class="dateinvo" style="float:left;padding-left:70px;">
	въведи дата или период от-до
	<input type=text name="dateinvo" id="dateinvo" size=26  class="dateinvo" onkeyup="autosubminvo(event,this);"> +enter
	<span id="error" style="color:red"></span>
	&nbsp;&nbsp;&nbsp;
	въведи дело/год
	<input type=text name="seyeinvo" id="seyeinvo" size=14  class="dateinvo" onkeyup="autosubm2(event,this);"> +enter
	<span id="err2" style="color:red"></span>
	&nbsp;&nbsp;&nbsp;
<br>
	въведи получател
	<input type=text name="nameinvo" id="nameinvo" size=14  class="dateinvo" onkeyup="autosubm3(event,this);"> +enter
	<span id="err3" style="color:red"></span>
	избери тип
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARINVO3SELE'],'ID' => 'idinvotype','C1' => 'input7','C2' => 'inputer','ONCH' => "autosubm4(event,this);")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> +enter
</div>
															<?php endif; ?>
</div>
						<?php if ($this->_tpl_vars['ISADDCASE']): ?>
<div style="float:right;">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEWBILL']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<span style="font:normal 7pt verdana; color:black;">
	<br> фактура/сметка
	<br> за делото
	</span>
</div>
						<?php else: ?>
<div style="float:right;">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<span style="font:normal 7pt verdana; color:black;">
	<br> фактура без сметка
	<br> и несвързана с дело
	</span>
</div>
						<?php endif; ?>
		</thead>
		<tr class='header'>
<td> #факт
		<td class='sep'>&nbsp;</td>	
<td> дата
		<td class='sep'>&nbsp;</td>	
<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" onclick="fupringrou(); return false;"> 
<img src="images/print.gif" title="отпечати маркираните фактури">
</a>
		<td class='sep'>&nbsp;</td>	
<td> сума
		<td class='sep'>&nbsp;</td>	
<td> втч<br>ДДС
		<td class='sep'>&nbsp;</td>	
<td> получател
		<td class='sep'>&nbsp;</td>	
<td> платено
		<td class='sep'>&nbsp;</td>	
<td> метод
		<td class='sep'>&nbsp;</td>	
<td> тип
		<td class='sep'>&nbsp;</td>	
<td> #про<br>форма
		<td class='sep'>&nbsp;</td>	
<td> длъж
		<td class='sep'>&nbsp;</td>	
<td> IBAN
		<td class='sep'>&nbsp;</td>	
<td> #смет
		<td class='sep'>&nbsp;</td>	
<td> дата
		<td class='sep'>&nbsp;</td>	
<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" onclick="fupringroubill(); return false;"> 
<img src="images/print.gif" title="отпечати маркираните сметки">
</a>
		<td class='sep'>&nbsp;</td>	
<td> дело
		<td class='sep'>&nbsp;</td>	
<td> деловодител
		<td class='sep'>&nbsp;</td>	
<td> взи<br>скат
		<td class='sep'>&nbsp;</td>	
<td> &nbsp;

<tbody>
<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
								<?php $this->assign('myinvo', $this->_tpl_vars['elem']['id']); ?>
										<?php if (isset ( $this->_tpl_vars['elem']['diff'] )): ?>
											<?php if ($this->_tpl_vars['ISNODIFF']): ?>
											<?php else: ?>
		<tr>
<td colspan=40> <font color=red> <?php echo $this->_tpl_vars['elem']['diff']; ?>
 незаети номера </font>
											<?php endif; ?>
										<?php elseif (isset ( $this->_tpl_vars['elem']['diffyear'] )): ?>
											<?php if ($this->_tpl_vars['ISNODIFF']): ?>
											<?php else: ?>
		<tr>
<td colspan=40> <font color=red> <?php echo $this->_tpl_vars['elem']['diffyear']; ?>
 номера заети с дати от друга година </font>
											<?php endif; ?>
										<?php elseif (isset ( $this->_tpl_vars['elem']['diffdate'] )): ?>
											<?php if ($this->_tpl_vars['ISNODIFF']): ?>
											<?php else: ?>
		<tr>
<td colspan=40> <font color=red> <?php echo $this->_tpl_vars['elem']['diffdate']; ?>
 номера заети с дати извън периода </font>
											<?php endif; ?>
										<?php else: ?>
				<tr>
<td class="c1link" align="right" onclick="$.nyroModalManual({forceType:'iframe', url:'<?php echo $this->_tpl_vars['elem']['seriinvoedit']; ?>
'});"
title="корегирай номер фактура" > <?php if ($this->_tpl_vars['elem']['seriinvo'] <= 0): ?>&nbsp;<?php else:  echo $this->_tpl_vars['elem']['seriinvo'];  endif; ?>
		<td class='sep'>&nbsp;</td>	
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['dateinvo'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

		<td class='sep'>&nbsp;</td>	
<td> 
						<?php if ($this->_tpl_vars['elem']['seriinvo'] <= 0): ?>
&nbsp;
						<?php else: ?>
<nobr>
<a href="#" onclick="fuprin2('<?php echo $this->_tpl_vars['elem']['prin']; ?>
'); return false;"> 
<img src="images/print.gif" title="отпечати фактура">
</a>
<input type=checkbox id="<?php echo $this->_tpl_vars['elem']['prntcode']; ?>
">
</nobr>
						<?php endif; ?>

		<td class='sep'>&nbsp;</td>	
					<?php if ($this->_tpl_vars['elem']['suma'] == 0): ?>
<td id="suma<?php echo $this->_tpl_vars['myinvo']; ?>
" align=right class="zero"> нула
					<?php else: ?>
<td id="suma<?php echo $this->_tpl_vars['myinvo']; ?>
" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['suma'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

					<?php endif; ?>
		<td class='sep'>&nbsp;</td>	
<td id="svat<?php echo $this->_tpl_vars['myinvo']; ?>
" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['svat'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

		<td class='sep'>&nbsp;</td>	
<td> <?php echo $this->_tpl_vars['elem']['name']; ?>

		<td class='sep'>&nbsp;</td>	
<td align=right class="<?php if ($this->_tpl_vars['elem']['paid'] > $this->_tpl_vars['elem']['suma']): ?>zero<?php elseif ($this->_tpl_vars['elem']['paid'] < $this->_tpl_vars['elem']['suma']): ?>mark<?php else:  endif; ?>"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['paid'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

		<td class='sep'>&nbsp;</td>	
<td> 
				<?php if ($this->_tpl_vars['elem']['paidmethod'] == 'c'): ?>
<font color=blue><?php echo $this->_tpl_vars['ARMETH'][$this->_tpl_vars['elem']['paidmethod']]; ?>
 на 
<?php if (empty ( $this->_tpl_vars['elem']['cashname'] )): ?><span style="background-color:red;color:white;">????????</span><?php else:  endif; ?>
<?php echo $this->_tpl_vars['elem']['cashname']; ?>
</font>
				<?php else: ?>
<?php echo $this->_tpl_vars['ARMETH'][$this->_tpl_vars['elem']['paidmethod']]; ?>

				<?php endif; ?>
		<td class='sep'>&nbsp;</td>	
<td> <?php echo $this->_tpl_vars['ARINVOTYPE'][$this->_tpl_vars['elem']['idinvotype']]; ?>

												<?php if ($this->_tpl_vars['elem']['idinvotype'] == 2): ?>
<br>
към фактура 
				<?php if (empty ( $this->_tpl_vars['elem']['credmess'] )): ?>
					<?php $this->assign('cmtext', "??????"); ?>
					<?php $this->assign('cmclas', 'mark'); ?>
				<?php else: ?>
					<?php $this->assign('cmtext', $this->_tpl_vars['elem']['credmess']); ?>
					<?php $this->assign('cmclas', 'c1link'); ?>
				<?php endif; ?>
<br>
<span class="<?php echo $this->_tpl_vars['cmclas']; ?>
" style="cursor:pointer;" title="корегирай фактурата" 
onclick="$.nyroModalManual({forceType:'iframe', url:'<?php echo $this->_tpl_vars['elem']['editcredmess']; ?>
'});">
<?php echo $this->_tpl_vars['cmtext']; ?>
</span>
						<?php else: ?>
						<?php endif; ?>
		<td class='sep'>&nbsp;</td>	
<td> 
<nobr>
<?php echo $this->_tpl_vars['elem']['seriprof']; ?>

			<?php if ($this->_tpl_vars['elem']['seriprof'] == 0 || $this->_tpl_vars['elem']['idinvotype'] <> 1): ?>
			<?php else: ?>
<a href="<?php echo $this->_tpl_vars['elem']['proftonorm']; ?>
" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="трансформирай във фактура"></a>
			<?php endif; ?>
</nobr>
		<td class='sep'>&nbsp;</td>	
<td align=center> <?php if ($this->_tpl_vars['elem']['isdebtor'] == 0): ?>&nbsp;<?php else: ?>да<?php endif; ?>
		<td class='sep'>&nbsp;</td>	
<td title="<?php echo $this->_tpl_vars['ARACCO'][$this->_tpl_vars['elem']['iban']]; ?>
"> <?php echo $this->_tpl_vars['elem']['iban']; ?>

					<?php if ($this->_tpl_vars['elem']['serial'] == 0): ?>
		<td class='sep'>&nbsp;</td>	
<td colspan=7> 
<nobr>
<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай фактурата"></a>
<a href="#" onclick="dele6('<?php echo $this->_tpl_vars['elem']['id']; ?>
'  ,'<?php if ($this->_tpl_vars['elem']['suma']+0 == 0): ?>0.00<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['elem']['suma'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp));  endif; ?>','<?php echo $this->_tpl_vars['elem']['coun']; ?>
'); return false;">
<img src="images/free.gif" title="изтрий фактурата"></a>
<span id="coun<?php echo $this->_tpl_vars['myinvo']; ?>
" align=right class="c1link" onclick="toggle('<?php echo $this->_tpl_vars['myinvo']; ?>
');"> <?php if ($this->_tpl_vars['elem']['coun'] == 0): ?>няма редове<?php else:  echo $this->_tpl_vars['elem']['coun']; ?>
 реда<?php endif; ?>
</span>
</nobr>
<script>
linklist['<?php echo $this->_tpl_vars['myinvo']; ?>
']= "<?php echo $this->_tpl_vars['elem']['view']; ?>
";
</script>
					<?php else: ?>
		<td class='sep'>&nbsp;</td>	
<td class="c1link" align="right" onclick="$.nyroModalManual({forceType:'iframe', url:'<?php echo $this->_tpl_vars['elem']['seribilledit']; ?>
'});"
title="корегирай номер сметка" > <?php if ($this->_tpl_vars['elem']['seribill'] <= 0): ?>&nbsp;<?php else:  echo $this->_tpl_vars['elem']['seribill'];  endif; ?>
		<td class='sep'>&nbsp;</td>	
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

		<td class='sep'>&nbsp;</td>	
<td> 
				<?php if ($this->_tpl_vars['elem']['name'] == ""): ?>
&nbsp;
				<?php else: ?>
						<?php if ($this->_tpl_vars['elem']['seribill'] <= 0): ?>
&nbsp;
						<?php else: ?>
<nobr>
<a href="#" onclick="fuprin2('<?php echo $this->_tpl_vars['elem']['prinbill']; ?>
'); return false;"> 
<img src="images/print.gif" title="отпечати сметка">
</a>
<input type=checkbox id="<?php echo $this->_tpl_vars['elem']['prntcodebill']; ?>
">
</nobr>
						<?php endif; ?>
				<?php endif; ?>
		<td class='sep'>&nbsp;</td>	
<td> 
				<?php if ($this->_tpl_vars['elem']['idcase'] == 0): ?>
&nbsp;
				<?php else: ?>
<?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>

				<?php endif; ?>
		<td class='sep'>&nbsp;</td>	
<td> 
<?php echo $this->_tpl_vars['elem']['username']; ?>

		<td class='sep'>&nbsp;</td>	
						<?php $this->assign('myid', $this->_tpl_vars['elem']['id']); ?>
<td align=center class="ttip" rel="#clai<?php echo $this->_tpl_vars['myid']; ?>
" title="взискатели" style="cursor:help;"> 
<span style="background-color:#dddddd;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span id="clai<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
<?php $_from = $this->_tpl_vars['ARCLAI'][$this->_tpl_vars['elem']['idcase']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['clainame']):
?>
	<?php echo $this->_tpl_vars['clainame']; ?>
<br>
<?php endforeach; endif; unset($_from); ?>
</span>
					<?php endif; ?>

		<td class='sep'>&nbsp;</td>	
<td> 
					<?php if ($this->_tpl_vars['elem']['serial'] == 0 || $this->_tpl_vars['elem']['name'] == ""): ?>
					<?php else: ?>
<nobr>
<a href="<?php echo $this->_tpl_vars['elem']['modibill']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай фактурата/сметката"></a>
<a href="#" onclick="dele6('<?php echo $this->_tpl_vars['elem']['id']; ?>
'  ,'<?php if ($this->_tpl_vars['elem']['suma']+0 == 0): ?>0.00<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['elem']['suma'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp));  endif; ?>','<?php echo $this->_tpl_vars['elem']['coun']; ?>
'); return false;">
<img src="images/free.gif" title="изтрий фактурата/сметката"></a>
</nobr>
					<?php endif; ?>
		<tr id='tr<?php echo $this->_tpl_vars['myinvo']; ?>
' style="display:none">
<td id='td<?php echo $this->_tpl_vars['myinvo']; ?>
' colspan=40 align=left bgcolor="">
</td>
																				<?php endif; ?>
		</tr>
<?php endforeach; endif; unset($_from); ?>

		<tr class="suma">
<td colspan=5> общо за целия списък
		<td class='sep'>&nbsp;</td>	
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['ARSUYEAR']['suma'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

		<td class='sep'>&nbsp;</td>	
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['ARSUYEAR']['svat'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

		<td class='sep'>&nbsp;</td>	
<td colspan=30> &nbsp;

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</table>


<iframe id="idprin2" width=1 height=1 frameborder=0 style="display:block"></iframe>
<script>
function fuprin2(p1){
	document.getElementById("idprin2").focus();
	document.getElementById("idprin2").src= p1;
}
</script>



<script type="text/javascript">
$(document).ready(function() {
	$('.ttip').cluetip({ width: 260, local:true, cursor:'pointer' });
});
function toggle(pid){
//alert(pid);
	var trobje= document.getElementById("tr"+pid);
	var tdobje= document.getElementById("td"+pid);
	var curdis= (trobje.style.display=="");
	if (curdis){
		trobje.style.display= "none";
		$(tdobje).html("");
	}else{
		trobje.style.display= "";
		refresh(pid);
	}
}
function refresh(pid){
	var tdobje= document.getElementById("td"+pid);
	var mylink= linklist[pid];
	$(tdobje).html("<img src='ajaxload.gif'>");
	$(tdobje).load(mylink);
}
function refrow(pid){
	jQuery.ajax({
		url: "finainvorefr.ajax.php?p="+pid
		,success: succ4
		});
}
function succ4(data){
//alert(data);
	var arre= data.split("^");
	var pid= arre[0];
	var suma= arre[1];
	var svat= arre[2];
	var coun= arre[3];
	var objesuma= document.getElementById("suma"+pid);
	var objesvat= document.getElementById("svat"+pid);
	var objecoun= document.getElementById("coun"+pid);
	if (suma==""){
		objesuma.className= "zero";
		objesuma.innerHTML= "нула";
	}else{
		objesuma.className= "";
		objesuma.innerHTML= suma;
	}
	if (svat==""){
		objesvat.innerHTML= "";
	}else{
		objesvat.innerHTML= svat;
	}
	if (coun==""){
		objecoun.innerHTML= "няма редове";
	}else{
		objecoun.innerHTML= coun+" реда";
	}
}
</script>


<script>
function dele6(pid  ,psum,pcou){
	var text= 'потвърди изтриването на фактура/сметка'
	+String.fromCharCode(10)+'на стойност '+psum+' лв';
		if (pcou+0==0){
		}else{
	text += String.fromCharCode(10)+'заедно с нейните '+pcou+' реда';
		}
		if (confirm(text)){
jQuery.ajax({
	url: "finainvodele.ajax.php?p="+pid
	,success: succ6
});
		}else{
		}
}
function succ6(data){
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){
		document.location.href= '<?php echo $this->_tpl_vars['LINKREFR']; ?>
';
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}

function autosubminvo(event,obinpu){
//alert(obinpu.value);
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
		if (obinpu.value==""){
		}else{
			lipara= {date:obinpu.value,modeel:"<?php echo $this->_tpl_vars['MODEEL']; ?>
"};
			jQuery.ajax({
				url: "finainvodate.ajax.php"
				,data: lipara
				,type: "post"
				,success: fusucc
			})
		}
return false;
	}else{
return true;
	}
}
function fusucc(data){
//alert("data="+data);
	var arresu= data.split("/");
	var code= arresu[0];
	if (code=="0"){
		$("#error").text("");
document.location.href= arresu[1];
	}else{
		$("#error").text(arresu[1]);
	}
}

function autosubm2(event,obinpu){
//alert(obinpu.value);
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
		if (obinpu.value==""){
		}else{
			lipara= {seye:obinpu.value,modeel:"<?php echo $this->_tpl_vars['MODEEL']; ?>
"};
			jQuery.ajax({
				url: "finainvoseye.ajax.php"
				,data: lipara
				,type: "post"
				,success: fusucc2
			})
		}
return false;
	}else{
return true;
	}
}
function fusucc2(data){
//alert("data="+data);
	var arresu= data.split("/");
	var code= arresu[0];
	if (code=="0"){
		$("#err2").text("");
document.location.href= arresu[1];
	}else{
		$("#err2").text(arresu[1]);
	}
}

function autosubm3(event,obinpu){
//alert(obinpu.value);
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
		if (obinpu.value==""){
		}else{
			lipara= {name:obinpu.value,modeel:"<?php echo $this->_tpl_vars['MODEEL']; ?>
"};
			jQuery.ajax({
				url: "finainvoname.ajax.php"
				,data: lipara
				,type: "post"
				,success: fusucc3
			})
		}
return false;
	}else{
return true;
	}
}
function fusucc3(data){
//alert("data="+data);
	var arresu= data.split("/");
	var code= arresu[0];
	if (code=="0"){
		$("#err3").text("");
document.location.href= arresu[1];
	}else{
		$("#err3").text(arresu[1]);
	}
}

function autosubm4(event,obinpu){
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
//	if (code==13){
//		if (obinpu.value==""){
//		}else{
			lipara= {type:obinpu.value,modeel:"<?php echo $this->_tpl_vars['MODEEL']; ?>
"};
			jQuery.ajax({
				url: "finainvotype.ajax.php"
				,data: lipara
				,type: "post"
				,success: fusucc4
			})
//		}
return false;
//	}else{
//return true;
//	}
}
function fusucc4(data){
//alert("data="+data);
	var arresu= data.split("^");
	var code= arresu[0];
	if (code=="ok"){
document.location.href= arresu[1];
	}else{
alert(data);
	}
}

var currid;
function fupringrou(){
	var list= $("input[@type='checkbox']");
	var lico= "";
	for (var i=0; i<list.length; i++){
		if (list[i].checked){
//			lico += list[i].id+"/";
			currid= list[i].id;
			if (currid.substr(0,4)!="bill"){
				lico += currid+"/";
			}else{
			}
		}else{
		}
	}
	if (lico==""){
	}else{
//alert(type+'==='+lico);
//alert(lico);
		fuprin2("finainvoprnt.ajax.php?para="+lico);
	}
}

function fupringroubill(){
	var list= $("input[@type='checkbox']");
	var lico= "";
	for (var i=0; i<list.length; i++){
		if (list[i].checked){
//			lico += list[i].id+"/";
			currid= list[i].id;
			if (currid.substr(0,4)=="bill"){
				lico += currid+"/";
			}else{
			}
		}else{
		}
	}
	if (lico==""){
	}else{
//alert(type+'==='+lico);
//alert(lico);
		fuprin2("finab2prnt.ajax.php?para="+lico);
	}
}

$(document).ready(function() {
	$(".wclose_normal").bind("click",function(){
parent.$('#<?php echo $this->_tpl_vars['URLREFRESH']; ?>
').click();
	});
})
</script>