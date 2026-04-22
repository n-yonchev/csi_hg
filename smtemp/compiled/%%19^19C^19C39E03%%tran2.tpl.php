<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'tran2.tpl', 290, false),array('modifier', 'tomoney2', 'tran2.tpl', 317, false),array('modifier', 'tomo3', 'tran2.tpl', 331, false),array('modifier', 'cat', 'tran2.tpl', 335, false),array('modifier', 'nl2br', 'tran2.tpl', 388, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.over {cursor:pointer;background-color:aqua;}
.curr {cursor:pointer;background-color:wheat;padding:4px;border: 1px solid silver;}
.vari {cursor:pointer;padding:4px;border: 1px solid silver;}
.coun {font:normal 16pt verdana;padding-right:8px;}
.dire {cursor:pointer;background-color:wheat;}
.cluehead {font:normal 8pt verdana; background-color:silver;}
.cluero {font:normal 8pt verdana; border-bottom:1px solid silver;}
.banklink {font:normal 7pt verdana;cursor:pointer;padding:0px 4px 0px 4px;border-bottom:1px solid black;color:black;}
.usna {font:normal 7pt verdana !important;}
.bankcurr {background-color:#dddddd;}
.date {font:bold 7pt verdana !important;background-color:lightcyan;}
.ext2 {background-color:#dddddd;padding-left:8px;padding-right:8px;}
</style>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />

										<table align=center>
										<tr>
														<?php if ($this->_tpl_vars['ISPERM']): ?>
										<td valign=top>

										<td width=20> &nbsp;
														<?php else: ?>
														<?php endif; ?>
										<td valign=top>

							<?php if (isset ( $this->_tpl_vars['ARSCEN'] )): ?>
<table align=center cellspacing=1 cellpadding=0>
			<?php $_from = $this->_tpl_vars['ARSCEN']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
									<?php if ($this->_tpl_vars['elem'] == "=0"): ?>
<tr><td class="mini ext2"> всички
<td width=10><td>
									<?php elseif ($this->_tpl_vars['elem'] == "=0end"): ?>
</tr>
									<?php elseif ($this->_tpl_vars['elem'] == "=1"): ?>
<tr><td class="mini ext2"> готови за описи
<td width=10><td>
				<?php $_from = $this->_tpl_vars['ARV2LINKINVE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekeyinve'] => $this->_tpl_vars['eleminve']):
?>
<nobr>
<span class="<?php if ($this->_tpl_vars['ekeyinve'] == $this->_tpl_vars['V2']): ?>curr2<?php else: ?>vari2<?php endif; ?>" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['eleminve']['link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<?php echo $this->_tpl_vars['eleminve']['text']; ?>
 [<?php echo $this->_tpl_vars['eleminve']['coun']; ?>
] </span>
&nbsp;
</nobr>
				<?php endforeach; endif; unset($_from); ?>
									<?php elseif ($this->_tpl_vars['elem'] == "=1end"): ?>
</tr>
									<?php elseif ($this->_tpl_vars['elem'] == "=2"): ?>
<tr><td class="mini ext2"> други готови
<td width=10><td>
									<?php elseif ($this->_tpl_vars['elem'] == "=2end"): ?>
</tr>
									<?php else: ?>
										<?php if ($this->_tpl_vars['ARV2LINK'][$this->_tpl_vars['elem']]['coun'] == 0): ?>
										<?php else: ?>
											<?php if ($this->_tpl_vars['elem'] == $this->_tpl_vars['INDXPROB']): ?>
												<?php $this->assign('elemclas', 'prob2'); ?>
											<?php else: ?>
												<?php $this->assign('elemclas', 'vari2'); ?>
											<?php endif; ?>
<nobr>
<span class="<?php if ($this->_tpl_vars['elem'] == $this->_tpl_vars['V2']): ?>curr2<?php else:  echo $this->_tpl_vars['elemclas'];  endif; ?>" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['ARV2LINK'][$this->_tpl_vars['elem']]['link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<?php echo $this->_tpl_vars['ARV2LINK'][$this->_tpl_vars['elem']]['text']; ?>
 [<?php echo $this->_tpl_vars['ARV2LINK'][$this->_tpl_vars['elem']]['coun']; ?>
] </span>
&nbsp;
</nobr>
										<?php endif; ?>
									<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
</table>
<br>
							<?php else: ?>
							<?php endif; ?>

		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'>
<div style="float:left">списък на <?php echo $this->_tpl_vars['HEADTX']; ?>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
			


							<?php if (isset ( $this->_tpl_vars['ARSCEN'] )): ?>
								<?php if (isset ( $this->_tpl_vars['ARINVE'] )): ?>
						<tr>
<td colspan=20 bgcolor=white> 
<div style="float:left">
<span class="mini"> назначи преводи от списъка към опис </span>
			<?php $_from = $this->_tpl_vars['ARINVE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
					<?php if ($this->_tpl_vars['ekey'] == 0): ?>
<a href="#" onclick="indeinve('новия опис','<?php echo $this->_tpl_vars['elem']['link']; ?>
',0); return false;"> 
&nbsp;
<span class="toin"> 
нов </span>
</a>
					<?php else: ?>
<a href="#" bank="<?php echo $this->_tpl_vars['elem']['idbank']; ?>
" onclick="indeinve('опис <?php echo $this->_tpl_vars['ekey']; ?>
','<?php echo $this->_tpl_vars['elem']['link']; ?>
',<?php echo $this->_tpl_vars['elem']['idbank']; ?>
); return false;"> 
&nbsp;
<span class="toin" title="<?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['elem']['idbank']]; ?>
 <?php if (isset ( $this->_tpl_vars['elem']['coun'] )):  echo $this->_tpl_vars['elem']['coun'];  else: ?>0<?php endif; ?> превода"> 
<?php echo $this->_tpl_vars['ekey']; ?>
 </span>
</a>
					<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
</div>
								<?php else: ?>
								<?php endif; ?>
							<?php if (isset ( $this->_tpl_vars['INVEER'] )): ?>
&nbsp;&nbsp;
<font color=red><?php echo $this->_tpl_vars['INVEER']; ?>
</font>
							<?php else: ?>
							<?php endif; ?>
								<?php if (isset ( $this->_tpl_vars['ARINVE'] )): ?>
<div style="float:right">
<a id="bali0" class="banklink" href="#" onclick="bankfilt(0);"> всички </a>
&nbsp;&nbsp;&nbsp;
			<?php $_from = $this->_tpl_vars['ARBANKPAYM']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idbank'] => $this->_tpl_vars['namebank']):
?>
<a id="bali<?php echo $this->_tpl_vars['idbank']; ?>
" class="banklink" href="#" onclick="bankfilt(<?php echo $this->_tpl_vars['idbank']; ?>
);"> само <?php echo $this->_tpl_vars['namebank']; ?>
 </a>
&nbsp;
			<?php endforeach; endif; unset($_from); ?>
</div>
								<?php else: ?>
								<?php endif; ?>
								<?php if (isset ( $this->_tpl_vars['ARPACK'] )): ?>
						<tr>
<td colspan=20 bgcolor=white> 
<div style="float:left">
<span class="mini"> назначи преводи от списъка към ПАКЕТ </span>
			<?php $_from = $this->_tpl_vars['ARPACK']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
					<?php if ($this->_tpl_vars['ekey'] == 0): ?>
<a href="#" onclick="indepack('новия ПАКЕТ','<?php echo $this->_tpl_vars['elem']['link']; ?>
',0); return false;"> 
&nbsp;
<span class="toin"> 
нов </span>
</a>
					<?php else: ?>
<a href="#" bank="<?php echo $this->_tpl_vars['elem']['idbank']; ?>
" onclick="indepack('ПАКЕТ <?php echo $this->_tpl_vars['ekey']; ?>
','<?php echo $this->_tpl_vars['elem']['link']; ?>
',<?php echo $this->_tpl_vars['elem']['idbank']; ?>
); return false;"> 
&nbsp;
<span class="toin" title="<?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['elem']['idbank']];  if ($this->_tpl_vars['elem']['code'] == $this->_tpl_vars['CODEBANKPOST']): ?>/бюджетен<?php else:  endif; ?> <?php if (isset ( $this->_tpl_vars['elem']['coun'] )):  echo $this->_tpl_vars['elem']['coun'];  else: ?>0<?php endif; ?> превода"> 
<?php echo $this->_tpl_vars['ekey']; ?>
 </span>
</a>
					<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
</div>
								<?php else: ?>
								<?php endif; ?>
							<?php else: ?>
							<?php endif; ?>
						<?php if (isset ( $this->_tpl_vars['PACKER'] )): ?>
&nbsp;&nbsp;
<font color=red><?php echo $this->_tpl_vars['PACKER']; ?>
</font>
						<?php else: ?>
						<?php endif; ?>
								<?php if (isset ( $this->_tpl_vars['ARPACK'] )): ?>
<div style="float:right">
<a id="bali0" class="banklink" href="#" onclick="bankfilt(0);"> всички </a>
&nbsp;&nbsp;&nbsp;
			<?php $_from = $this->_tpl_vars['ARBANKPAYM']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idbank'] => $this->_tpl_vars['namebank']):
?>
<a id="bali<?php echo $this->_tpl_vars['idbank']; ?>
" class="banklink" href="#" onclick="bankfilt(<?php echo $this->_tpl_vars['idbank']; ?>
);"> само <?php echo $this->_tpl_vars['namebank']; ?>
 </a>
&nbsp;
			<?php endforeach; endif; unset($_from); ?>
</div>
								<?php else: ?>
								<?php endif; ?>

		<tr class='head2'>
<td>
<td valign=top align=center>
<td valign=top align=center> <img src="images/print.gif" title="отпечати маркираните" style="cursor:pointer" onclick="fuprincode();">
<td align=right>сума
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2iban.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2buac.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td>дело
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2clai.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2reci.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2debt.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2bank.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2text.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2full.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2edit.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2ring.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2budg.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2back.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2inve.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2pack.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2dire.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2cbox.tpl", 'smarty_include_vars' => array('VARI' => 'head')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td>&nbsp;
		</tr>

							<?php $this->assign('currfina', 0); ?>
							<?php $this->assign('currdate', ""); ?>
<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
											<?php $this->assign('myid', $this->_tpl_vars['elem']['id']); ?>
											<?php if (empty ( $this->_tpl_vars['elem']['idlist'] ) && empty ( $this->_tpl_vars['elem']['idpack'] ) && empty ( $this->_tpl_vars['elem']['idconf'] )): ?>
												<?php $this->assign('emptypoint', true); ?>
											<?php else: ?>
												<?php $this->assign('emptypoint', false); ?>
											<?php endif; ?>
							<?php if (((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')) == $this->_tpl_vars['currdate']): ?>
							<?php else: ?>
		<tr>
		<td class="date" colspan=20><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>

								<?php $this->assign('currdate', ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y'))); ?>
							<?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td width=10 title="<?php echo $this->_tpl_vars['elem']['id']; ?>
">
<td valign=top align=center> <img src="images/print.gif" title="отпечати" style="cursor:pointer" onclick="fup2('<?php echo $this->_tpl_vars['elem']['id']; ?>
/');">
<td valign=top align=center> <input class="tranprntchck" type=checkbox id="<?php echo $this->_tpl_vars['elem']['id']; ?>
">

<td align=right bgcolor="#dddddd" class="suma" rel="#suma<?php echo $this->_tpl_vars['myid']; ?>
" style="cursor:help;"
title="<table width=100%><tr><td>състав на сума за превод <b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['amount'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b> 
<br>генерирана <b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</b> в <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H:%M:%S') : smarty_modifier_date_format($_tmp, '%H:%M:%S')); ?>
 от <b><?php echo $this->_tpl_vars['elem']['usernametran']; ?>
</b>
<td class='coun' align=right><?php echo $this->_tpl_vars['ARREFECOUN'][$this->_tpl_vars['myid']]; ?>
</table>"
><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['amount'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

				<span id="suma<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
	<table>
	<tr>
<td class="cluehead" align=right> разпре<br>делена<br>сума
<td class="cluehead" align=right> постъ<br>пила<br>сума
<td class="cluehead" align=center> от
<td class="cluehead" align=center> на
						<?php $_from = $this->_tpl_vars['ARREFE'][$this->_tpl_vars['myid']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elrefe']):
?>
	<tr>
<td class="cluero" align=right bgcolor=silver> <?php echo ((is_array($_tmp=$this->_tpl_vars['elrefe']['suma'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

<td class="cluero" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elrefe']['inco'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

				<?php $this->assign('bankname', $this->_tpl_vars['ARBANK'][$this->_tpl_vars['elrefe']['codebank']]); ?>
				<?php if ($this->_tpl_vars['elrefe']['idtype'] == 1): ?>
					<?php $this->assign('finaba', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp="/")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elrefe']['idfinabank']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elrefe']['idfinabank'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "-") : smarty_modifier_cat($_tmp, "-")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['bankname']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['bankname']))); ?>
				<?php else: ?>
					<?php $this->assign('finaba', ""); ?>
				<?php endif; ?>
<td class="cluero"> <nobr><?php echo ((is_array($_tmp=$this->_tpl_vars['ARTYPE'][$this->_tpl_vars['elrefe']['idtype']])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['finaba']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['finaba'])); ?>
</nobr>
<td class="cluero">
						<?php if ($this->_tpl_vars['elrefe']['idtype'] == 1): ?>
<nobr><?php echo $this->_tpl_vars['elrefe']['finadate']; ?>
 <?php echo $this->_tpl_vars['elrefe']['finahour']; ?>
</nobr>
						<?php elseif ($this->_tpl_vars['idtype'] == 2): ?>
<nobr><?php echo $this->_tpl_vars['elrefe']['cashdate']; ?>
</nobr>
						<?php elseif ($this->_tpl_vars['idtype'] == 7): ?>
<nobr><?php echo ((is_array($_tmp=$this->_tpl_vars['elrefe']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</nobr>
						<?php else: ?>
&nbsp;
						<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
	</table>
</span>
				
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2iban.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2buac.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td class="case" rel="#case<?php echo $this->_tpl_vars['myid']; ?>
" title="доп.информация за делото" 
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['gotocase'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
><?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>

<span id="case<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
деловодител <?php echo $this->_tpl_vars['elem']['username']; ?>

			<?php if (empty ( $this->_tpl_vars['elem']['casenote'] )): ?>
			<?php else: ?>
<br> бележки
<div style="margin-left:20px;"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['casenote'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
 </div>
			<?php endif; ?>
<hr>
<font color=blue>ляв клик - виж всички преводи за делото </font>
</span>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2clai.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2reci.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2debt.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2bank.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2text.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2full.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2edit.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2ring.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2budg.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2back.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2inve.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2pack.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2dire.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2cbox.tpl", 'smarty_include_vars' => array('VARI' => 'cont')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td class="usna" title="<?php echo $this->_tpl_vars['elem']['usernametran']; ?>
"> <?php echo $this->_tpl_vars['elem']['usnatran']; ?>


		</tr>
	<?php endforeach; endif; unset($_from); ?>
<tr bgcolor="beige">
	<td colspan=""></td>
	<td colspan=""></td>
	<td colspan=""><input id="tranprntall" type="checkbox" onclick="select_all()" title="маркирай/размаркирай всички" /> </td>
	<td align="right"> <b> <?php echo ((is_array($_tmp=$this->_tpl_vars['MAINSUMA'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b></td>
	<td ><font color=red> общо </font></td>
	<td colspan="160"></td>
</tr>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2pagiwosuma.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</table>
										</table>

<script type="text/javascript">
$(document).ready(function() {
	$('.ibac').cluetip({ width: 460, local:true, cursor:'pointer' });
	$('.osno').cluetip({ width: 460, local:true, cursor:'pointer' });
	$('.suma').cluetip({ width: 460, local:true, cursor:'pointer' });
	$('.ttip').cluetip({ width: 360, local:true, cursor:'pointer' });
	$('.budg').cluetip({ width: 360, local:true, cursor:'pointer' });
	$('.buac').cluetip({ width: 320, local:true, cursor:'pointer' });
	$('.case').cluetip({ width: 520, local:true, cursor:'pointer' });
		$("#bali0").addClass("bankcurr");
});
<?php echo '
function fup2(p1){
	fuprin("tranprnt.php?para="+p1);
}
function fuprincode(){
	var list= $("input[class=\'tranprntchck\']");
	var lico= "";
	for (var i=0; i<list.length; i++) {
		if (list[i].checked) {
			lico += list[i].id + "/";
		} else {
		}
	}
	fuprin("tranprnt.php?para=" + lico);
}
function select_all() {
	var el = document.getElementById("tranprntall");
	var list= $("input[class=\'tranprntchck\']");
	for (var i=0; i<list.length; i++) {
		list[i].checked = el.checked;
	}
}
'; ?>

function autocaseyear(event){
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
//alert("code="+code);
	if (code==13){
document.forms['formcaye'].submit();
	}
}


function bankfilt(idbank){
	$(".banklink").each(function(){
		if ($(this).attr("id")=="bali"+idbank){
			$(this).addClass("bankcurr");
		}else{
			$(this).removeClass("bankcurr");
		}
	});
	var list= $("input[@type='checkbox']");
				if (idbank==0){
	$(list).each(function(){
		$(this).show().attr("checked",false);
	});
				}else{
	$(list).each(function(){
		if ($(this).attr("bank")==idbank){
			$(this).show().attr("checked",true);
		}else{
			$(this).hide().attr("checked",false);
		}
	});
				}
	var list= $("a[@bank]");
				if (idbank==0){
	$(list).each(function(){
		$(this).show();
	});
				}else{
	$(list).each(function(){
		if ($(this).attr("bank")==idbank){
			$(this).show();
		}else{
			$(this).hide();
		}
	});
				}
//$("tr[@rel=tr"+pid+"]").show();
//$("input[@type='checkbox']");
}

</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tran2cbacti.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>