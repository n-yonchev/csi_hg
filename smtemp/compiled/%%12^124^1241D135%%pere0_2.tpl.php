<?php /* Smarty version 2.6.9, created on 2020-03-11 11:05:29
         compiled from pere0_2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'pere0_2.tpl', 80, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.case {cursor:pointer;background-color:khaki;}
</style>

									<table align=center>
									<tr>
									<td>
											<?php if (isset ( $this->_tpl_vars['PAGEBACKLINK'] )): ?>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['PAGEBACKLINK'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <?php echo $this->_tpl_vars['PAGEBACKTEXT']; ?>
 </a>
											<?php else: ?>
											<?php endif; ?>
																			<tr>
									<td colspan=6>
			<table class="tab2" cellspacing='0' cellpadding='2' align=center>
			<tr class='head2'>
<td colspan='20'>
											<?php if (isset ( $this->_tpl_vars['PAGEBACKLINK'] )): ?>
											<?php else: ?>
списък на делата за перемиране
<div style="float:right;">
			<form name="form2" method=post enctype="multipart/form-data"
			style="float:left;margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 7pt verdana;white-space:nowrap;">
<nobr>
въведи макс.брой оставащи дни
<input type="text" name="daysrest" id="daysrest" size=6 autocomplete=off class="inp7bold" style="background:orange" 
onkeyup="form2subm(event,this.form,this.id);">
+enter
</nobr>
			</form>
</div>
											<?php endif; ?>
			<tr class='head2'>
<td> дело
<td> деловодител
<td> образувано
<td> статус
<td align=center> остав<br>дни
<td> архив
<td> взискатели
<td> длъжници
<td> последно<br>изходяване
<td> последно<br>постъпление
<td> посл.вх.док<br>перемиране
							<?php if (empty ( $this->_tpl_vars['ARDATA'] )): ?>
								<tr>
<td colspan=20 align=center>
<br>&nbsp;
<b>няма дела в списъка</b>
<br>&nbsp;
							<?php else: ?>
<?php $_from = $this->_tpl_vars['ARDATA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idcase'] => $this->_tpl_vars['elem']):
?>
			<tr>
<td class="case" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['edit'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> title="виж делото"> <?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>

<td> <?php echo $this->_tpl_vars['elem']['username']; ?>
&nbsp;
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td>
<?php echo $this->_tpl_vars['ARSTAT'][$this->_tpl_vars['elem']['idstat']]; ?>

<td align=center title="обр[<?php echo $this->_tpl_vars['elem']['casecrea']; ?>
]вх[<?php echo $this->_tpl_vars['elem']['maxdatedocu']; ?>
]изх[<?php echo $this->_tpl_vars['elem']['maxdatedout']; ?>
]пост[<?php echo $this->_tpl_vars['elem']['maxdatefina']; ?>
]=[<?php echo $this->_tpl_vars['elem']['maxdate']; ?>
]"> <?php echo $this->_tpl_vars['elem']['diff']; ?>

<td> <?php if ($this->_tpl_vars['elem']['isarch'] == 0):  else: ?>архив<?php endif; ?>
<td class="p7">
<?php $_from = $this->_tpl_vars['ARCLAI'][$this->_tpl_vars['idcase']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['clname']):
?>
	<?php echo $this->_tpl_vars['clname']; ?>
<br>
<?php endforeach; endif; unset($_from); ?>
<td class="p7">
<?php $_from = $this->_tpl_vars['ARDEBT'][$this->_tpl_vars['idcase']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dename']):
?>
	<?php echo $this->_tpl_vars['dename']; ?>
<br>
<?php endforeach; endif; unset($_from); ?>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['datedout'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['datefina'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['datepere'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<?php endforeach; endif; unset($_from); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2pagi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
							<?php endif; ?>
			</table>
									</table>

<script>
function form2subm(event,obform,idfiel){
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
var obfi= document.getElementById(idfiel);
obfi.style.visibility= "hidden";
//obfi.value= foid+obfi.value;
//document.forms['mymainform'].submit();
obform.submit();
	}else{
return true;
	}
}
</script>