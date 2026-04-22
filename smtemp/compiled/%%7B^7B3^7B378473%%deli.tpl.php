<?php /* Smarty version 2.6.9, created on 2020-02-28 11:14:13
         compiled from deli.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'deli.tpl', 84, false),array('modifier', 'truncate', 'deli.tpl', 92, false),array('modifier', 'date_format', 'deli.tpl', 137, false),array('modifier', 'nl2br', 'deli.tpl', 168, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "delihead.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br>
														<?php if (isset ( $this->_tpl_vars['CONT3'] )): ?>
<?php echo $this->_tpl_vars['CONT3']; ?>

														<?php else: ?>
				
				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head1'>
<td colspan='200'>
Списък на изх.документи и екземплярите за връчване
								<?php if ($this->_tpl_vars['ISLIST']): ?>
				<div style="float:right" class="doinpu">
<a style="cursor:pointer;border-bottom:1px solid black;" href="#" onclick="delelist('<?php echo $this->_tpl_vars['LINKDELELIST']; ?>
');"> изчисти списъка </a>
&nbsp;&nbsp;&nbsp;&nbsp;
					<form method="post" onsubmit="return false;"
					style="float:right;margin:0px 0px 0px 6px;padding:0px;width:auto;white-space:nowrap;">
добави изх.номер/год или #плик
<input type="text" name="doutinpu" id="doutinpu" size=16 autocomplete=off
style="font:normal 7pt verdana; border: 0px solid green;" onkeydown="autosubm8(event,this.form);">
+enter
					<?php if (isset ( $this->_tpl_vars['ERDOUT'] )): ?>
<font color=red><?php echo $this->_tpl_vars['ERDOUT']; ?>
</font>
					<?php else: ?>
					<?php endif; ?>
					</form>
				</div>
								<?php else: ?>
								<?php endif; ?>
				<tr class='head2'>
<td colspan=5> изходящ документ
<td>&nbsp;
<td colspan=14> екземпляри
				<tr class='head2'>
<td> номер
<td> тип
<td> дело
<td> деловодител
<td> образ
<td>&nbsp;
<td> изходен
<td> адресат
<td> адрес
<td> метод
<td class="head3"> взет
<td class="head3"> връчен
<td class="head3"> върнат
<td class="head3"> статус
<td class="head3"> бел
<td class="head3"> &nbsp;
<td class="head3"> <input class="cbox" type=checkbox name="cball" id="cball" onclick="cbtran($(this).attr('checked'));">
<td class="head3"> 417
<td class="head3"> свързан док.
<script>
function cbtran(flag){
	if (flag){
		$("input[@name='cbdeli[]']").attr("checked",true);
	}else{
		$("input[@name='cbdeli[]']").attr("checked",false);
	}
}
</script>

											<?php $this->assign('bgco', "*"); ?>
<?php $_from = $this->_tpl_vars['ARDOUT']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['iddout'] => $this->_tpl_vars['eldout']):
?>
								<tr>
											<?php if (empty ( $this->_tpl_vars['bgco'] )): ?>
												<?php $this->assign('bgco', "bgcolor='#dddddd'"); ?>
											<?php else: ?>
												<?php $this->assign('bgco', ""); ?>
											<?php endif; ?>
				<?php $this->assign('docoun', $this->_tpl_vars['ARPOSTCOUN'][$this->_tpl_vars['iddout']]); ?>
				<?php $this->assign('rs2', ((is_array($_tmp="rowspan=")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['docoun']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['docoun']))); ?>
<td <?php echo $this->_tpl_vars['bgco']; ?>
 <?php echo $this->_tpl_vars['rs2']; ?>
 class="spec" title="<?php echo $this->_tpl_vars['iddout']; ?>
">
<nobr>
<?php echo $this->_tpl_vars['eldout']['d2seri']; ?>
/<?php echo $this->_tpl_vars['eldout']['d2year']; ?>

				<a href="file:///<?php echo $this->_tpl_vars['LETDOC']; ?>
:/<?php echo $this->_tpl_vars['iddout']; ?>
.doc" target="_blank">
				<img src="images/word.gif" title="корегирай/изведи">
				</a>
</nobr>
<td <?php echo $this->_tpl_vars['bgco']; ?>
 <?php echo $this->_tpl_vars['rs2']; ?>
 class="spec" title="<?php echo $this->_tpl_vars['eldout']['d2text']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['eldout']['d2text'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>

					<?php if (empty ( $this->_tpl_vars['eldout']['caseri'] )): ?>
<td <?php echo $this->_tpl_vars['bgco']; ?>
 <?php echo $this->_tpl_vars['rs2']; ?>
 class="spec"> 
&nbsp;
					<?php else: ?>
<td <?php echo $this->_tpl_vars['bgco']; ?>
 <?php echo $this->_tpl_vars['rs2']; ?>
 class="case" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['eldout']['tocase'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> title="виж изх.документи по делото"> 
<?php echo $this->_tpl_vars['eldout']['caseri']; ?>
/<?php echo $this->_tpl_vars['eldout']['cayear']; ?>

					<?php endif; ?>
<td <?php echo $this->_tpl_vars['bgco']; ?>
 <?php echo $this->_tpl_vars['rs2']; ?>
 class="spec"> <?php echo $this->_tpl_vars['eldout']['username']; ?>

		<td <?php echo $this->_tpl_vars['bgco']; ?>
 <?php echo $this->_tpl_vars['rs2']; ?>
 class="spec">
<nobr>
<a href="<?php echo $this->_tpl_vars['eldout']['scanuplo']; ?>
" class="nyroModal" target="_blank"><img src="images/include.gif" title="качи изображение"></a>
							<?php $this->assign('iddocu', $this->_tpl_vars['eldout']['iddout']); ?>
					<?php $this->assign('scancoun', $this->_tpl_vars['eldout']['coundout']); ?>
				<?php if ($this->_tpl_vars['scancoun'] == 0): ?>
&nbsp;
		<?php else: ?>
<img src="images/tranclos.gif" style="cursor:pointer" title="изображения за <?php echo $this->_tpl_vars['eldout']['d2text']; ?>
 <?php echo $this->_tpl_vars['eldout']['d2seri']; ?>
/<?php echo $this->_tpl_vars['eldout']['d2year']; ?>
" 
onclick="w2=window.open('<?php echo $this->_tpl_vars['eldout']['scanview']; ?>
','win2');w2.focus();">
			<?php if ($this->_tpl_vars['scancoun'] == 1): ?>
			<?php else: ?>
<sup class="fon7"><?php echo $this->_tpl_vars['scancoun']; ?>
</sup>
			<?php endif; ?>
		<?php endif; ?>
</nobr>
		<td <?php echo $this->_tpl_vars['rs2']; ?>
 class="spec">&nbsp;
				<?php $this->assign('isfirst', true); ?>
	<?php $_from = $this->_tpl_vars['ARPOST'][$this->_tpl_vars['iddout']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idpost'] => $this->_tpl_vars['elpost']):
?>
				<?php if ($this->_tpl_vars['isfirst']): ?>
				<?php else: ?>
					<tr>
				<?php endif; ?>
<td <?php echo $this->_tpl_vars['bgco']; ?>
 class="fon7 mark" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['elpost']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M:%S") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M:%S")); ?>
 от <?php echo $this->_tpl_vars['elpost']['postuser']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elpost']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td <?php echo $this->_tpl_vars['bgco']; ?>
> <?php echo $this->_tpl_vars['elpost']['adresat']; ?>
&nbsp;
<td <?php echo $this->_tpl_vars['bgco']; ?>
> <?php echo $this->_tpl_vars['elpost']['address']; ?>
&nbsp;
<td <?php echo $this->_tpl_vars['bgco']; ?>
> <?php echo $this->_tpl_vars['ARPOSTTYPE_2'][$this->_tpl_vars['elpost']['idposttype']]; ?>
&nbsp;
						<td <?php echo $this->_tpl_vars['bgco']; ?>
 class="fon7"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elpost']['date1'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
&nbsp;
<td <?php echo $this->_tpl_vars['bgco']; ?>
 class="fon7"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elpost']['date2'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
&nbsp;
<td <?php echo $this->_tpl_vars['bgco']; ?>
 class="fon7"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elpost']['date3'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
&nbsp;
<td <?php echo $this->_tpl_vars['bgco']; ?>
 <?php if ($this->_tpl_vars['elpost']['isertype']): ?>class="ertype" title="статуса не отговаря на метода"<?php else:  endif; ?>> <?php echo $this->_tpl_vars['elpost']['statname']; ?>
&nbsp;
<td <?php echo $this->_tpl_vars['bgco']; ?>
 class="ctip" align=center style="cursor:pointer"
onclick="$.nyroModalManual({forceType:'iframe',url:'<?php echo $this->_tpl_vars['elpost']['postnote']; ?>
'});"
rel="#note<?php echo $this->_tpl_vars['idpost']; ?>
" title="бележки"> 
					<?php if (empty ( $this->_tpl_vars['elpost']['notes'] )): ?>
-
					<?php else: ?>
<img src="images/info.gif">
					<?php endif; ?>
</td>
<span id="note<?php echo $this->_tpl_vars['idpost']; ?>
" style="display: none">
			<?php if (empty ( $this->_tpl_vars['elpost']['notes'] )): ?>
няма бележки
			<?php else: ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['elpost']['notes'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

			<?php endif; ?>
<hr>
<font color=blue>клик за корекция</font>
</span>
		<td>
<nobr>
			<?php if ($this->_tpl_vars['elpost']['isdubl'] == 0): ?>
<img src="images/change.gif" style="cursor:pointer;" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elpost']['postdubl'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> title="дублирай екземпляра"> 
			<?php else: ?>
<img src="images/free.gif" style="cursor:pointer;" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elpost']['postdele'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> title="изтрий дублирания екземпляр"> 
			<?php endif; ?>
									<?php if ($this->_tpl_vars['elpost']['nopostdata']): ?>
<a href="<?php echo $this->_tpl_vars['elpost']['postedit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
									<?php else: ?>
									<?php endif; ?>
&nbsp;
</nobr>
		<td align=center>
<input class="cbox" type=checkbox name="cbdeli[]" value="<?php echo $this->_tpl_vars['idpost']; ?>
" id="<?php echo $this->_tpl_vars['idpost']; ?>
">
					<?php if ($this->_tpl_vars['isfirst']): ?>
<td <?php echo $this->_tpl_vars['bgco']; ?>
 <?php echo $this->_tpl_vars['rs2']; ?>
 align=center class="head2" style="cursor:help;"
onmouseover="this.style.backgroundColor='aquamarine';" onmouseout="this.style.backgroundColor='';"
title="дело <?php echo $this->_tpl_vars['eldout']['d2seri']; ?>
/<?php echo $this->_tpl_vars['eldout']['d2year']; ?>
 &#013;идва от <?php echo $this->_tpl_vars['eldout']['rsname']; ?>
 &#013;
титул <?php echo $this->_tpl_vars['ARTITU'][$this->_tpl_vars['eldout']['casetitu']]; ?>
 &#013;подтитул <?php echo $this->_tpl_vars['ARSUBT'][$this->_tpl_vars['eldout']['casesubt']]; ?>
 &#013;тип <?php echo $this->_tpl_vars['eldout']['d2text']; ?>
">
<span style="<?php if ($this->_tpl_vars['eldout']['isinterest'] == 0):  else: ?>background-color:orange !important;<?php endif; ?>"> 
&nbsp;&diams;&nbsp;</span>
			<?php else: ?>
			<?php endif; ?>
		<td <?php echo $this->_tpl_vars['bgco']; ?>
 class="head2 fon7"> 
	<?php if ($this->_tpl_vars['eldout']['isinterest'] == 0): ?>
							<?php $this->assign('idpp', $this->_tpl_vars['elpost']['idpp']); ?>
					<?php $this->assign('ropd', $this->_tpl_vars['ARPP'][$this->_tpl_vars['idpost']]); ?>
		<?php if (empty ( $this->_tpl_vars['ropd'] )): ?>
&nbsp;
		<?php else: ?>
			ПДИ <?php echo $this->_tpl_vars['ropd']['doutseri']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['ropd']['doutcrea'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<?php echo $this->_tpl_vars['ARPOSTTYPE'][$this->_tpl_vars['ropd']['idmeth']]; ?>

		<?php endif; ?>
	<?php else: ?>
				<?php if (empty ( $this->_tpl_vars['elpost']['p2id'] )): ?>
			<?php if ($this->_tpl_vars['elpost']['idpoststat'] == 0): ?>
<span style="cursor:help;" title="може да формирате ПП след връчване">п</span>
			<?php else: ?>
<a href="<?php echo $this->_tpl_vars['elpost']['creapp']; ?>
" class="nyroModal" target="_blank"><img src="images/editcont.gif" title="формирай придруж.писмо"></a>
			<?php endif; ?>
		<?php else: ?>
ПП <?php echo $this->_tpl_vars['elpost']['doutseri']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['elpost']['doutcrea'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<?php echo $this->_tpl_vars['ARPOSTTYPE'][$this->_tpl_vars['elpost']['idmeth']]; ?>

		<?php endif; ?>
	<?php endif; ?>
					<?php $this->assign('isfirst', false); ?>
	<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2pagi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<tr>
<td colspan=20>
	<div style="float:right">
	само в маркираните документи
<br>
<div class="link butt" onclick="fubegi('<?php echo $this->_tpl_vars['LINKEDIT']; ?>
');"> корегирай полета </div>
<div class="link butt" onclick="fubegi('<?php echo $this->_tpl_vars['LINKCLEAR']; ?>
');"> изчисти полета </div>
	</div>

				</table>
																												<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "deli.inc.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
function delelist(link){
	var resu= confirm('ВНИМАНИЕ\\nПотвърди изтриването на целия списък');
	if (resu){
		document.location.href= link;
	}else{
	}
}
function autosubm8(event,form){
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
form.submit();
	}else if(code==17 || code==74){
		event.preventDefault();
	}else{
	}
}
$(document).ready(function() {
	$('.ctip').cluetip({ width: 300, local:true, cursor:'pointer' });
								<?php if ($this->_tpl_vars['ISLIST']): ?>
	$("#doutinpu").focus();
								<?php else: ?>
								<?php endif; ?>
});
</script>
