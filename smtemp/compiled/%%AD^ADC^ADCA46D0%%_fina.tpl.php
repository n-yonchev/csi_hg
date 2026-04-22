<?php /* Smarty version 2.6.9, created on 2020-02-27 15:22:33
         compiled from _fina.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney2', '_fina.tpl', 150, false),array('modifier', 'cat', '_fina.tpl', 157, false),array('modifier', 'date_format', '_fina.tpl', 228, false),array('modifier', 'tomoney', '_fina.tpl', 400, false),)), $this); ?>
<style>
.head {font:normal 7pt verdana; background-color:#efefef; border-right: 1px solid #cdcdcd; border-bottom: 1px solid #cdcdcd;}
</style>

	<tr>
				<?php if ($this->_tpl_vars['HIST']): ?>
				<?php else: ?>
<td class="head" align=center> 
<td class="head" align=center> <img src="images/print.gif" title="отпечати маркираните" style="cursor:pointer" onclick="fuprincode();">
				<?php endif; ?>
<td class="head" align=right> сума
							<?php if ($this->_tpl_vars['HIST']): ?>
<td class="head"> тип
							<?php else: ?>
<td class="head"> 
тип
							<?php endif; ?>
				<?php if ($this->_tpl_vars['HIST']): ?>
				<?php else: ?>
<td class="head" align=center> 
време
				<?php endif; ?>
<td class="head"> &nbsp;
				<?php if ($this->_tpl_vars['HIST']): ?>
<td class="head" colspan=3> 
корекция
				<?php else: ?>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['HIST']): ?>
				<?php else: ?>
<td class="head">&nbsp;</td>
<td class="head">исто<br>рия</td>
				<?php endif; ?>
							<?php if ($this->_tpl_vars['HIST']): ?>
<td class="head" align=center> дело
<td class="head" align=center> деловодител
<td class="head" colspan=2> заЧСИ
							<?php else: ?>
<td class="head" align=center>
дело
			<?php if ($this->_tpl_vars['SINGLEUSER']): ?>
<td class="head" align=center> деловодител
			<?php else: ?>
<td class="head" align=center>
деловодител
			<?php endif; ?>
<td class="head" align=center colspan=2>
заЧСИ
							<?php endif; ?>
<td class="head" align=center>заВзиск</td>
<td class="head" align=center>връ<br>щане</td>
					<?php if ($this->_tpl_vars['ISBANKTAX']): ?>
<td class="head" align=center>банк<br>такси</td>
					<?php else: ?>
					<?php endif; ?>
<td class="head" align=center>нераз<br>пред</td>
							<?php if ($this->_tpl_vars['HIST']): ?>
<td class="head" align=center> при<br>ключ 
							<?php else: ?>
<td class="head" align=center>
при<br>ключ
</td>
							<?php endif; ?>
				<?php if ($this->_tpl_vars['HIST']): ?>
				<?php else: ?>
<td class="head" align=center> &nbsp; </td>
				<?php endif; ?>
<td class="head" align=center>дата погасяв</td>
	</tr>

<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
						<?php $this->assign('myid', $this->_tpl_vars['elem']['id']); ?>
	<tr onmouseover='this.className="trdocu";' onmouseout='this.className="";' >
				<?php if ($this->_tpl_vars['HIST']): ?>
				<?php else: ?>
<td valign=top align=center> 
												<?php if (empty ( $this->_tpl_vars['elem']['susp'] )): ?>
<img src="images/print.gif" title="отпечати" style="cursor:pointer" onclick="fup2('<?php echo $this->_tpl_vars['elem']['prntcode']; ?>
/');">
<td valign=top align=center> <input type=checkbox id="<?php echo $this->_tpl_vars['elem']['prntcode']; ?>
">
						<?php else: ?>
<td valign=top align=center> 
<font color=red><?php echo $this->_tpl_vars['elem']['susp']; ?>
</font>
						<?php endif; ?>
				<?php endif; ?>
<td class="head" valign=top align=right> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['inco'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b>
				<?php $this->assign('idtype', $this->_tpl_vars['elem']['idtype']); ?>
				<?php if ($this->_tpl_vars['idtype'] == 1): ?>
					<?php $this->assign('finaba', ((is_array($_tmp="/")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elem']['sour']['idfinabank']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elem']['sour']['idfinabank']))); ?>
				<?php else: ?>
					<?php $this->assign('finaba', ""); ?>
				<?php endif; ?>
<td valign=top> <nobr><?php echo ((is_array($_tmp=$this->_tpl_vars['ARTYPE'][$this->_tpl_vars['idtype']])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['finaba']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['finaba'])); ?>
 </nobr></td>
				<?php if ($this->_tpl_vars['HIST']): ?>
				<?php else: ?>
<td valign=top align=left>
						<?php if ($this->_tpl_vars['idtype'] == 1): ?>
<nobr>
<?php echo $this->_tpl_vars['elem']['sour']['date']; ?>
 <?php echo $this->_tpl_vars['elem']['sour']['hour']; ?>

</nobr>
						<?php elseif ($this->_tpl_vars['idtype'] == 2): ?>
<nobr>
<?php echo $this->_tpl_vars['elem']['cashdate']; ?>

</nobr>
						<?php else: ?>
&nbsp;
						<?php endif; ?>
				<?php endif; ?>
<td align=center valign=top>
				<?php if ($this->_tpl_vars['idtype'] == 1): ?>
<img src="images/view.png" class="ttip" rel="#cont<?php echo $this->_tpl_vars['myid']; ?>
" title="ред от извлечението" style="cursor:help">
<span id="cont<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
	<table align=center>
	<tr>
	<td align=left valign=top> време
	<td width=10>
<td> <b><?php echo $this->_tpl_vars['elem']['sour']['date']; ?>
 <?php echo $this->_tpl_vars['elem']['sour']['hour']; ?>
</b>
	<tr>
	<td align=left valign=top> постъпление
	<td width=10>
<td> <b><?php echo $this->_tpl_vars['elem']['sour']['amount']; ?>
</b>
	<tr>
	<td align=left valign=top> описание
	<td width=10>
<td> <b><?php echo $this->_tpl_vars['elem']['sour']['desc1']; ?>
</b>
	<tr>
	<td align=left valign=top> кореспондент
	<td width=10>
<td> <b><?php echo $this->_tpl_vars['elem']['sour']['desc2']; ?>
</b>
	<tr>
	<td align=left valign=top> основание
	<td width=10>
<td> <b><?php echo $this->_tpl_vars['elem']['sour']['desc3']; ?>
</b>
	<tr>
	<td align=left valign=top> пояснения
	<td width=10>
<td> <b><?php echo $this->_tpl_vars['elem']['sour']['desc4']; ?>
</b>
	<tr>
	<td align=left valign=top> референция
	<td width=10>
<td> <b><?php echo $this->_tpl_vars['elem']['sour']['reference']; ?>
</b>
	</table>
</span>
				<?php else: ?>
					<?php if (empty ( $this->_tpl_vars['elem']['descrip'] )): ?>
					<?php else: ?>
<img src="images/view.png" title="<?php echo $this->_tpl_vars['elem']['descrip']; ?>
" style="cursor:help">
					<?php endif; ?>
				<?php endif; ?>
</td>
				<?php if ($this->_tpl_vars['HIST']): ?>
<td valign=top> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td valign=top> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M:%S") : smarty_modifier_date_format($_tmp, "%H:%M:%S")); ?>

<td valign=top> <nobr><?php echo $this->_tpl_vars['elem']['finaname']; ?>
</nobr>
				<?php else: ?>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['HIST']): ?>
				<?php else: ?>
<td align=left valign=top>
	<?php if ($this->_tpl_vars['elem']['isclosed'] == 1): ?>
<img src="images/info.gif" class="info" rel="<?php echo $this->_tpl_vars['elem']['info']; ?>
" title="информация за приключено постъпление" style="cursor:help">
	<?php else: ?>
<nobr>
<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
			<?php if (isset ( $this->_tpl_vars['elem']['igno'] )): ?>
<a href="<?php echo $this->_tpl_vars['elem']['igno']; ?>
" class="nyroModal" target="_blank"><img src="images/ignore.gif" title="игнорирай"></a>
			<?php else: ?>
			<?php endif; ?>
</nobr>
	<?php endif; ?>
</td>
<td align=center valign=top>
<span id="hist<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
			<?php if ($this->_tpl_vars['elem']['histcoun'] == 0): ?>
записа е въведен
			<?php else: ?>
последната корекция е направена
			<?php endif; ?>
<br>
от <b><?php echo $this->_tpl_vars['elem']['finaname']; ?>
</b>
<br>
на <b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b> в <b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M:%S") : smarty_modifier_date_format($_tmp, "%H:%M:%S")); ?>
</b>
			<?php if ($this->_tpl_vars['elem']['histcoun'] == 0): ?>
			<?php else: ?>
<br>
<br>
<b>кликни, за да видиш цялата история</b>
			<?php endif; ?>
</span>
			<?php if ($this->_tpl_vars['elem']['histcoun'] == 0): ?>
&nbsp;&nbsp;
<img src="images/hist.gif" class="hist" rel="#hist<?php echo $this->_tpl_vars['myid']; ?>
" title="създаване" style="cursor:help">
</td>
			<?php else: ?>
<a href="<?php echo $this->_tpl_vars['elem']['hist']; ?>
" class="nyroModal" target="_blank">
<nobr>
&nbsp;
<span class="finahist" rel="#hist<?php echo $this->_tpl_vars['myid']; ?>
" title="история на корекциите"><?php echo $this->_tpl_vars['elem']['histcoun']; ?>
</span>
</nobr>
</a></td>
			<?php endif; ?>

				<?php endif; ?>
				<?php if ($this->_tpl_vars['HIST']): ?>
<td align=left valign=top>
	<?php if (empty ( $this->_tpl_vars['elem']['caseseri'] ) && empty ( $this->_tpl_vars['elem']['caseyear'] )): ?>
&nbsp;
	<?php else:  echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>

	<?php endif; ?>
</td>
				<?php else: ?>
			<?php if (empty ( $this->_tpl_vars['elem']['idcase'] )): ?>
<td align=center valign=top>
<a href="<?php echo $this->_tpl_vars['elem']['direcase']; ?>
"> <img src="images/direcase.gif" title="избери дело">
</a></td>
			<?php else: ?>
														<?php if ($this->_tpl_vars['elem']['isauto'] == 0): ?>
<td align=left valign=top>
<span class="finahist" title="виж делото" onclick="document.location.href='<?php echo $this->_tpl_vars['elem']['viewcase']; ?>
'; return false;">
<?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>
 </span>
</td>
							<?php elseif ($this->_tpl_vars['elem']['isauto'] == 1): ?>
<td align=left valign=top>
<span class="finahistauto" title="виж автоматично назнач.дело" onclick="document.location.href='<?php echo $this->_tpl_vars['elem']['viewcase']; ?>
'; return false;">
<?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>
 </span>
</td>
							<?php else: ?>
<td align=left valign=top>
<span class="finahistauto2" title="виж автоматично назнач.дело" onclick="document.location.href='<?php echo $this->_tpl_vars['elem']['viewcase']; ?>
'; return false;">
<?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>
 </span>
</td>
							<?php endif; ?>
			<?php endif; ?>
				<?php endif; ?>
<td align=left valign=top> <?php echo $this->_tpl_vars['elem']['username']; ?>
 &nbsp; </td>
<td align=right valign=top> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['separa'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
 &nbsp; </td>
<td align=right valign=top> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['separa2'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
 &nbsp; </td>

<td align=right valign=top bgcolor=wheat class="ttip" style="cursor:help" rel="#clai<?php echo $this->_tpl_vars['myid']; ?>
" title="разпределени суми по взискатели"> 
	<?php if (count ( $this->_tpl_vars['elem']['clailist'] ) == 0): ?>
<b>-</b>
	<?php else: ?>
<b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['claisuma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
 &nbsp;</b>
	<?php endif; ?>
<span id="clai<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
		<table>
		<?php $_from = $this->_tpl_vars['elem']['clailist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idclai'] => $this->_tpl_vars['clainame']):
?>
			<?php $this->assign('myamou', $this->_tpl_vars['elem']['claiamou'][$this->_tpl_vars['idclai']]); ?>
		<tr>
<td> <?php echo $this->_tpl_vars['clainame']; ?>

<td> <b><?php if ($this->_tpl_vars['myamou'] == 0): ?>-<?php else:  echo $this->_tpl_vars['myamou'];  endif; ?></b>
		<?php endforeach; endif; unset($_from); ?>
		</table>
</span>
</td>

<td align=right valign=top> 
	<?php if ($this->_tpl_vars['elem']['back'] == 0): ?>
-
	<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['elem']['back'])) ? $this->_run_mod_handler('tomoney', true, $_tmp, 2) : smarty_modifier_tomoney($_tmp, 2)); ?>

	<?php endif; ?>
</td>
					<?php if ($this->_tpl_vars['ISBANKTAX']): ?>
<td align=right valign=top> 
	<?php if ($this->_tpl_vars['elem']['banktax'] == 0): ?>
-
	<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['elem']['banktax'])) ? $this->_run_mod_handler('tomoney', true, $_tmp, 2) : smarty_modifier_tomoney($_tmp, 2)); ?>

	<?php endif; ?>
</td>
					<?php else: ?>
					<?php endif; ?>

<td align=right valign=top> 
	<?php if ($this->_tpl_vars['elem']['rest'] == 0): ?>
-
	<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['elem']['rest'])) ? $this->_run_mod_handler('tomoney', true, $_tmp, 2) : smarty_modifier_tomoney($_tmp, 2)); ?>

	<?php endif; ?>
</td>

<td align=center>
	<?php if ($this->_tpl_vars['elem']['idcase'] <> 0 && $this->_tpl_vars['elem']['rest'] == 0): ?>
		<?php if ($this->_tpl_vars['elem']['isclosed'] == 1): ?>
<span class="yes" title="ПРИКЛЮЧЕНО на <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['timeclosed'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
">&nbsp;</span>
		<?php else: ?>
&nbsp;
		<?php endif; ?>
	<?php else: ?>
<span class="no" title="приключването е невъзможно">&nbsp;</span>
	<?php endif; ?>
</td>

				<?php if ($this->_tpl_vars['HIST']): ?>
				<?php else: ?>
<td align=center>
	<?php if ($this->_tpl_vars['elem']['idcase'] <> 0 && $this->_tpl_vars['elem']['rest'] == 0): ?>
		<?php if ($this->_tpl_vars['elem']['isclosed'] == 1): ?>
&nbsp;
		<?php else: ?>
												<?php if ($this->_tpl_vars['CASEUSER'] && $this->_tpl_vars['elem']['idtype'] <> 9 && $this->_tpl_vars['elem']['idtype'] <> 7): ?>
<span class="no2" title="финансиста може да го приключи">&nbsp;</span>
			<?php else: ?>
								<?php if (empty ( $this->_tpl_vars['elem']['lockname'] )): ?>
<a href="<?php echo $this->_tpl_vars['elem']['clos']; ?>
" class="nyroModal" target="_blank"><img src="images/clos.gif" title="приключи"></a>
								<?php else: ?>
<a href="<?php echo $this->_tpl_vars['elem']['clos']; ?>
" class="nyroModal" target="_blank"><img src="images/clos2.gif" title="приключи след като <?php echo $this->_tpl_vars['elem']['lockname']; ?>
 затвори делото"></a>
								<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php else: ?>
&nbsp;
	<?php endif; ?>
</td>
				<?php endif; ?>

<td align=left>
	<?php if ($this->_tpl_vars['elem']['idcase'] <> 0 && $this->_tpl_vars['elem']['rest'] == 0): ?>
		<?php if ($this->_tpl_vars['elem']['isclosed'] == 1): ?>
			<?php if (empty ( $this->_tpl_vars['elem']['datebala'] )): ?>
				<?php $this->assign('daco', "няма"); ?>
				<?php $this->assign('dast', 'finahistno'); ?>
			<?php else: ?>
				<?php $this->assign('daco', ((is_array($_tmp=$this->_tpl_vars['elem']['datebala'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y"))); ?>
				<?php $this->assign('dast', 'finahist'); ?>
			<?php endif; ?>
				<?php if ($this->_tpl_vars['HIST']):  echo $this->_tpl_vars['daco']; ?>

				<?php else: ?>
<a href="<?php echo $this->_tpl_vars['elem']['date']; ?>
" class="nyroModal" target="_blank">
<span class="<?php echo $this->_tpl_vars['dast']; ?>
" title="корегирай датата"> <?php echo $this->_tpl_vars['daco']; ?>

</span></a>
				<?php endif; ?>
		<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['elem']['datebala'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

		<?php endif; ?>
	<?php else: ?>
&nbsp;
	<?php endif; ?>
</td>

	</tr>
<?php endforeach; endif; unset($_from); ?>

				<?php if ($this->_tpl_vars['HIST']): ?>
				<?php else: ?>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {
	$('.ttip').cluetip({ width: 300, local:true, cursor:'pointer' });
	$('.hist').cluetip({ width: 240, local:true, cursor:'pointer' });
	$('.finahist').cluetip({ width: 240, local:true, cursor:'pointer' });
$('.filt1').cluetip({
//	cluetipClass: 'rounded', 
	arrows: true, 
	width: 220,
	sticky: true,
	mouseOutClose: true,
	closeText: '<b>x</b>',
	closePosition: 'title'
	});
$('.info').cluetip({ width: 360, cursor:'help' });
});
function fup2(p1){
	fuprin("finaprnt.php?para="+p1);
}
function fuprincode(){
	var list= $("input[@type='checkbox']");
	var lico= "";
	for (var i=0; i<list.length; i++){
		if (list[i].checked){
			lico += list[i].id+"/";
		}else{
		}
	}
//alert(lico);
	fuprin("finaprnt.php?para="+lico);
}
</script>
				<?php endif; ?>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {
	$('.ttip').cluetip({ width: 280, local:true, cursor:'pointer' });
});
</script>