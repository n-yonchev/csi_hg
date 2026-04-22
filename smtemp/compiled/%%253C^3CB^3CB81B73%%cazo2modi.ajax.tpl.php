<?php /* Smarty version 2.6.9, created on 2020-02-27 15:24:51
         compiled from cazo2modi.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($this->_tpl_vars['EDIT'] <= 0): ?>
	<?php $this->assign('_title', 'въведи нов предмет'); ?>
<?php else: ?>
	<?php $this->assign('_title', 'корегирай съществуващ предмет'); ?>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['_title'],'WIDTH' => 500)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


описание
<br>
<input type="text" name="text" id="text" size=50 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'text','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

<br>
тип
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARTYPENAME'],'ID' => 'idtype','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="suma" class="inputcont" style="display: none; padding: 6px;">
<span id="subt">
	подтип
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARSTNAME'],'ID' => 'idsubtype','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<br>
</span>
	сума
<input type="text" name="amount" id="amount" class="input" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'amount','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
autocomplete=off> 
<span id="tobr">
	<br>
</span>
<span id="fromda">
	от дата
<input type="text" name="fromdate" id="fromdate" class="input" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'fromdate','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
</span>
<span id="toda">
	до дата
<input type="text" name="todate" id="todate" class="input" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'todate','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
</span>
	<span id="type1text">
	<br>
	</span>
</div>

<br>
взискател
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARCLAINAME'],'ID' => 'idclaimer','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br>
длъжници <?php if (isset ( $this->_tpl_vars['LISTER']['listde'] )): ?>&nbsp;<span style="color:red;"><?php echo $this->_tpl_vars['LISTER']['listde']; ?>
</span><?php else:  endif; ?>
<br>
		<?php $_from = $this->_tpl_vars['ARDEBT']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['deid'] => $this->_tpl_vars['dename']):
?>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" class="input" name="listde[]" value="<?php echo $this->_tpl_vars['deid']; ?>
" label="<?php echo $this->_tpl_vars['dename']; ?>
">
<br/>
		<?php endforeach; endif; unset($_from); ?>

<div id="flag" style="display: none;">
<br>
<input type="checkbox" name="isintax" id="isintax" label="сумата да участва ли в таксата за ЧСИ по т.26">
<?php if (isset ( $this->_tpl_vars['LISTER']['isintax'] )): ?><br><span style="color:red;"><?php echo $this->_tpl_vars['LISTER']['isintax']; ?>
</span><?php else:  endif; ?>
</div>

<br>
избери тип на предмета съгласно ДВ-86/17
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazo2at2.inc.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
//parent.$.nyroModalSettings({height:400});
//parent.$.nyroModalSettings({width:700});
var obtype= document.getElementById("idtype");
var obcase= document.getElementById("suma");
var obsubt= document.getElementById("subt");
var obflag= document.getElementById("flag");
obtype.onchange= typechan;
	var obt1= document.getElementById("type1text");
	var obfrom= document.getElementById("fromdate");
	var obto= document.getElementById("toda");
	var obbr= document.getElementById("tobr");
	obfrom.onkeyup= t1text;
typechan();
t1text();
function typechan(){
	if (obtype.value==1 || obtype.value==2 || obtype.value==3 || obtype.value==5){
		obcase.style.display= "block";
		obflag.style.display= "block";
		obto.style.display= "none";
		obbr.style.display= "none";
		if (obtype.value==2){
			//parent.$.nyroModalSettings({height:340,width:450});
			obsubt.style.display= "block";
			//resizeNyroModalIframe();
		}else{
			//parent.$.nyroModalSettings({height:320,width:450});
			obsubt.style.display= "none";
			//resizeNyroModalIframe();
		}
		if (obtype.value==3 || obtype.value==5){
			obto.style.display= "";
			obbr.style.display= "";
		}else{
		}
	}else{
		obcase.style.display= "none";
		obflag.style.display= "none";
		//parent.$.nyroModalSettings({height:260,width:450});
		//resizeNyroModalIframe();
	}
	resizeNyroModalIframe();
}
function t1text(){
	if (obtype.value==1){
		if (obfrom.value==""){
			obt1.style.color= "red";
			obt1.innerHTML= "празна дата - сумата НЯМА да се олихвява";
		}else{
			obt1.style.color= "";
			obt1.innerHTML= "ИМА дата - сумата ще се олихвява";
		}
	}else{
	}
return true;
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