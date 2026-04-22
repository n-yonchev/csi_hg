<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:51
         compiled from trangolist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney2', 'trangolist.tpl', 75, false),array('modifier', 'cat', 'trangolist.tpl', 79, false),array('modifier', 'date_format', 'trangolist.tpl', 84, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.over {cursor:pointer;background-color:aqua;}
.dire {cursor:pointer;background-color:wheat;}
.he3 {font:bold 7pt verdana;background-color:lightblue;}
.ro3 {font:normal 8pt verdana;border: 0px solid green !important;}
.busy {font:normal 7pt verdana}
</style>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />

				<form name="formseye" method=post 
				style="margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 8pt verdana;white-space:nowrap;">

		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'>
<div style="float:left">списък на постъпленията готови за превод <?php echo $this->_tpl_vars['HEADTX']; ?>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
		<tr class='head2'>
<td> дело
<td> деловодител
<td> постъпления
<td> разпределения
<td> заето от

<?php $_from = $this->_tpl_vars['ARCASE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idcase'] => $this->_tpl_vars['elem']):
?>
		<tr>
						<?php if (empty ( $this->_tpl_vars['ARLOCK'][$this->_tpl_vars['idcase']] )): ?>
<td bgcolor=wheat <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> onmouseover="$(this).addClass('over');" onmouseout="$(this).removeClass('over');">
						<?php else: ?>
<td>
						<?php endif; ?>
<?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>

<td> <?php echo $this->_tpl_vars['elem']['username']; ?>

		<td valign=top class="tab4">
		<table>
		<tr>
				<?php if (empty ( $this->_tpl_vars['ARLOCK'][$this->_tpl_vars['idcase']] )): ?>
		<td align=center> 
<a href="#" onclick="casetopa(<?php echo $this->_tpl_vars['idcase']; ?>
); return false;"> 
<img src="images/topaym.gif" title="маркираните към списъка с преводи">
</a>
				<?php else: ?>
				<?php endif; ?>
		<td class="he3"> сума
		<td class="he3"> тип
		<td class="he3"> готово
				<?php if (empty ( $this->_tpl_vars['ARLOCK'][$this->_tpl_vars['idcase']] )): ?>
		<td class="he3"> върни
				<?php else: ?>
				<?php endif; ?>
		<?php $_from = $this->_tpl_vars['ARFINA'][$this->_tpl_vars['idcase']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idfina'] => $this->_tpl_vars['elfina']):
?>
		<tr>
				<?php if (empty ( $this->_tpl_vars['ARLOCK'][$this->_tpl_vars['idcase']] )): ?>
<td class="ro3" align=center> 
<input type=checkbox id="cb<?php echo $this->_tpl_vars['idfina']; ?>
" caseto="<?php echo $this->_tpl_vars['idcase']; ?>
" checked>
				<?php else: ?>
				<?php endif; ?>
<td class="ro3" align=right 
><?php echo ((is_array($_tmp=$this->_tpl_vars['elfina']['inco'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

				<?php $this->assign('idtype', $this->_tpl_vars['elfina']['idtype']); ?>
				<?php $this->assign('bankname', $this->_tpl_vars['ARBANK'][$this->_tpl_vars['elfina']['codebank']]); ?>
				<?php if ($this->_tpl_vars['idtype'] == 1): ?>
					<?php $this->assign('finaba', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp="/")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elfina']['idfinabank']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elfina']['idfinabank'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "-") : smarty_modifier_cat($_tmp, "-")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['bankname']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['bankname']))); ?>
				<?php else: ?>
					<?php $this->assign('finaba', ""); ?>
				<?php endif; ?>
<td class="ro3"> <nobr><?php echo ((is_array($_tmp=$this->_tpl_vars['ARTYPE'][$this->_tpl_vars['idtype']])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['finaba']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['finaba'])); ?>
</nobr>
<td class="ro3"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elfina']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y [%H:%M:%S]') : smarty_modifier_date_format($_tmp, '%d.%m.%Y [%H:%M:%S]')); ?>

				<?php if (empty ( $this->_tpl_vars['ARLOCK'][$this->_tpl_vars['idcase']] )): ?>
<td class="ro3" align=center> 
<img src="images/unmark.gif" style="cursor:pointer;" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elfina']['finaback'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> title="върни на деловодителя за корекция"> 
				<?php else: ?>
				<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</table>
		<td valign=top>
		<table class="tab4">
		<tr>
		<td class="he3"> сума
		<td class="he3"> взискател
		<td class="he3"> iban
		<?php $_from = $this->_tpl_vars['ARTRAN'][$this->_tpl_vars['idcase']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idclai'] => $this->_tpl_vars['eltran']):
?>
		<tr>
<td class="ro3" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['eltran']['suma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

			<?php if ($this->_tpl_vars['idclai'] <= 0): ?>
<td class="ro3 pseu"> <?php echo $this->_tpl_vars['eltran']['clainame']; ?>
&nbsp;
			<?php else: ?>
<td class="ro3"> <?php echo $this->_tpl_vars['eltran']['clainame']; ?>

			<?php endif; ?>
			<?php if ($this->_tpl_vars['idclai'] <= 0 && $this->_tpl_vars['idclai'] <> -1): ?>
<td class="ro3 pseu"> ОК
			<?php else: ?>
				<?php if (empty ( $this->_tpl_vars['eltran']['iban'] )): ?>
<td class="no"> липсва
				<?php else: ?>
<td class="ro3"> <?php echo $this->_tpl_vars['eltran']['iban']; ?>
&nbsp;
					<?php if ($this->_tpl_vars['eltran']['ibaniser']): ?>
<span class="no">грешен</span>
					<?php else: ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
<td class="ro3">
				<?php if ($this->_tpl_vars['idclai'] <= 0): ?>
				<?php else: ?>
					<?php if (empty ( $this->_tpl_vars['ARLOCK'][$this->_tpl_vars['idcase']] )): ?>
<a href="<?php echo $this->_tpl_vars['eltran']['claimodi']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай сметката"></a>
					<?php else: ?>
					<?php endif; ?>
				<?php endif; ?>

		<?php endforeach; endif; unset($_from); ?>
		</table>
<td class="busy"> <?php echo $this->_tpl_vars['ARLOCK'][$this->_tpl_vars['idcase']]; ?>

<?php endforeach; endif; unset($_from); ?>

				</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2pagi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</table>

<script>
function casetopa(suid){
	var list= $("input[@caseto="+suid+"]");
	var lico= "";
	var coun= 0;
	for (var i=0; i<list.length; i++){
		if (list[i].checked){
			lico += list[i].id+",";
			coun += 1;
		}else{
		}
	}
	if (coun==0){
	}else{
		lico= lico.substring(0,lico.length-1);
		jQuery.ajax({
			url: "cbsess.ajax.php?p="+lico
			,success: topasuccess
			});
	}
}
function topasuccess(data){
//alert(data);
	var arre= data.split("^");
	if (arre[0]=="ok"){
$.nyroModalManual({forceType:'iframe', url:'<?php echo $this->_tpl_vars['CBTOPAYM']; ?>
'});
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}
</script>