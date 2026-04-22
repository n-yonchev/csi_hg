<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazoactu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'cazoactu.tpl', 47, false),array('modifier', 'date_format', 'cazoactu.tpl', 50, false),array('function', 'counter', 'cazoactu.tpl', 125, false),)), $this); ?>
							<form name="actuform" id="actuform" onsubmit="return false;">
							<input type="hidden" name="idcase" id="idcase" value="<?php echo $this->_tpl_vars['IDCASE']; ?>
">
													<?php $this->assign('ACTUDEBT', true); ?>
<table class="d_table" cellspacing='0' cellpadding='0' <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoplan.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
		<thead>
		<tr>
		<td align=left valign=top class='d_table_title' onclick="toggle(this,event);">
актуален дълг
		</thead>
		<tbody>

<style>
.inpu {font: bold 7pt verdana; background-color:#dddddd; border: 0px solid black}
</style>
		<tr>
		<td align=left valign=top>
участващи събития до крайна дата <input type="text" class="inpu" name="enddate" size=12 onkeyup="autosubm(event,this);">
+enter
			<?php if (isset ( $this->_tpl_vars['DATETEXT'] )): ?>
<font color=red><?php echo $this->_tpl_vars['DATETEXT']; ?>
</font>
			<?php else: ?>
			<?php endif; ?>
		<tr>
		<td align=left valign=top>
		<table class="d_table" cellspacing=0 cellpadding=0>
		<tr class="tdbalahead">
<td> описание
<td> предмет
<td> погас
<td> дата
<td> статус
<?php $_from = $this->_tpl_vars['LISTVALI']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
		<tr class="tdbala">
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['descrip'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 70, "...", true) : smarty_modifier_truncate($_tmp, 70, "...", true)); ?>

<td> <?php if ($this->_tpl_vars['elem']['oper'] == 3):  echo $this->_tpl_vars['elem']['amou'];  else:  endif; ?>
<td> <?php if ($this->_tpl_vars['elem']['oper'] == 4):  echo $this->_tpl_vars['elem']['amou'];  else:  endif; ?>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td> 
			<?php if ($this->_tpl_vars['elem']['mode'] == 1): ?>
<font color=red>извън периода</font>
			<?php elseif ($this->_tpl_vars['elem']['mode'] == 2): ?>
<font color=red>липсва дата</font>
			<?php elseif ($this->_tpl_vars['elem']['mode'] == 3): ?>
участва
			<?php else: ?>
<input type="checkbox" name="<?php echo $this->_tpl_vars['elem']['finame']; ?>
" onclick="evchan();">
					<?php if ($this->_tpl_vars['elem']['rest'] == 0): ?>
					<?php else: ?>
<font color=red>неразпред</font>
					<?php endif; ?>
			<?php endif;  endforeach; endif; unset($_from); ?>
		</table>
<script>
function evchan(){
				var text;
				var actupara= "";
	$("#actuform :input").each(function(){
//alert(this.name+'/'+this.type+'/'+this.value+'/'+this.checked);
				if (this.type=="checkbox"){
					text= (this.checked)?"yes":"";
				}else{
					text= this.value;
				}
				actupara += "&"+this.name+"="+text;
		});
//alert(actupara);
//$("#tactulink").html("<h1>почакай...</h1>");
	jQuery.ajax({
		url: "cazoactu.ajax.php"
		,data: actupara
		,type: "post"
		,success: fusucc
		});
}
function fusucc(data){
		$("#tactulink").click();
//alert(data);
}
function autosubm(event,obinpu){
//alert(obinpu.value);
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
				if (obinpu.value==""){
					obinpu.value= "<?php echo $this->_tpl_vars['ENDDATE']; ?>
";
				}else{
				}
evchan();
return false;
	}else{
return true;
	}
}
</script>

		<tr>
		<td align=left valign=top>
състояние на дълга
													<?php echo smarty_function_counter(array('start' => 0,'assign' => 'mycoun'), $this);?>

		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
													<?php echo smarty_function_counter(array('assign' => 'mycoun'), $this);?>

					
					<?php if ($this->_tpl_vars['ekey'] == $this->_tpl_vars['LASTINDX']): ?>

		<tr>
		<td align=left valign=top>
										<table>
										<tr>
<td valign=top>
				<table cellspacing=0 cellpadding=0>
				<tr>
<td class="tdbalahead" width=160> направление
	<?php $_from = $this->_tpl_vars['CLAILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['claiid'] => $this->_tpl_vars['clainame']):
?>
				<tr>
<td class="tdbala"> <nobr><?php echo $this->_tpl_vars['clainame']; ?>
</nobr>
	<?php endforeach; endif; unset($_from); ?>
				</table>
						<?php $this->assign('movebg', ""); ?>
						<?php $this->assign('plusbg', ""); ?>
						<?php $this->assign('minubg', ""); ?>
						<?php $this->assign('resubg', ""); ?>
						<?php if ($this->_tpl_vars['elem']['direction'] == "+"): ?>
							<?php $this->assign('movebg', "#f8c4bf"); ?>
							<?php $this->assign('plusbg', "#f8c4bf"); ?>
						<?php else: ?>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['elem']['direction'] == "-"): ?>
							<?php $this->assign('movebg', "#ddffdd"); ?>
							<?php $this->assign('minubg', "#ddffdd"); ?>
						<?php else: ?>
						<?php endif; ?>
<td valign=top>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastat.tpl", 'smarty_include_vars' => array('VARI' => 'resu','BGCO' => $this->_tpl_vars['resubg'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td>
<td valign=top>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalaproc.tpl", 'smarty_include_vars' => array('VARI' => 'percpaid')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td>
										</table>

										<?php else: ?>
					<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

		</tbody>
		</table>
							</form>

<span id="actudebtinfo"></span>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_frame.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


