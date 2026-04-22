<?php /* Smarty version 2.6.9, created on 2020-02-27 15:22:10
         compiled from finaedit.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'finaedit.ajax.tpl', 107, false),array('modifier', 'tomoney', 'finaedit.ajax.tpl', 256, false),array('modifier', 'date_format', 'finaedit.ajax.tpl', 298, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  if ($this->_tpl_vars['EDIT'] == 0): ?>
	<?php $this->assign('_title', 'въведи ново постъпление');  else: ?>
	<?php $this->assign('_title', 'корегирай постъпление');  endif;  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.header.tpl", 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['_title'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

								<font color=red><span id="<?php echo $this->_tpl_vars['NYREMO']['idzone']; ?>
"></span></font>
				
				<table>
				<tr>
<td>
тип
<br>
		<?php if ($_POST['idtype'] == 1 && $this->_tpl_vars['ISNOMANUAL']): ?>
				<b><?php echo $this->_tpl_vars['ARTYPE'][$_POST['idtype']]; ?>
</b>
<input type="hidden" name="idtype" id="idtype">
		<?php else: ?>
								<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARTYPENAME'],'ID' => 'idtype','C1' => 'input','C2' => 'inputer','ONCH' => "typechan();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>

								<td width=10>
<td>
дата на постъпление
<br>
<input type="text" name="dateinco" id="dateinco" size=14 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'dateinco','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>

				<tr>
				<td colspan=5>
<div id="t2" class="inputcont" style="display: none; padding: 6px">
				<table align=center>
				<tr>
				<td align=left colspan=6>
	за приходния касов ордер
		<?php if ($this->_tpl_vars['EDIT'] == 0): ?>
				<tr>
				<td align=left colspan=6>
<nobr>
<input type="checkbox" name="getnext" id="getnext" onclick="chancrea();">
вземи поредния изходящ номер за <?php echo $this->_tpl_vars['CURRYEAR']; ?>
г. - евентуално <b><?php echo $this->_tpl_vars['NEXTNUMB']; ?>
</b>
</nobr>
	<div id="seriente" style="display: block;">
<nobr>
<input type="text" name="serinome" id="serinome" size=8 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'serinome','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
или въведи тук желания изходящ номер за <?php echo $this->_tpl_vars['CURRYEAR']; ?>
г.
</nobr>
	</div>
		<?php else: ?>
				<tr>
				<td align=right>
	изх.номер/<?php echo $this->_tpl_vars['CURRYEAR']; ?>
г.
				<td width=10>
				<td>
<input type="text" name="serinome" id="serinome" class="input" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'serinome','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
		<?php endif; ?>
				<tr>
				<td align=right>
	дата
				<td width=10>
				<td>
<input type="text" name="cashdate" id="cashdate" class="input" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'cashdate','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				<tr>
				<td align=right>
	вносител
				<td width=10>
				<td>
<input type="text" name="cashname" id="cashname" class="input" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'cashname','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				</table>
</div>

<div id="t9" class="inputcont" style="display: none; padding: 6px">
			<?php if (isset ( $this->_tpl_vars['CLAIONE'] )): ?>
				<?php $_from = $this->_tpl_vars['CLAIONE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['claikey'] => $this->_tpl_vars['clainame']):
?>
взискател <b><?php echo $this->_tpl_vars['clainame']; ?>
</b>
<input type="hidden" name="idclaimer" id="idclaimer" value="<?php echo $this->_tpl_vars['claikey']; ?>
">
				<?php endforeach; endif; unset($_from); ?>
			<?php else: ?>
избери взискател
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['CLAISELENAME'],'ID' => 'idclaimer','C1' => 'input','C2' => 'inputer','ONCH' => "typechan();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
</div>

		<tr>
		<td valign=top>
сума
<br>
																	<?php if ($this->_tpl_vars['ISSOURCE']): ?>
					<?php $this->assign('incoch', ((is_array($_tmp=((is_array($_tmp="nochange(this,'")) ? $this->_run_mod_handler('cat', true, $_tmp, $_POST['inco']) : smarty_modifier_cat($_tmp, $_POST['inco'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "');") : smarty_modifier_cat($_tmp, "');"))); ?>
					<?php $this->assign('incobl', ((is_array($_tmp=((is_array($_tmp="this.value='")) ? $this->_run_mod_handler('cat', true, $_tmp, $_POST['inco']) : smarty_modifier_cat($_tmp, $_POST['inco'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "';") : smarty_modifier_cat($_tmp, "';"))); ?>
				<?php else: ?>
				<?php endif; ?>
<input type="text" name="inco" id="inco" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'inco','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
onfocus="<?php echo $this->_tpl_vars['incoch']; ?>
" onkeydown="<?php echo $this->_tpl_vars['incoch']; ?>
" onblur="<?php echo $this->_tpl_vars['incobl']; ?>
"> 
						<?php if ($this->_tpl_vars['ISSETCASE']): ?>
		<td>
		<td valign=top>
от името на кой длъжник
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARDEBTNAME'],'ID' => 'iddebtor','C1' => 'input','C2' => 'inputer','ONCH' => "putcashname(true);")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php else: ?>
						<?php endif; ?>
		</table>
	
описание <?php if (isset ( $this->_tpl_vars['LISTER']['descrip'] )): ?><font color=red><?php echo $this->_tpl_vars['LISTER']['descrip']; ?>
</font><?php endif; ?>
<br>
<textarea class="input" name="descrip" id="descrip" rows=4 cols=50></textarea>
		<?php if ($this->_tpl_vars['CALLFROMCASE']): ?>
			<?php $this->assign('postcase', $_POST['idcase']); ?>
<input type="hidden" name="idcase" id="idcase" value="<?php echo $this->_tpl_vars['postcase']; ?>
"> 
			<?php if (empty ( $this->_tpl_vars['postcase'] )): ?>
			<?php else: ?>
<br>
дело <b><?php echo $this->_tpl_vars['postcase']; ?>
</b>
<br>
			<?php endif; ?>
		<?php else: ?>
<br>
дело
<br>
<input type="text" name="idcase" id="idcase" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'idcase','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
		<?php endif; ?>
				<?php if (empty ( $_POST['idcase'] ) || isset ( $this->_tpl_vars['LISTER']['idcase'] )): ?>
<br>
				<?php else: ?>
		<fieldset class="filtgr" id="zonedist">
		<legend align=right> разпределение на постъплението </legend>
		<div style="float:left;width:49%">
за ЧСИ неолихв.суми
<br>
<input type="text" name="separa" id="separa" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'separa','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
onkeyup="jourdata();" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "finaeditc2.tpl", 'smarty_include_vars' => array('FINAME' => 'separa')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
> 
		</div>
		<div style="float:left;width:49%">
за ЧСИ т.26
<br>
<input type="text" name="separa2" id="separa2" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'separa2','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
onkeyup="jourdata();" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "finaeditc2.tpl", 'smarty_include_vars' => array('FINAME' => 'separa2')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
> 
		</div>
		<?php if (count ( $this->_tpl_vars['CLAILIST'] ) == 0): ?>
<br>
няма взискатели
	<?php else: ?>
		<?php $_from = $this->_tpl_vars['CLAILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idclai'] => $this->_tpl_vars['clainame']):
?>
			<?php $this->assign('claipostname', ((is_array($_tmp=$this->_tpl_vars['CLAIPREF'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['idclai']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['idclai']))); ?>
			<?php $this->assign('claiposttaxname', ((is_array($_tmp=$this->_tpl_vars['CLAITAXPREF'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['idclai']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['idclai']))); ?>
<br>
за взискател <?php echo $this->_tpl_vars['clainame']; ?>

<br>
<input type="text" name="<?php echo $this->_tpl_vars['claipostname']; ?>
" id="<?php echo $this->_tpl_vars['claipostname']; ?>
" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => $this->_tpl_vars['claipostname'],'C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "finaeditc2.tpl", 'smarty_include_vars' => array('FINAME' => $this->_tpl_vars['claipostname'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  if ($this->_tpl_vars['ISBANKTAX']): ?>onkeyup="moditax('<?php echo $this->_tpl_vars['claipostname']; ?>
');creasum(); return true;"<?php else:  endif; ?>
> 
					<?php if ($this->_tpl_vars['ISBANKTAX']): ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<span class="inp7bold">банк.такса</span>
<input type="text" name="<?php echo $this->_tpl_vars['claiposttaxname']; ?>
" id="<?php echo $this->_tpl_vars['claiposttaxname']; ?>
" size=4 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => $this->_tpl_vars['claiposttaxname'],'C1' => 'inp7bold','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  if ($this->_tpl_vars['ISBANKTAX']): ?>onkeyup="creasum(); return true;"<?php else:  endif; ?>
>
					<?php else: ?>
					<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	<br>
за връщане
<br>
<input type="text" name="back" id="back" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'back','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
onkeyup="jourdata();" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "finaeditc2.tpl", 'smarty_include_vars' => array('FINAME' => 'back')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  if ($this->_tpl_vars['ISBANKTAX']): ?>onkeyup="moditax('back');creasum(); return true;"<?php else:  endif; ?>
> 
					<?php if ($this->_tpl_vars['ISBANKTAX']): ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<span class="inp7bold">банк.такса</span>
<input type="text" name="backtax" id="backtax" size=4 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'backtax','C1' => 'inp7bold','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  if ($this->_tpl_vars['ISBANKTAX']): ?>onkeyup="creasum(); return true;"<?php else:  endif; ?>
>
					<?php else: ?>
					<?php endif; ?>
		<?php if (isset ( $this->_tpl_vars['DISTTOTA'] )): ?>
<br>
общо разпределена сума <b><?php echo ((is_array($_tmp=$this->_tpl_vars['DISTTOTA'])) ? $this->_run_mod_handler('tomoney', true, $_tmp, 2) : smarty_modifier_tomoney($_tmp, 2)); ?>
</b>
	<?php else: ?>
	<?php endif; ?>
					<?php if ($this->_tpl_vars['ISBANKTAX']): ?>
<br>
<div align=right id="sumatota"></div> 
					<?php else: ?>
					<?php endif; ?>
		</fieldset>
				<?php endif; ?>

дата за погасяване
<br>
<input type="text" name="datebala" id="datebala" size=14 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'datebala','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
			<?php if ($this->_tpl_vars['ISREASON'] || $this->_tpl_vars['ISRE2']): ?>
<br>
<br>
причина за нарушаване на <?php if ($this->_tpl_vars['EDIT'] == 0 || $this->_tpl_vars['ISRE2']):  echo $this->_tpl_vars['FINAINTE'];  else:  echo $this->_tpl_vars['DATAREAS']['finainterval'];  endif; ?>-дневен интервал 
	<?php if ($this->_tpl_vars['EDIT'] == 0): ?>
	<?php else: ?>
<br>
въведена от <?php echo $this->_tpl_vars['ADMINAME']; ?>
 на <?php echo ((is_array($_tmp=$this->_tpl_vars['DATAREAS']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y %H:%M:%S') : smarty_modifier_date_format($_tmp, '%d.%m.%Y %H:%M:%S')); ?>

	<?php endif;  if (isset ( $this->_tpl_vars['LISTER']['reason'] )): ?><br><font color=red><?php echo $this->_tpl_vars['LISTER']['reason']; ?>
</font><?php endif; ?>
<br>
				<?php if ($this->_tpl_vars['ADMINLOGGED']): ?>
<textarea class="input" name="reason" id="reason" rows=4 cols=50></textarea>
				<?php else: ?>
<b><?php echo $this->_tpl_vars['ADMITEXT']; ?>
</b>
				<?php endif; ?>
			<?php else: ?>
			<?php endif; ?>

<br>
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<?php if (isset ( $this->_tpl_vars['SUBMIT2'] )): ?>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши с несъвпадение','NAME' => 'submit2','ID' => 'submit2')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
	<?php endif; ?>
<br>

					<?php if ($this->_tpl_vars['ISBANKTAX']): ?>
<script type="text/javascript">
var arfiel= new Array();
<?php $_from = $this->_tpl_vars['ARFIEL']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['arname'] => $this->_tpl_vars['artaxname']):
?>
arfiel["<?php echo $this->_tpl_vars['arname']; ?>
"]= "<?php echo $this->_tpl_vars['artaxname']; ?>
";
<?php endforeach; endif; unset($_from); ?>
var artota= new Array();
artota.push("separa");
artota.push("separa2");
<?php $_from = $this->_tpl_vars['ARFIEL']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['arname'] => $this->_tpl_vars['artaxname']):
?>
artota.push("<?php echo $this->_tpl_vars['arname']; ?>
");
artota.push("<?php echo $this->_tpl_vars['artaxname']; ?>
");
<?php endforeach; endif; unset($_from); ?>
function moditax(name){
	var cuva= $("#"+name).attr("value");
	var tana= arfiel[name];
	var resu;
	if (cuva=="" || parseFloat(cuva)==0){
		resu= "";
	}else{
		if ($("#"+tana).attr("value")==""){
			resu= "<?php echo $this->_tpl_vars['BANKTAX']; ?>
";
		}else{
		}
	}
	$("#"+tana).attr("value",resu);
}
function creasum(name){
				var suma= 0;
	var arin, cuva;
	for (arin in artota){
		cuva= $("#"+artota[arin]).attr("value");
				suma += parseInt(100*cuva);
//alert(arin+'/'+artota[arin]+'/'+cuva+'/'+suma);
	}
//	sumacont= parseFloat(parseFloat(0.01*suma).toFixed(2));
	sumacont= parseFloat(0.01*suma).toFixed(2);
	if (sumacont==0){
		sumacont= "няма ";
	}else{
	}
	$("#sumatota").html(sumacont+" разпределени");
}
var arna;
for (arna in arfiel){
	moditax(arna);
}
creasum();
</script>
					<?php else: ?>
					<?php endif; ?>


<script type="text/javascript">
function typechan(){
	var obtype= document.getElementById("idtype");
	var obcont= document.getElementById("t2");
	var obdebt= document.getElementById("t9");
	var obdist= document.getElementById("zonedist");
			if (obtype.value==2){
				obcont.style.display= "block";
				obdebt.style.display= "none";
						if (obdist){
				obdist.style.display= "block";
						}else{
						}
				resizeNyroModalIframe();
			}else if (obtype.value==9){
				obcont.style.display= "none";
				obdebt.style.display= "block";
						if (obdist){
				obdist.style.display= "none";
						}else{
						}
				resizeNyroModalIframe();
			}else{
				obcont.style.display= "none";
				obdebt.style.display= "none";
						if (obdist){
				obdist.style.display= "block";
						}else{
						}
				resizeNyroModalIframe();
			}
jourdata();
}
typechan();
jourdata();
putcashname(false);

var obje= document.getElementById("getnext");
var obente= document.getElementById("seriente");
chancrea();
function chancrea(){
	if (obje.checked){
		obente.style.display= "none";
		resizeNyroModalIframe();
	}else{
		obente.style.display= "block";
		resizeNyroModalIframe();
	}
}
function jourdata(){
			<?php if ($this->_tpl_vars['ISBANKTAX']): ?>
	creasum();
			<?php else: ?>
			<?php endif; ?>
}
function putcashname(flagdire){
//	$('#cashname').attr('value',obde.get(0).options[obde.get(0).selectedIndex].text);
	var obde= $("#iddebtor");
	var cana= $('#cashname').attr('value');
					var myflag= false;
	if (flagdire){
					myflag= true;
	}else{
		if (cana==""){
					myflag= true;
		}else{
		}
	}
	if (myflag){
		$('#cashname').attr('value',obde.get(0).options[obde.get(0).selectedIndex].text);
	}else{
	}
}
</script>

								<script type="text/javascript">
function nochange(obje,valu){
//	alert('съдържанието '+valu+' не може да се променя');
//	obje.value= valu;
	obje.blur();
return false;
}
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>