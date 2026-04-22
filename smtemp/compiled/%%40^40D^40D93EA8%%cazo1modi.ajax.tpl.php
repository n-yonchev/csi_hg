<?php /* Smarty version 2.6.9, created on 2020-02-27 15:21:30
         compiled from cazo1modi.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'cazo1modi.ajax.tpl', 17, false),)), $this); ?>
<?php $this->assign('myheadcode', "
<script type='text/javascript' src='autocomp/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='autocomp/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='autocomp/thickbox-compressed.js'></script>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
<link rel='stylesheet' type='text/css' href='autocomp/thickbox.css' />
"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array('HEADCODE' => $this->_tpl_vars['myheadcode'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
optgroup option {padding-left:20px;}
</style>

<?php if ($this->_tpl_vars['EDIT'] <= 0): ?>
	<?php $this->assign('_title', 'ВЪВЕДИ НОВО ДЕЛО'); ?>
<?php else: ?>
	<?php $this->assign('_title', ((is_array($_tmp='корегирай основни данни за дело ')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['SERIYEAR']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['SERIYEAR']))); ?>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['_title'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<table>
					<tr>
					<td>
дата на образуване
<br>
<input type="text" name="created" id="created" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'created','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
					<td width=10>
					<td>
представител (въведи текст)
<br>
<input type="text" name="agent" id="agent" size=40 onkeyup="contrest(event,this,'<?php echo $this->_tpl_vars['AGNAME']; ?>
');" 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'agent','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
					</table>
описание
<br>
<input type="text" name="text" id="text" size=50 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'text','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

			<table>
			<tr>
<td> идва от
<td> състав
			<tr>
<td>
<nobr>
<span id="selecofrom"></span>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARFROMNAME'],'ID' => 'idcofrom','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</nobr>
<td>
<input type="text" name="cogrou" id="cogrou" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'cogrou','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
			</table>

			<table>
			<tr>
<td> изпълнителен титул
<td> надбавка ОЛП
			<tr>
<td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARTITUNAME'],'ID' => 'idtitu','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['AREXINNAME'],'ID' => 'extraint','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</table>

<div id="subtit1" class="inputcont" style="display: none; padding: 6px">
	дата на изп.лист
<br>
<input type="text" name="dateexec" id="dateexec" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'dateexec','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
				<table cellspacing=0 cellpadding=0>
				<tr>
				<td>
	номер на заповедта
<br>
<input type="text" name="nomecomm" id="nomecomm" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'nomecomm','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				<td width=10>
				<td>
	дата на заповедта
<br>
<input type="text" name="datecomm" id="datecomm" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'datecomm','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				</table>
	подтитул
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARSUBTNAME'],'ID' => 'idsubtit','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<div id="subtit2" class="inputcont" style="display: none; padding: 6px">
				<table cellspacing=0 cellpadding=0>
				<tr>
				<td>
	номер на заповедта
<br>
<input type="text" name="obezpe_nome" id="obezpe_nome" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'obezpe_nome','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				<td width=10>
				<td>
	дата на заповедта
<br>
<input type="text" name="obezpe_date" id="obezpe_date" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'obezpe_date','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				</table>
</div>

<div id="subtit5" class="inputcont" style="display: none; padding: 6px">
				<table cellspacing=0 cellpadding=0>
				<tr>
				<td>
	номер на постановл.
<br>
<input type="text" name="nakaza_nome" id="nakaza_nome" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'nakaza_nome','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				<td width=10>
				<td>
	дата на постановл.
<br>
<input type="text" name="nakaza_date" id="nakaza_date" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'nakaza_date','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				</table>
	издател
<br>
<input type="text" name="nakaza_izda" id="nakaza_izda" size=30 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'nakaza_izda','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
</div>

<div id="subtit6" class="inputcont" style="display: none; padding: 6px">
				<table cellspacing=0 cellpadding=0>
				<tr>
				<td>
	номер на акта
<br>
<input type="text" name="akt_nome" id="akt_nome" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'akt_nome','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				<td width=10>
				<td>
	дата на акта
<br>
<input type="text" name="akt_date" id="akt_date" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'akt_date','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				</table>
</div>

			<table cellspacing=0 cellpadding=0>
			<tr>
<td> вид
<td> номер
<td> година
			<tr>
<td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARSORTNAME'],'ID' => 'idsort','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td>
<input type="text" name="conome" id="conome" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'conome','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
<input type="text" name="coyear" id="coyear" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'coyear','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
			</table>

				<table cellspacing=0 cellpadding=0>
				<tr>
				<td>
ред за отчета
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARREPONAME'],'ID' => 'idrepo','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</table>

				<table cellspacing=0 cellpadding=0>
				<tr>
				<td>
текущ статус на делото
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARCASESTATNAME'],'ID' => 'idstat','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<td width=10>
				<td>
дата на статуса
<br>
<input type="text" name="timestat" id="timestat" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'timestat','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				</table>

				<table cellspacing=0 cellpadding=0>
				<tr>
				<td>
характер на изпълнението
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARCHARNAME'],'ID' => 'idchar','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<td width=10>
				<td>
схема на погасяване
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARPAYOFF'],'ID' => 'idpayoff','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</table>

вид и размер на вземането
<br>
<input type="text" name="claimdescrip" id="claimdescrip" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'claimdescrip','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
произход на вземането
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARCLAIORIG'],'ID' => 'idclaimorig','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br>&nbsp;
		<fieldset class="filtgr" style="padding:10px;">
		<legend align=right> за ЦРД-2014 </legend>
избери тип на вземането
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['AR4TYPENAME'],'ID' => 'idtypereg4','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
избери вид на вземането
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['AR4VARINAME'],'ID' => 'idvarireg4','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
избери произход на вземането
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['AR4ORIGNAME'],'ID' => 'idorigreg4','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</fieldset>

<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
//	$('#agent').autocomplete("agentauto.ajax.php",{matchContains:false, cacheLength:20, extraParams:{idmark:<?php echo $this->_tpl_vars['IDMARK']; ?>
}});
	$('#agent').autocomplete("agentauto.ajax.php",{matchContains:false, cacheLength:20, scrollHeight:400
	,formatItem: function(data, i, total) {
			<?php if (isset ( $this->_tpl_vars['IDMARK'] )): ?>
				if (data[1]==<?php echo $this->_tpl_vars['IDMARK']; ?>
){
	return "<font color=red>"+data[0]+"</font>";
				}else{
	return data[0];
				}
			<?php else: ?>
	return data[0];
			<?php endif; ?>
		}
	});
function contrest(event,obje,cont){
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==27){
		obje.value= cont;
return false;
	}else{
return true;
	}
}

var obtype= document.getElementById("idtitu");
var obsubt1= document.getElementById("subtit1");
var obsubt2= document.getElementById("subtit2");
var obsubt5= document.getElementById("subtit5");
var obsubt6= document.getElementById("subtit6");
obtype.onchange= typechan;
typechan();
//parent.$.nyroModalSettings({height:260, width:350});

function typechan(){
	obsubt1.style.display= "none";
	obsubt2.style.display= "none";
	obsubt5.style.display= "none";
	obsubt6.style.display= "none";
	if (obtype.value==1){
		obsubt1.style.display= "block";
	}else if (obtype.value==2){
		obsubt2.style.display= "block";
		resizeNyroModalIframe();
	}else if (obtype.value==5){
		obsubt5.style.display= "block";
		resizeNyroModalIframe();
	}else if (obtype.value==6){
		obsubt6.style.display= "block";
		resizeNyroModalIframe();
	}else{
	}
	resizeNyroModalIframe();
}
//getcof(<?php echo $this->_tpl_vars['POSTCOFROM']; ?>
);
function getcof(p1){
	$("#idcofrom").load(encodeURI("cazo1cofrom.ajax.php?sele="+p1),{},function() {
		resizeNyroModalIframe();
		//setTimeout("resizeNyroModalIframe();",1000);
	
	});
}
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>