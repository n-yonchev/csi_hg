<?php /* Smarty version 2.6.9, created on 2020-02-27 13:25:24
         compiled from cazo34a.tpl */ ?>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
							<table>
							<tr>
							
							<td valign=top style="border: 1px solid black; padding:6px">
тип
<br>
<?php $_from = $this->_tpl_vars['ARTYPE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<?php if (empty ( $this->_tpl_vars['elem'] )): ?>
		<?php else: ?>
<input type="radio" name="idtype" value='<?php echo $this->_tpl_vars['ekey']; ?>
' label="<?php echo $this->_tpl_vars['elem']; ?>
" onclick="typechan(<?php echo $this->_tpl_vars['ekey']; ?>
);">
<br>
		<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
име
<br>
<input type="text" name="name" id="name" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'name','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

<br>
<nobr>
				<?php if ($this->_tpl_vars['ISCLAIMER']): ?>
<br>
<input type="checkbox" name="isjoin" id="isjoin" label="присъединен взискател"> 
<br>
<input type="checkbox" name="isnoregi" id="isnoregi" label="трето лице, не се предава в регистъра на длъжниците"> 
				<?php else: ?>
<br>
<input type="checkbox" name="isnoregi" id="isnoregi" label="да не се предава в регистъра на длъжниците"> 
		<?php endif; ?>
<nobr>

							<td valign=top style="border: 1px solid black; padding:6px">

<div id="t1" style="display: none;">
				<table align=center>
				<tr>
				<td align=right>
	ЕИК
				<td>
<input type="text" name="bulstat" id="bulstat" class="input" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'bulstat','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
		&nbsp;&nbsp;&nbsp;
	<a id="lin1" href="#" onclick="dosearch('bulstat'); return false;"> 
	<img src="images/search.png">
	</a>
				<tr>
				<td align=right>
	удост [фирм.дело]
				<td>
<input type="text" name="regidocu" id="regidocu" class="input" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regidocu','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				<tr>
				<td align=right>
	от дата
				<td>
<input type="text" name="regidate" id="regidate" class="input" size=16 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regidate','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				<tr>
				<td align=right>
	съд
				<td>
<input type="text" name="regicase" id="regicase" class="input" size=30 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regicase','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				<tr>
				<td align=right>
	представлявано от
				<td>
<input type="text" name="regipers" id="regipers" class="input" size=30 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regipers','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				<tr>
				<td align=right>
	с егн
				<td>
<input type="text" name="regipersegn" id="regipersegn" class="input" size=30 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regipersegn','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				<tr>
<td> избери подтип
<td> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['AR1TYPENAME'],'ID' => 't1type','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<tr>
<td colspan=2>
<input type="checkbox" name="t1fo" id="t1fo" label="чуждестранна фирма" onclick="t1fochan();"> 
<br>
	<span id="t1foyes" style="display: none;">
държава
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARCORYNAME'],'ID' => 't1cory','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</span>
				</table>
</div>

<div id="t2" style="display: none;">
	ЕГН
<input type="text" name="egn" id="egn" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'egn','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
		&nbsp;&nbsp;&nbsp;
	<a id="lin2" href="#" onclick="dosearch('egn'); return false;"> 
	<img src="images/search.png">
	</a>
	<br>
<input type="checkbox" name="t2fo" id="t2fo" label="чужд гражданин" onclick="t2fochan();"> 
	<span id="t2foyes" style="display: none;">
&nbsp;&nbsp;&nbsp;&nbsp;
държава
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARCORYNAME'],'ID' => 't2cory','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</span>
</div>

<div id="t3" style="display: none;">
избери подтип
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['AR3TYPENAME'],'ID' => 't3type','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
ЕИК
<input type="text" name="buls2" id="buls2" class="input" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'buls2','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
</div>

							<td valign=top style="border: 1px solid black; padding:6px">
представител
<br>
<input type="text" name="agent" id="agent" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'agent','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
IBAN
<br>
<input type="text" name="iban" id="iban" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'iban','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

							</table>


							
							<table>
							<tr>
							<td valign=top> 
адреси
<br>
<textarea name="address" id="address" rows=4 cols=80 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'address','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>></textarea>
							<td valign=top> 
коментар
<br>
<textarea name="notes" id="notes" rows=4 cols=30 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'notes','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>></textarea>
							</table>


<br>
		<fieldset id="t2a" style="display:none; padding: 6px">
		<legend align=right><b> данни за съпруг/а </b></legend>
					<table>
					<tr>
					<td valign=top>
име на съпруг/а
<br>
<input type="text" name="name2" id="name2" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'name2','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
ЕГН на съпруг/а
<br>
<input type="text" name="egn2" id="egn2" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'egn2','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
					<td valign=top>
адреси на съпруг/а
<br>
<textarea name="address2" id="address2" rows=3 cols=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'address2','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>></textarea>
					</table>
		</fieldset>

					<table>
					<tr>
<td id="coderesu" style="display: none; padding: 6px;">
					</table>

<script type="text/javascript">
		<?php if ($this->_tpl_vars['ISCLAIMER']): ?>
$('#agent').autocomplete("agclaiauto.ajax.php",{matchSubset:false});
		<?php else: ?>
$('#agent').autocomplete("agdebtauto.ajax.php",{matchSubset:false});
		<?php endif; ?>
//parent.$.nyroModalSettings({width:520, height:580}); 
function typechan(code){
//alert("typechan="+code);
	var indx, cuob;
//	for (indx=1; indx<<?php echo $this->_tpl_vars['ARLEN']; ?>
; indx=indx+1){
	$("#coderesu").html("");
	for (indx=1; indx<=<?php echo $this->_tpl_vars['ARLEN']; ?>
; indx=indx+1){
		var cuob= document.getElementById("t"+indx);
		if (cuob){
			if (indx==code){
				cuob.style.display= "block";
				resizeNyroModalIframe();
			}else{
				cuob.style.display= "none";
				resizeNyroModalIframe();
			}
		}else{
		}
		var cuob2= document.getElementById("t"+indx+"a");
		if (cuob2){
			if (indx==code){
				cuob2.style.display= "block";
				resizeNyroModalIframe();
			}else{
				cuob2.style.display= "none";
				resizeNyroModalIframe();
			}
		}else{
		}
	}
	if (code==1){
		t1fochan();
	}else{
	}
	if (code==2){
		t2fochan();
	}else{
	}
//				parent.$.nyroModalSettings({width:900, height:380});
//				resizeNyroModalIframe();
}
//t2fochan();
function t1fochan(){
	var obfo= document.getElementById("t1fo");
	var obfoyes= document.getElementById("t1foyes");
	if (obfo.checked){
		obfoyes.style.display= "block";
		resizeNyroModalIframe();
	}else{
		obfoyes.style.display= "none";
		resizeNyroModalIframe();
	}
}
function t2fochan(){
	var obfo= document.getElementById("t2fo");
	var obfoyes= document.getElementById("t2foyes");
	if (obfo.checked){
		obfoyes.style.display= "block";
		resizeNyroModalIframe();
	}else{
		obfoyes.style.display= "none";
		resizeNyroModalIframe();
	}
}

function dosearch(code){
	var codecont= document.getElementById(code).value;
//alert(codecont);
		if (codecont==""){
//////////////////////////////alert("липсва съдържание на полето");
//	$("#coderesu").css("display","none");
	$("#coderesu").html("");
		}else{
	$("#coderesu").css("display","block");
	$("#coderesu").html("<img src='ajaxload.gif'>");
	$("#coderesu").load(encodeURI("cazo34sear.ajax.php?para="+code+"/"+codecont),{},function() {
//		resizeNyroModalIframe();
//		setTimeout("resizeNyroModalIframe();",1000);
	});
	resizeNyroModalIframe();
//parent.$.nyroModalSettings({width:860, height:680});
//parent.$.nyroModalSettings({width:900});
//				parent.$.nyroModalSettings({width:980, height:480});
//				resizeNyroModalIframe();
		}
}
typechan(<?php echo $_POST['idtype']; ?>
);
t1fochan();
t2fochan();
</script>
