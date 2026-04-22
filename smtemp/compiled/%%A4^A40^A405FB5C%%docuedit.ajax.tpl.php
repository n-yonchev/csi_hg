<?php /* Smarty version 2.6.9, created on 2026-03-10 15:40:53
         compiled from docuedit.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'docuedit.ajax.tpl', 18, false),array('function', 'counter', 'docuedit.ajax.tpl', 171, false),)), $this); ?>
<?php $this->assign('myheadcode', "
<script type='text/javascript' src='autocomp/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='autocomp/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='autocomp/thickbox-compressed.js'></script>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
<link rel='stylesheet' type='text/css' href='autocomp/thickbox.css' />
<script type='text/javascript' src='js/_docuedit.js'></script>
");  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array('HEADCODE' => $this->_tpl_vars['myheadcode'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  if ($this->_tpl_vars['EDIT'] == 0): ?>
			<?php if ($_SESSION['iscreacase']): ?>
	<?php $this->assign('_title', 'въведи нов документ за образуване на дело'); ?>
			<?php else: ?>
	<?php $this->assign('_title', 'ВЪВЕДИ НОВ ДОКУМЕНТ'); ?>
			<?php endif;  else: ?>
	<?php $this->assign('_title', ((is_array($_tmp='КОРЕГИРАЙ ДОКУМЕНТ ')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['DOCUMENT']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['DOCUMENT'])));  endif;  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['_title'],'TABS' => $this->_tpl_vars['TABS'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
																		<?php if ($this->_tpl_vars['CONF']): ?>
				<?php $_from = $_POST; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['postin'] => $this->_tpl_vars['postco']):
?>
<input type="hidden" name="<?php echo $this->_tpl_vars['postin']; ?>
" id="<?php echo $this->_tpl_vars['postin']; ?>
">
				<?php endforeach; endif; unset($_from); ?>
<br>
описание
<br>
<b><?php echo $this->_tpl_vars['POSTTRAN']['text']; ?>
</b>
<br>
<br>
подател
<br>
<b><?php echo $this->_tpl_vars['POSTTRAN']['from']; ?>
</b>
<br>
<br>
бележки
<br>
<b><?php echo $this->_tpl_vars['POSTTRAN']['notes']; ?>
</b>
<br>
<br>
	<b>
<font color=red>
<div style="width:300px;">
ВНИМАНИЕ.
</div>
С тези входни данни ще създадете 
<br>
	<font size=+1 color=red>
	<?php echo $_POST['newcount']; ?>
 броя нови документи и
<br>
	<?php echo $_POST['newcount']; ?>
 броя нови дела
	</font>
<br>
<nobr>Ако този брой е верен, може да продължите.</nobr>
</font>
	</b>
<br>
<br>
<nobr>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'OK, продължи','NAME' => 'submityes','ID' => 'submityes')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'НЕ, върни се','NAME' => 'submitno','ID' => 'submitno')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</nobr>
						<?php else: ?>

	<?php if ($this->_tpl_vars['EDIT'] == 0): ?>
		<?php if ($_SESSION['iscreacase']): ?>
		<?php else: ?>
<br>
<input type=checkbox name=ispost id=ispost label="документа е от външен източник и е за връчване"
onclick="postclic();">
<br>
		<?php endif; ?>
	<?php else: ?>
		<?php if ($this->_tpl_vars['ISPOST']): ?>
<br>
<font color=red>
документа е от външен източник и е за връчване
</font>
<input type=hidden name=ispost id=ispost>
<br>&nbsp;&nbsp;&nbsp;&nbsp;източник : <b><?php echo $this->_tpl_vars['RODELI']['exname']; ?>
</b>
<br>&nbsp;&nbsp;&nbsp;&nbsp;метод : <b><?php echo $this->_tpl_vars['ARPOSTTYPE_2'][$this->_tpl_vars['RODELI']['idposttype']]; ?>
</b>
<br>&nbsp;&nbsp;&nbsp;&nbsp;адресат: <b><?php echo $this->_tpl_vars['RODELI']['adresat']; ?>
</b>
<br>&nbsp;&nbsp;&nbsp;&nbsp;адрес: <b><?php echo $this->_tpl_vars['RODELI']['address']; ?>
</b>
<br>
		<?php else: ?>
		<?php endif; ?>
	<?php endif; ?>

тип
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARDOCUTYPENAME'],'ID' => 'idtype','C1' => 'input','C2' => 'inputer','ONCH' => "$('#text').attr('value',$(this).get(0).options[$(this).get(0).selectedIndex].text);")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<div id="base">
описание
<br>
<input type="text" name="text" id="text" size=50 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'text','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br>подател<br>
<input type="text" name="from" id="from" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'from','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br>бележки<br>
<textarea rows=2 cols=50 name="notes" id="notes" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'notes','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>></textarea>
					</div>
					<div id="dipost">
	<?php if ($this->_tpl_vars['EDIT'] == 0): ?>
						<span style="display:none">
<br>
<input type="checkbox" name="iscreacase" id="iscreacase" onclick="chancrea();">
документа е за образуване на ново дело (дела)
						</span>
<br>
<div id="creayes" style="display: none;">
брой нови документи и дела
<input type="text" name="newcount" id="newcount" size=4 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'newcount','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
</div>
<div id="creano" style="display: none;">
	<?php else: ?>
<div id="creano" style="display: block;">
	<?php endif; ?>
списък на делата, свързани с документа, разделени с интервал<br>
<textarea rows=6 cols=50 name="tacaselist" id="tacaselist" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'tacaselist','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>></textarea>
</div>
			<span id="flagmd">
			<?php if ($_SESSION['iscreacase'] || $this->_tpl_vars['EDIT'] <> 0): ?>
			<?php else: ?>
<br>
<input type="checkbox" name="flagmultidoc" id="flagmultidoc" label="за всяко дело да се формира отделен документ с отделен входящ номер">
			<?php endif; ?>
			</span>
					</div>
										<div id="disour" style="display:none">
<br>
		<fieldset class="filtgr" style="padding:10px;">
		<legend align=right> за връчване </legend>
описание на вх.документ
<br>
<input type="text" name="text2" id="text2" size=50 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'text2','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br>външен източник<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARSOURPOSTNAME'],'ID' => 'iddelisour','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>тип документ за връчване и дело<br>
<textarea rows=2 cols=50 name="notes2" id="notes2" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'notes2','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>></textarea>
<br>метод на връчване<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARPOSTTYPENAME_2'],'ID' => 'idposttype','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>адресат за връчване<br>
<textarea rows=2 cols=50 name="postadresat" id="postadresat" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'postadresat','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>></textarea>
<br>адрес за връчване<br>
<textarea rows=3 cols=50 name="postaddress" id="postaddress" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'postaddress','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>></textarea>
		</fieldset>
					</div>

<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php if (isset ( $this->_tpl_vars['CASEER'] )): ?>
<span style="font: normal 8pt verdana;">
<br>
<br>
грешки в списъка с дела
				<?php $this->assign('perrow', 6); ?>
				<?php echo smarty_function_counter(array('start' => $this->_tpl_vars['perrow'],'assign' => 'coun'), $this);?>

	<table align=center class="calist">
<?php $_from = $this->_tpl_vars['CASEER']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['ele2']):
?>
			<?php if ($this->_tpl_vars['coun'] == $this->_tpl_vars['perrow']): ?>
				<?php echo smarty_function_counter(array('start' => 1,'assign' => 'coun'), $this);?>

	<tr>
			<?php else: ?>
				<?php echo smarty_function_counter(array('assign' => 'coun'), $this);?>

			<?php endif; ?>
			<?php if ($this->_tpl_vars['ele2']['type'] == 0): ?>
				<?php $this->assign('tdclas', 'erro'); ?>
			<?php elseif ($this->_tpl_vars['ele2']['type'] == 2): ?>
				<?php $this->assign('textti', ((is_array($_tmp="делото липсва, но номера превишава максималния ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ele2']['link']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ele2']['link']))); ?>
				<?php $this->assign('tdclas', 'erro'); ?>
				<?php $this->assign('onclic', ""); ?>
			<?php else: ?>
				<?php $this->assign('textti', "дублирано дело"); ?>
				<?php $this->assign('tdclas', 'dubl'); ?>
				<?php $this->assign('onclic', ""); ?>
			<?php endif; ?>
	<td id="cont<?php echo $this->_tpl_vars['ele2']['idcode']; ?>
"> 
<span class="<?php echo $this->_tpl_vars['tdclas']; ?>
" title="<?php echo $this->_tpl_vars['textti']; ?>
" onclick="<?php echo $this->_tpl_vars['onclic']; ?>
"> 
<?php echo $this->_tpl_vars['ele2']['text']; ?>
 
</span>
<?php endforeach; endif; unset($_from); ?>
	</table>
</span>
		<?php else: ?>
		<?php endif; ?>
						<?php endif; ?>

	<?php if ($this->_tpl_vars['EDIT'] == 0 && ! $this->_tpl_vars['CONF']): ?>
<script>
var obcrea= document.getElementById("iscreacase");
var obcreayes= document.getElementById("creayes");
var obcreano= document.getElementById("creano");
			<?php if ($_SESSION['iscreacase']): ?>
obcrea.checked= true;
			<?php else: ?>
			<?php endif; ?>
chancrea();
function chancrea(){
	if (obcrea.checked){
		obcreayes.style.display= "block";
		obcreano.style.display= "none";
		resizeNyroModalIframe();
	}else{
		obcreayes.style.display= "none";
		obcreano.style.display= "block";
		resizeNyroModalIframe();
	}
}
</script>
	<?php else: ?>
	<?php endif; ?>

<script>
var sendlist= [
<?php echo $this->_tpl_vars['SENDCODE']; ?>

];
function caseacti(p1,p2){
	$("#"+p1).html("<img src='ajaxload.gif'>");
	$("#"+p1).load(encodeURI("docucase.ajax.php"+p2));
}

postclic();
var oldtype= <?php echo $_POST['idtype']; ?>
 +0;
function postclic(){
	var obje= document.getElementById("ispost");
	if(obje.checked){
oldtype= $('#idtype').val();
		$('#idtype').val(<?php echo $this->_tpl_vars['EXTETYPE']; ?>
);
		$('#dipost').hide();
		$('#base').hide();
					<?php if ($this->_tpl_vars['EDIT'] == 0): ?>
		$('#disour').show();
					<?php else: ?>
					<?php endif; ?>
	}else{
$('#idtype').val(oldtype);
		$('#base').show();
					<?php if ($this->_tpl_vars['ISPOST']): ?>
		$('#dipost').hide();
					<?php else: ?>
		$('#dipost').show();
					<?php endif; ?>
		$('#disour').hide();
	}
	resizeNyroModalIframe();
}
</script>

<style>
table.calist td span {padding-left:10px;padding-right:10px;margin-left:4px;}
.norm {color:black;cursor:help;}
.dubl {color:white;background-color:black;cursor:help;}
.erro {color:white;background-color:red;cursor:pointer;}
.e2inva {color:white;background-color:orange;cursor:help;}
.e2exis {color:white;background-color:green;cursor:help;}
</style>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>