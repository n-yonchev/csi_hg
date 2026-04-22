<?php /* Smarty version 2.6.9, created on 2022-08-10 10:25:48
         compiled from outtemedit.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'outtemedit.ajax.tpl', 3, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['FLAGCLON']): ?>
	<?php $this->assign('myti', ((is_array($_tmp=((is_array($_tmp="клониране за изх.шаблон &quot;")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['TEMPTEXT']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['TEMPTEXT'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "&quot;") : smarty_modifier_cat($_tmp, "&quot;"))); ?>
			<?php else: ?>
					<?php if ($this->_tpl_vars['EDIT'] == 0): ?>
	<?php $this->assign('myti', "въведи данни за нов изх.шаблон"); ?>
					<?php else: ?>
	<?php $this->assign('myti', "корегирай данните за изх.шаблон"); ?>
					<?php endif; ?>
			<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['myti'],'WIDTH' => 800)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<?php if ($this->_tpl_vars['FLAGCLON']): ?>
въведи уникални данни за новия шаблон
<br>
<br>
			<?php else: ?>
			<?php endif; ?>
описание
<br>
<input type="text" name="text" id="text" size=100 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'text','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br>
адресат
<br>
<input type="text" name="adresat" id="adresat" size=100 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'adresat','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br>
<input class="input" type="checkbox" name="isinvi" id="isinvi" label="дали документа представлява ПДИ">
			<?php if ($this->_tpl_vars['FLAGCLON']): ?>
<br>
<br>
име на файла
<br>
<input type="text" name="filename" id="filename" size=70 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'filename','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br>
			<?php else: ?>
			<?php endif; ?>
			<?php if (isset ( $this->_tpl_vars['FILIST']['regitext'] )): ?>
<br>
<br>
		<div style="margin-left:50px;">
за таксата от предмета на изпълнение
<br>
описателен текст
<br>
<input type="text" name="regitext" id="regitext" size=30 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regitext','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br>
			<table>
				<tr>
					<td>
						такса за 1 екземпляр
						<br>
						<input type="text" name="regitax" id="regitax" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regitax','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
					</td>
					<td style="padding-left: 10px;">
						по <?php echo $this->_tpl_vars['ARPOSTTYPE']['1']; ?>

						<br>
						<input type="text" name="regitax_1" id="regitax_1" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regitax_1','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
					</td>
					<td style="padding-left: 10px;">
						по <?php echo $this->_tpl_vars['ARPOSTTYPE']['2']; ?>

						<br>
						<input type="text" name="regitax_2" id="regitax_2" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regitax_2','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
					</td>
					<td style="padding-left: 10px;">
						по <?php echo $this->_tpl_vars['ARPOSTTYPE']['3']; ?>

						<br>
						<input type="text" name="regitax_3" id="regitax_3" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regitax_3','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
					</td>
					<td style="padding-left: 10px;">
						по <?php echo $this->_tpl_vars['ARPOSTTYPE']['4']; ?>

						<br>
						<input type="text" name="regitax_4" id="regitax_4" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regitax_4','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
					</td>
				</tr>
			</table>
		</div>
			<?php else: ?>
			<?php endif; ?>
					<?php if ($this->_tpl_vars['EDIT'] == 0): ?>
<br>
		<?php if ($this->_tpl_vars['ERTEXT'] == ""): ?>
		<?php else: ?>
<div style="color:red"> <?php echo $this->_tpl_vars['ERTEXT']; ?>
 </div>
		<?php endif; ?>
избери файла за качване
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
<input type="file" name="file" id="file" size=50 class="input">
					<?php else: ?>
					<?php endif; ?>
																<?php if ($this->_tpl_vars['ISPOST']): ?>
<style>
.blue {color:blue;}
.red  {color:red}
.marked {background-color:silver}
</style>
<br>
		<fieldset class="filtgr" style="padding:10px;">
		<legend align=right> за връчването </legend>
<img src="images/dire.gif" title="избери параметри" style="float:right;cursor:pointer;" onclick="fudire();">
метод по подразбиране
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARTYPENAME'],'ID' => 'idposttype','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
адресат
<br>
<input type="text" name="postadresat" id="postadresat" size=100 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'postadresat','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br>
адрес
<br>
<input type="text" name="postaddress" id="postaddress" size=100 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'postaddress','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
		</fieldset>
								<?php else: ?>
								<?php endif; ?>
								<?php echo $this->_tpl_vars['FILENAME']; ?>
&nbsp;&nbsp;
													<?php if ($this->_tpl_vars['ARTAGS'] === false): ?>
					<?php else: ?>
<img src="images/view.png" style="cursor:pointer" title="виж съдържанието на шаблона"
onclick="w2=window.open('<?php echo $this->_tpl_vars['VIEWTEMP']; ?>
','win2');w2.focus();">
					<?php endif; ?>
													<?php if ($this->_tpl_vars['ARTAGS'] === false): ?>
<span style="color:red;"> липсва файла на шаблона </span>
					<?php elseif (empty ( $this->_tpl_vars['ARTAGS'] )): ?>
&nbsp;
					<?php else: ?>
<br>
специални тагове :
<?php $_from = $this->_tpl_vars['ARTAGS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['taelem']):
?>
	<b><?php echo $this->_tpl_vars['taelem']; ?>
</b>&nbsp;&nbsp;
<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<input type=submit name="s2" id="s2" value="з2" style="display:none;">

<style>
td {font:normal 8pt verdana;border-bottom:1px solid silver;}
.h1 {background-color:silver;}
.c1 {background-color:khaki;cursor:pointer;}
</style>
				<table id="delihelp" style="display:none;">
				<tr>
<td colspan=10> избери параметри за връчване
				<tr class="h1">
<td> изх.шаблон
<td> адресат
<td> метод връчване
<td> адресат връчване
<td> адрес връчване
<?php $_from = $this->_tpl_vars['ARHELP']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id2'] => $this->_tpl_vars['elem']):
?>
				<tr onmouseover="$(this).addClass('c1');" onmouseout="$(this).removeClass('c1');" onclick="fuclic('<?php echo $this->_tpl_vars['elem']['code']; ?>
');">
<td> <?php echo $this->_tpl_vars['elem']['text']; ?>

<td> <?php echo $this->_tpl_vars['elem']['adresat']; ?>

<td> <?php echo $this->_tpl_vars['ARPOSTTYPE_2'][$this->_tpl_vars['elem']['idposttype']]; ?>

<td> <?php echo $this->_tpl_vars['elem']['postadresat']; ?>

<td> <?php echo $this->_tpl_vars['elem']['postaddress']; ?>

<?php endforeach; endif; unset($_from); ?>
				</table>

<script>
var dhview= false;
function fudire(){
	if (dhview){
//		$("#delihelp").hide();
//		dhview= false;
$("#s2").click();
	}else{
		$("#delihelp").show();
		dhview= true;
	}
	resizeNyroModalIframe();
}
function fuclic(data){
	var arre= data.split("^");
	$("#adresat").val(arre[0]);
	$("#idposttype").val(arre[1]);
	$("#postadresat").val(arre[2]);
	$("#postaddress").val(arre[3]);
$("#s2").click();
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