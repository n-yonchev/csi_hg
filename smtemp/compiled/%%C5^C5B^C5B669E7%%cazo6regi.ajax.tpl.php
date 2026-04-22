<?php /* Smarty version 2.6.9, created on 2020-02-27 12:58:13
         compiled from cazo6regi.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'cazo6regi.ajax.tpl', 40, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array('ONLOAD' => "chancrea();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.header.tpl", 'smarty_include_vars' => array('TITLE' => "регистриране на изходящ документ")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

												<?php if (isset ( $_POST['branstri'] )): ?>
<input type="hidden" name="branstri" id="branstri">
<input type="hidden" name="getnext" id="getnext">
<input type="hidden" name="serinome" id="serinome">
<input type="hidden" name="notes" id="notes">
	<input type="hidden" name="regitext" id="regitext">
	<input type="hidden" name="regitax" id="regitax">
												<?php if ($this->_tpl_vars['ISPOST']): ?>
<input type="hidden" name="idposttype" id="idposttype">
<input type="hidden" name="postadresat" id="postadresat">
<input type="hidden" name="postaddress" id="postaddress">
						<?php else: ?>
						<?php endif; ?>
<br>
ВНИМАНИЕ.
<br>
Ще бъдат изходени <font size=+1><b><?php echo $this->_tpl_vars['COUNBRAN']; ?>
 броя</b></font> документи с различни последователни изходящи номера и различни адресати.
<br>
След това : 
<ul>
<li> Няма да може да промените <u>броя на тези документи.</u> </li>
<li> Няма да може да изтриете <u>нито един от тези документи.</u> </li>
<li> Ще може да корегирате тези документи <u>само поотделно.</u> </li>
</ul>
Откажете изходяването, ако имате съмнения в : 
<ul>
<li><u>съдържанието</u> на документа,</li>
<li><u>броя</u> на копията</li>
<li>или в <u>списъка</u> на адресатите.
</ul>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => ((is_array($_tmp=((is_array($_tmp='изходи ')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['COUNBRAN']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['COUNBRAN'])))) ? $this->_run_mod_handler('cat', true, $_tmp, ' броя документи') : smarty_modifier_cat($_tmp, ' броя документи')),'NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'откажи','NAME' => 'cancel','ID' => 'cancel')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

												<?php else: ?>

<input type="checkbox" name="getnext" id="getnext" onclick="chancrea();">
вземи поредния изходящ номер - евентуално <b><?php echo $this->_tpl_vars['NEXTNUMB']; ?>
</b>
	<div id="seriente" style="display: block;">
или въведи желания изходящ номер
<input type="text" name="serinome" id="serinome" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'serinome','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
	</div>
																		<?php if (isset ( $this->_tpl_vars['ARBRAN'] )): ?>
<input type="hidden" name="adresat" id="adresat" value="PLACEAD">
									<?php else: ?>
								<?php if (isset ( $this->_tpl_vars['ARDEBTNAME'] )): ?>
<br>
избери длъжник за адресат
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARDEBTNAME'],'ID' => 'debtname','C1' => 'input','C2' => 'inputer','ONCH' => "$('#adresat').attr('value',$(this).get(0).options[$(this).get(0).selectedIndex].text);")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php else: ?>
				<?php endif; ?>
<br>
адресат
<br>
<input type="text" name="adresat" id="adresat" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'adresat','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
									<?php endif; ?>
<br>
бележки
<br>
<input type="text" name="notes" id="notes" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'notes','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br>
								<?php if (isset ( $this->_tpl_vars['ARBRAN'] )): ?>
<br>
избери клонове за изходяване
&nbsp;&nbsp;&nbsp;&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazo6bran.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php else: ?>
				<?php endif; ?>
								<?php if ($this->_tpl_vars['ISREGITAX']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazo6tax.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php else: ?>
				<?php endif; ?>
												<?php if ($this->_tpl_vars['ISPOST']): ?>
		<fieldset class="filtgr" style="padding:10px;">
		<legend align=right> за връчването </legend>
метод
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARPOSTTYPENAME_2'],'ID' => 'idposttype','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
														<?php if (isset ( $this->_tpl_vars['ARBRAN'] )): ?>
							<?php else: ?>
<br>
адресат 
<br>
<input type="text" name="postadresat" id="postadresat" class="input" size=100 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'postadresat','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
адрес 
<br>
<input type="text" name="postaddress" id="postaddrress" class="input" size=100 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'postaddress','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
							<?php endif; ?>
		</fieldset>
						<?php else: ?>
						<?php endif; ?>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script>
var obje= document.getElementById("getnext");
var obente= document.getElementById("seriente");
			var retax= <?php echo $_POST['regitax']; ?>
 +0;
			var retext= "<?php echo $this->_tpl_vars['TEMPTEXT']; ?>
";
			var tempmark= "<?php echo $this->_tpl_vars['TEMPMARK']; ?>
";
//chancrea();
function chancrea(){
	if (obje.checked){
		obente.style.display= "none";
		resizeNyroModalIframe();
	}else{
		obente.style.display= "block";
		resizeNyroModalIframe();
	}
}
</script>
												
												<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>