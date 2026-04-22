<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:51
         compiled from trango.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'trango.tpl', 96, false),array('modifier', 'cat', 'trango.tpl', 341, false),array('modifier', 'tomoney2', 'trango.tpl', 362, false),array('modifier', 'tomo3', 'trango.tpl', 485, false),array('function', 'counter', 'trango.tpl', 329, false),)), $this); ?>
<style>
.link {font:normal 8pt verdana;cursor:pointer;border-bottom: 1px solid black;}
.desc {font:normal 8pt verdana;}
.h2 {font: normal 8pt verdana; background-color:#bbbbbb;}
.r1 {font: normal 8pt verdana;}
.r2 {font: normal 8pt verdana; border-bottom:1px solid black;}
.case {font: normal 10pt verdana}
.budg {font: normal 8pt verdana; background-color:wheat;cursor:pointer;}
.pseu {font: normal 8pt verdana; color:red;}
.locked {font: normal 8pt verdana; background-color:salmon;padding-left:4px;padding-right:4px;}
.curr2 {cursor:pointer;font:normal 8pt verdana;padding:1px 6px;border-bottom: 1px solid brown;color:brown;background-color:wheat;}
.vari2 {cursor:pointer;font:normal 8pt verdana;padding:1px 6px;border-bottom: 1px solid brown;color:brown;}
.stat1 {cursor:help;font:normal 8pt verdana;padding:1px 6px; background-color:thistle;}
.stat2 {cursor:help;font:normal 8pt verdana;padding:1px 6px; background-color:magenta;}
.stat2ok {font:bold 7pt verdana;color:white;}
.seye {font:normal 8pt verdana;}
.addr {font:normal 7pt verdana;color:blue;}
</style>
				<?php if ($this->_tpl_vars['CALLUSER']): ?>
<style>
.curr2 {cursor:pointer;font:normal 8pt verdana;padding:1px 6px;border-bottom: 1px solid darkgreen;color:darkgreen;background-color:lightgreen;}
.vari2 {cursor:pointer;font:normal 8pt verdana;padding:1px 6px;border-bottom: 1px solid darkgreen;color:darkgreen;}
</style>
				<?php else: ?>
				<?php endif; ?>

				<?php if (isset ( $this->_tpl_vars['NAMELOCKED'] )): ?>
<span class="no"><?php echo $this->_tpl_vars['NAMELOCKED']; ?>
 е в това дело</span>
				<?php else: ?>
				<?php endif; ?>
									<table align=center>
												<?php if ($this->_tpl_vars['CALLFROMALTE']): ?>
												<?php else: ?>
									<tr>
<td colspan=30>
		<form name="myform2" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
<a class="<?php if ($this->_tpl_vars['CASEALTE'] == -9): ?>curr2<?php else: ?>link<?php endif; ?>" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['GOBACK'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
постъпления готови за превод [стр.<?php echo $this->_tpl_vars['PAGE']; ?>
] </a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="seye">
постъпления по дело/год &nbsp;
<input type="text" name="seyefina2" id="seyefina2" size=12 autocomplete=off
style="font:bold 7pt verdana; border: 0px solid green; background-color:#dddddd;" onkeyup="autosubm4(event,this.form);">
+enter
				<?php if (isset ( $this->_tpl_vars['ERCASE'] )): ?>
<font color=red><?php echo $this->_tpl_vars['ERCASE']; ?>
</font>
				<?php else: ?>
				<?php endif; ?>
</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="seye">
моите преводи
&nbsp;&nbsp;
</span>
<a class="<?php if ($this->_tpl_vars['CASEALTE'] == -1): ?>curr2<?php else: ?>link<?php endif; ?>" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['LINKWAIT'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
чакащи </a>
&nbsp;
<a class="<?php if ($this->_tpl_vars['CASEALTE'] == -2): ?>curr2<?php else: ?>link<?php endif; ?>" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['LINKASSI'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
назначени </a>
&nbsp;
<a class="<?php if ($this->_tpl_vars['CASEALTE'] == -3): ?>curr2<?php else: ?>link<?php endif; ?>" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['LINKDIRE'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
ръчни </a>
		</form>
			<?php if (isset ( $_SESSION['lastcase'] )): ?>
<span class="seye">
последни дела 
</span>
&nbsp;
				<?php $_from = $_SESSION['lastcase']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idcase'] => $this->_tpl_vars['elem']):
?>
<a class="<?php if ($this->_tpl_vars['idcase'] == $this->_tpl_vars['CURRCASE']): ?>curr2<?php else: ?>link<?php endif; ?>" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['caselink'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>
 </a>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>
			<?php else: ?>
			<?php endif; ?>
												<?php endif; ?>
									<tr>
<td colspan=10 class="case">
<br>
																				<?php if (isset ( $this->_tpl_vars['CONTVARI'] )): ?>
<?php echo $this->_tpl_vars['CONTVARI']; ?>

																				<?php else: ?>

																																<?php if (isset ( $this->_tpl_vars['MYWAIT'] )): ?>
													<?php echo $this->_tpl_vars['MYWAIT']; ?>

																<?php else: ?>
дело <b><?php echo $this->_tpl_vars['DATACASE']['serial']; ?>
/<?php echo $this->_tpl_vars['DATACASE']['year']; ?>
</b> деловодител <b><?php echo $this->_tpl_vars['DATACASE']['username']; ?>
</b>
									<tr>
						<td rowspan=2 valign=top>
						<table align=center>
						<tr>
<td class="h2" colspan=9 align=center> осн.данни по делото
			<tr>
<td class="r1"> образувано на
<td class="r2"> <?php echo ((is_array($_tmp=$this->_tpl_vars['DATACASE']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

			<tr>
<td class="r1"> описание
<td class="r2"> <?php echo $this->_tpl_vars['DATACASE']['text']; ?>

			<tr>
<td class="r1"> идва от
<td class="r2"> <?php echo $this->_tpl_vars['ARFROM'][$this->_tpl_vars['DATACASE']['idcofrom']]; ?>

	<?php if (empty ( $this->_tpl_vars['DATACASE']['cogrou'] )): ?>
	<?php else: ?>
/ състав <?php echo $this->_tpl_vars['DATACASE']['cogrou']; ?>

	<?php endif; ?>
			<tr>
<td class="r1"> изп.титул
<td class="r2"> <?php echo $this->_tpl_vars['ARTITU'][$this->_tpl_vars['DATACASE']['idtitu']]; ?>

						<?php if ($this->_tpl_vars['DATACASE']['idtitu'] == 1): ?>
от <?php echo $this->_tpl_vars['DATACASE']['dateexec']; ?>

						<?php else: ?>
						<?php endif; ?>
			<tr>
<td class="r1"> вид номер/год
<td class="r2"> <?php echo $this->_tpl_vars['ARSORT'][$this->_tpl_vars['DATACASE']['idsort']]; ?>
 <?php echo $this->_tpl_vars['DATACASE']['conome']; ?>
/<?php echo $this->_tpl_vars['DATACASE']['coyear']; ?>

			<tr>
<td class="r1"> текущ статус
<td class="r2"> <?php echo $this->_tpl_vars['ARSTAT'][$this->_tpl_vars['DATACASE']['idstat']]; ?>

			<tr>
<td class="r1"> вземане произход
<td class="r2"> <?php echo $this->_tpl_vars['DATACASE']['origtext']; ?>

						</table>
						<td rowspan=2 width=14> &nbsp;
						<td valign=top>
						<table>
						<tr>
<td class="h2" colspan=9 align=center> взискатели по делото
									<tr>
<td class="h2"> ЕИК
<td class="h2"> ЕГН
<td class="h2"> име
<td class="h2"> IBAN
<td class="h2"> банка
<td class="h2"> &nbsp;
<td class="h2"> бюдж
<td class="h2"> опис
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
			<?php if (empty ( $this->_tpl_vars['elem']['iban'] )): ?>
<td class="no"> липсва
			<?php else: ?>
<td class="r2"> <?php echo $this->_tpl_vars['elem']['iban']; ?>
&nbsp;
					<?php if ($this->_tpl_vars['elem']['ibaniser']): ?>
<span class="no">грешен</span>
					<?php else: ?>
					<?php endif; ?>
			<?php endif; ?>
			<?php if (empty ( $this->_tpl_vars['elem']['bankname'] )): ?>
<td class="no"> липсва
			<?php else: ?>
<td class="r2"> <?php echo $this->_tpl_vars['elem']['bankname']; ?>
&nbsp;
			<?php endif; ?>
<td class=""> 
<a href="<?php echo $this->_tpl_vars['elem']['claimodi']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай сметката"></a>
<td class="budg" align=center title="корегирай" 
onclick="$.nyroModalManual({url:'<?php echo $this->_tpl_vars['elem']['budgmodi']; ?>
',forceType:'iframe'});">

<?php if ($this->_tpl_vars['elem']['isbudg'] == 1): ?>да<?php else:  endif; ?>
<td class="r2" align=center> <?php if ($this->_tpl_vars['elem']['islist'] == 1): ?>да<?php else: ?>&nbsp;<?php endif; ?>
						<?php if (empty ( $this->_tpl_vars['elem']['address'] )): ?>
						<?php else: ?>
									<tr>
<td class="addr" colspan=2> &nbsp;
<td class="addr" colspan=3> <?php echo $this->_tpl_vars['elem']['address']; ?>

						<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
						</table>
									<tr>
						<td valign=top>
						<table>
						<tr>
<td class="h2" colspan=6 align=center> длъжници по делото
									<tr>
<td class="h2"> ЕИК
<td class="h2"> ЕГН
<td class="h2"> име
<td class="h2"> IBAN
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
			<?php if (empty ( $this->_tpl_vars['elem']['iban'] )): ?>
<td class="r2"> &nbsp;
			<?php else: ?>
<td class="r2"> <?php echo $this->_tpl_vars['elem']['iban']; ?>
&nbsp;
					<?php if ($this->_tpl_vars['elem']['ibaniser']): ?>
<span class="no">грешен</span>
					<?php else: ?>
					<?php endif; ?>
			<?php endif; ?>
						<?php if (empty ( $this->_tpl_vars['elem']['address'] )): ?>
						<?php else: ?>
									<tr>
<td class="addr" colspan=2> &nbsp;
<td class="addr" colspan=3> <?php echo $this->_tpl_vars['elem']['address']; ?>

						<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
						</table>
									</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
											<?php if (in_array ( $this->_tpl_vars['IDVARI'] , array ( 3 , 4 , 5 ) )): ?>
												<?php $this->assign('isiban', false); ?>
											<?php else: ?>
												<?php $this->assign('isiban', true); ?>
											<?php endif; ?>
									
									<table align=center>
												<?php if ($this->_tpl_vars['CALLFROMALTE'] && ! $this->_tpl_vars['CALLUSER']): ?>
												<?php else: ?>
									<tr>
									<td>
				<?php $_from = $this->_tpl_vars['ARSUBM']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekeyvari'] => $this->_tpl_vars['elemvari']):
?>
							<?php if ($this->_tpl_vars['ARCOUN'][$this->_tpl_vars['ekeyvari']] == 0): ?>
							<?php else: ?>
<span class="<?php if ($this->_tpl_vars['ekeyvari'] == $this->_tpl_vars['IDVARI']): ?>curr2<?php else: ?>vari2<?php endif; ?>" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elemvari']['link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<?php echo $this->_tpl_vars['elemvari']['text']; ?>
 [<?php echo $this->_tpl_vars['ARCOUN'][$this->_tpl_vars['ekeyvari']]; ?>
] </span>
&nbsp;&nbsp;
							<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
												<?php endif; ?>
									<tr>
									<td>
													<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'>
<div style="float:left"> списък на постъпленията по дело <?php echo $this->_tpl_vars['DATACASE']['serial']; ?>
/<?php echo $this->_tpl_vars['DATACASE']['year']; ?>
 - <?php echo $this->_tpl_vars['HEADTX']; ?>

</div>
		<tr class='head2'>
<td align=center colspan=7> постъпление
											<?php if ($this->_tpl_vars['ISTOPAYM']): ?>
<td align=center colspan=3> разпределение
<td align=center colspan=1> върни
<td align=center colspan=1> постъп
											<?php else: ?>
												<?php if ($this->_tpl_vars['EXCOLO']): ?>
<td align=center colspan=9> разпределение
												<?php else: ?>
<td align=center colspan=<?php if ($this->_tpl_vars['isiban']): ?>3<?php else: ?>2<?php endif; ?>> разпределение
												<?php endif; ?>
											<?php endif; ?>
		<tr class='head2'>
<td align=right> сума
<td> от къде
<td> кога
<td> длъжник
<td align=right> пр1
<td align=right> пр2
<td> статус
<td align=right> сума
<td> взискател
			<?php if ($this->_tpl_vars['isiban']): ?>
<td> iban
			<?php else: ?>
			<?php endif; ?>
											<?php if ($this->_tpl_vars['ISTOPAYM']): ?>
								<?php if ($this->_tpl_vars['CALLUSER']): ?>
								<?php else: ?>
<td align=center> &nbsp;
<td align=center> 
<a href="#" onclick="_cboxaction(futopaym); return false;"> 
<img src="images/topaym.gif" title="маркираните към списъка с преводи">
</a>
								<?php endif; ?>
											<?php else: ?>
												<?php if ($this->_tpl_vars['EXCOLO']): ?>
<td> сума<br>за превод
<td> от<br>банка
<td> опис
<td> пакет
<td align=center> ръчен<br>превод
<td align=center> изк<br>лючи
												<?php else: ?>
												<?php endif; ?>
											<?php endif; ?>

												<?php echo smarty_function_counter(array('start' => 0,'assign' => 'curr'), $this);?>

<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
												<?php echo smarty_function_counter(array('assign' => 'curr'), $this);?>

												<?php if (!(1 & $this->_tpl_vars['curr'])): ?>
												<?php else: ?>
						<?php $this->assign('bgco', ""); ?>
												<?php endif; ?>
						<?php $this->assign('myid', $this->_tpl_vars['elem']['id']); ?>
						<?php $this->assign('idtype', $this->_tpl_vars['elem']['idtype']); ?>
						<?php $this->assign('myspan', ((is_array($_tmp="rowspan=")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['LISTDATACOUN'][$this->_tpl_vars['myid']]) : smarty_modifier_cat($_tmp, $this->_tpl_vars['LISTDATACOUN'][$this->_tpl_vars['myid']]))); ?>
				<?php if (in_array ( $this->_tpl_vars['elem']['idfinastat'] , array ( 3 , 4 , 5 ) )): ?>
						<?php $this->assign('isoldway', true); ?>
				<?php else: ?>
						<?php $this->assign('isoldway', false); ?>
				<?php endif; ?>

								<tr bgcolor="<?php echo $this->_tpl_vars['bgco']; ?>
">
<td <?php echo $this->_tpl_vars['myspan']; ?>
 align=right 
		<?php if (empty ( $this->_tpl_vars['elem']['lockname'] )): ?>
		<?php else: ?> 
bgcolor=salmon style="cursor:pointer;" title="заключена от <?php echo $this->_tpl_vars['elem']['lockname']; ?>
, кликни"
onclick="$.nyroModalManual({forceType:'iframe', url:'<?php echo $this->_tpl_vars['elem']['unlockfina']; ?>
'});"
		<?php endif; ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['inco'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

				<?php $this->assign('bankname', $this->_tpl_vars['ARBANK'][$this->_tpl_vars['elem']['codebank']]); ?>
				<?php if ($this->_tpl_vars['idtype'] == 1): ?>
					<?php $this->assign('finaba', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp="/")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elem']['idfinabank']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elem']['idfinabank'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "-") : smarty_modifier_cat($_tmp, "-")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['bankname']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['bankname']))); ?>
				<?php else: ?>
					<?php $this->assign('finaba', ""); ?>
				<?php endif; ?>
<td <?php echo $this->_tpl_vars['myspan']; ?>
> <nobr><?php echo ((is_array($_tmp=$this->_tpl_vars['ARTYPE'][$this->_tpl_vars['idtype']])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['finaba']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['finaba'])); ?>
</nobr>
<td <?php echo $this->_tpl_vars['myspan']; ?>
>
						<?php if ($this->_tpl_vars['idtype'] == 1): ?>
<nobr><?php echo $this->_tpl_vars['elem']['finadate']; ?>
 <?php echo $this->_tpl_vars['elem']['finahour']; ?>
</nobr>
						<?php elseif ($this->_tpl_vars['idtype'] == 2): ?>
<nobr><?php echo $this->_tpl_vars['elem']['cashdate']; ?>
</nobr>
						<?php elseif ($this->_tpl_vars['idtype'] == 7): ?>
<nobr><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")))) ? $this->_run_mod_handler('cat', true, $_tmp, " въвед") : smarty_modifier_cat($_tmp, " въвед")); ?>
</nobr>
						<?php else: ?>
&nbsp;
						<?php endif; ?>
<td <?php echo $this->_tpl_vars['myspan']; ?>
> <?php echo $this->_tpl_vars['DEBTLIST'][$this->_tpl_vars['DEBTINDX']]['name']; ?>
&nbsp;
<td <?php echo $this->_tpl_vars['myspan']; ?>
 align=right title="<?php echo $this->_tpl_vars['elem']['visuinco']; ?>
-<?php echo $this->_tpl_vars['elem']['visutime']; ?>
"> <?php echo $this->_tpl_vars['elem']['delay1']; ?>

<td <?php echo $this->_tpl_vars['myspan']; ?>
 align=right title="<?php echo $this->_tpl_vars['elem']['visutime']; ?>
-<?php echo $this->_tpl_vars['elem']['visuclos']; ?>
"> <?php echo $this->_tpl_vars['elem']['delay2']; ?>

<td <?php echo $this->_tpl_vars['myspan']; ?>
 align=center> 
					<?php if ($this->_tpl_vars['elem']['idfinastat'] == 3): ?>
<span class="no" title="<?php echo $this->_tpl_vars['ARFINASTAT'][$this->_tpl_vars['elem']['idfinastat']]; ?>
">&nbsp;</span>
					<?php elseif ($this->_tpl_vars['elem']['idfinastat'] == 4): ?>
<a href="<?php echo $this->_tpl_vars['elem']['clos']; ?>
" class="nyroModal" target="_blank"><img src="images/clos.gif" title="приключи постарому"></a>
					<?php elseif ($this->_tpl_vars['elem']['idfinastat'] == 5): ?>
							<?php $this->assign('timecl', ((is_array($_tmp=$this->_tpl_vars['elem']['timeclosed'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M:%S") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M:%S"))); ?>
							<?php $this->assign('oktext', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ARFINASTAT'][$this->_tpl_vars['elem']['idfinastat']])) ? $this->_run_mod_handler('cat', true, $_tmp, " на ") : smarty_modifier_cat($_tmp, " на ")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['timecl']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['timecl']))); ?>
									<?php if ($this->_tpl_vars['elem']['istran'] == 0): ?>
<span class="yes" title="<?php echo $this->_tpl_vars['oktext']; ?>
">&nbsp;</span>
									<?php else: ?>
<img src="images/finish.gif" title="СТАРО ПРИКЛЮЧЕНО на <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['timeclosed'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y %H:%M:%S') : smarty_modifier_date_format($_tmp, '%d.%m.%Y %H:%M:%S')); ?>
"
oncontextmenu="document.location.href='<?php echo $this->_tpl_vars['elem']['demarkclos']; ?>
';return false;">
									<?php endif; ?>
					<?php elseif ($this->_tpl_vars['elem']['idfinastat'] == 6): ?>
								<?php if ($this->_tpl_vars['CALLUSER']): ?>
<a href="<?php echo $this->_tpl_vars['pref'];  echo $this->_tpl_vars['elem']['markclos']; ?>
" class="nyroModal" target="_blank"><img src="images/tran1.gif" title="приключване/превод"></a>
								<?php else: ?>
<img src="images/tran1.gif" title="изравнено, чака деловодителя">
								<?php endif; ?>
					<?php elseif ($this->_tpl_vars['elem']['idfinastat'] == 1): ?>
<span class="stat1" title="<?php echo $this->_tpl_vars['ARFINASTAT'][$this->_tpl_vars['elem']['idfinastat']]; ?>
">&nbsp;&nbsp;&nbsp;</span>
					<?php elseif ($this->_tpl_vars['elem']['idfinastat'] == 2): ?>
						<?php if ($this->_tpl_vars['ENDDLIST'][$this->_tpl_vars['myid']]['isendd'] == 1): ?>
<span class="stat2 stat2ok" title="изцяло преведено">&nbsp;ОК&nbsp;</span>
						<?php else: ?>
<span class="stat2" title="<?php echo $this->_tpl_vars['ARFINASTAT'][$this->_tpl_vars['elem']['idfinastat']]; ?>
">&nbsp;&nbsp;&nbsp;</span>
						<?php endif; ?>
					<?php else: ?>
<?php echo $this->_tpl_vars['ARFINASTAT'][$this->_tpl_vars['elem']['idfinastat']]; ?>

					<?php endif; ?>

								<?php $this->assign('first', true); ?>
				<?php $_from = $this->_tpl_vars['LISTDATA'][$this->_tpl_vars['myid']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idclai'] => $this->_tpl_vars['elemdata']):
?>
								<?php if ($this->_tpl_vars['first']): ?>
								<?php else: ?>
					<tr bgcolor="<?php echo $this->_tpl_vars['bgco']; ?>
">
								<?php endif; ?>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elemdata']['suma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

			<?php if ($this->_tpl_vars['idclai'] <= 0): ?>
<td class="pseu"> <?php echo $this->_tpl_vars['elemdata']['clainame']; ?>
&nbsp;
			<?php else: ?>
<td> <?php echo $this->_tpl_vars['elemdata']['clainame']; ?>

			<?php endif; ?>
							<?php if ($this->_tpl_vars['isoldway']): ?>
							<?php else: ?>
			<?php if ($this->_tpl_vars['idclai'] <= 0 && $this->_tpl_vars['idclai'] <> -1): ?>
<td class="pseu"> ОК
			<?php else: ?>
				<?php if (empty ( $this->_tpl_vars['elemdata']['iban'] )): ?>
<td class="no"> липсва
				<?php else: ?>
<td> <?php echo $this->_tpl_vars['elemdata']['iban']; ?>
&nbsp;
					<?php if ($this->_tpl_vars['elemdata']['ibaniser']): ?>
<span class="no">грешен</span>
					<?php else: ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
							<?php endif; ?>
											<?php if ($this->_tpl_vars['ISTOPAYM']): ?>
								<?php if ($this->_tpl_vars['first']): ?>
<td <?php echo $this->_tpl_vars['myspan']; ?>
 align=center>
					<?php if ($this->_tpl_vars['elem']['idfinastat'] == 1 && empty ( $this->_tpl_vars['elem']['lockname'] ) && ! $this->_tpl_vars['CALLUSER']): ?>
<img src="images/unmark.gif" style="cursor:pointer;" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['finaback'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> title="върни на деловодителя за корекция"> 
					<?php else: ?>
&nbsp;
					<?php endif; ?>
<td <?php echo $this->_tpl_vars['myspan']; ?>
 align=center>
					<?php if ($this->_tpl_vars['elem']['idfinastat'] == 1 && empty ( $this->_tpl_vars['elem']['lockname'] ) && ! $this->_tpl_vars['CALLUSER']): ?>
<input type=checkbox id="cb<?php echo $this->_tpl_vars['myid']; ?>
" checked>
					<?php else: ?>
&nbsp;
					<?php endif; ?>
								<?php else: ?>
								<?php endif; ?>
											<?php else: ?>
												<?php if ($this->_tpl_vars['EXCOLO']): ?>
													<?php $this->assign('elemrefe', $this->_tpl_vars['EXLIST'][$this->_tpl_vars['myid']][$this->_tpl_vars['idclai']]); ?>
<td bgcolor=#dddddd align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elemrefe']['amount'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

<td bgcolor=#dddddd> <?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['elemrefe']['idbank']]; ?>

						<?php if ($this->_tpl_vars['elemrefe']['idinve'] == 0): ?>
<td bgcolor=#dddddd>&nbsp;
						<?php else: ?>
<td align=center bgcolor="<?php echo $this->_tpl_vars['ARPACKCOLO'][$this->_tpl_vars['elemrefe']['idinvestat']]; ?>
"> 
<?php echo $this->_tpl_vars['elemrefe']['idinve']; ?>

						<?php endif; ?>
						<?php if ($this->_tpl_vars['elemrefe']['idinve'] == 0): ?>
		<?php if ($this->_tpl_vars['elemrefe']['idpack'] == 0): ?>
<td bgcolor=#dddddd>&nbsp;
		<?php else: ?>
<td align=center bgcolor="<?php echo $this->_tpl_vars['ARPACKCOLO'][$this->_tpl_vars['elemrefe']['idpackstat']]; ?>
"> 
<?php echo $this->_tpl_vars['elemrefe']['idpack']; ?>

		<?php endif; ?>
						<?php else: ?>
		<?php if ($this->_tpl_vars['elemrefe']['idinvepack'] == 0): ?>
<td bgcolor=#dddddd>&nbsp;
		<?php else: ?>
<td align=center bgcolor="<?php echo $this->_tpl_vars['ARPACKCOLO'][$this->_tpl_vars['elemrefe']['idinvepackstat']]; ?>
"> 
<?php echo $this->_tpl_vars['elemrefe']['idinvepack']; ?>

		<?php endif; ?>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['elemrefe']['idstat'] == 9): ?>
<td bgcolor=<?php echo $this->_tpl_vars['ARPACKCOLO'][2]; ?>
> превед
						<?php elseif ($this->_tpl_vars['elemrefe']['idstat'] == 6): ?>
<td bgcolor=#dddddd> отлож
						<?php else: ?>
<td bgcolor=#dddddd>&nbsp;
						<?php endif; ?>
								<?php if ($this->_tpl_vars['first']): ?>
<td bgcolor=#dddddd <?php echo $this->_tpl_vars['myspan']; ?>
 align=center>
		<?php if ($this->_tpl_vars['ARFINAEX'][$this->_tpl_vars['myid']] && ! $this->_tpl_vars['CALLUSER']): ?>
<a href="<?php echo $this->_tpl_vars['elem']['tofina']; ?>
" class="nyroModal" target="_blank"><img src="images/unmark.gif" title="изключи постъплението от преводите"></a>
		<?php else: ?>
&nbsp;
		<?php endif; ?>
								<?php else: ?>
								<?php endif; ?>
												<?php else: ?>
												<?php endif; ?>
											<?php endif; ?>
							<?php if ($this->_tpl_vars['first']): ?>
								<?php $this->assign('first', false); ?>
							<?php else: ?>
							<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
								<tr>
<td style="font-size:2px;" bgcolor="silver" colspan=20> &nbsp;
<?php endforeach; endif; unset($_from); ?>
																																<?php endif; ?>
																																								<?php endif; ?>
		</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cbsess.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script>
function futopaym(){
	$.nyroModalManual({forceType:'iframe', url:'<?php echo $this->_tpl_vars['CBTOPAYM']; ?>
'});
}
function autosubm4(event,form){
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
form.submit();
	}
}
</script>