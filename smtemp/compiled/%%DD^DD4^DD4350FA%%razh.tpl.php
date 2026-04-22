<?php /* Smarty version 2.6.9, created on 2020-03-31 22:21:15
         compiled from razh.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoex', 'razh.tpl', 52, false),array('modifier', 'tomoney2', 'razh.tpl', 54, false),array('modifier', 'date_format', 'razh.tpl', 57, false),)), $this); ?>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
<style>
td {font:normal 8pt verdana; border-bottom: 1px solid silver; padding-left:4px; border-right: 1px solid silver;}
tr.head1 td {font:bold 10pt verdana; background-color: #dddddd;}
tr.head2 td {font:bold 10pt verdana; background-color: #dddddd;}
</style>
						<?php else: ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.addnew {font: normal 7pt verdana; background-color:wheat; padding: 2px 8px; cursor:pointer;}
body {margin:0px 10px;}
.dateinvo {font:normal 7pt verdana;border:0px solid black; color:black;}
</style>
						<?php endif; ?>
		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'> списък разходни касови ордери <?php echo $this->_tpl_vars['TEXTHEAD']; ?>

						<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php else: ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" onclick="fuprin('<?php echo $this->_tpl_vars['CURINT']; ?>
');"><img src="images/excel.gif" title="изход Excel" border=0></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="dateinvo">
	въведи дата или период от-до
	<input type=text name="dateinvo" id="dateinvo" size=26  class="dateinvo" onkeyup="autosubminvo(event,this);"> +enter
	<span id="error" style="color:red"></span>
</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $this->_tpl_vars['ADDNEW']; ?>
" class="nyroModal addnew" target="_blank">добави РКО</a>
						<?php endif; ?>
		<tr class='head2'>
<td align=right> сума
<td> дата
<td> номер
<td> изплатена на
<td> основание
<td> дело
<td> деловодител
<td> касиер
<td> &nbsp;
<td> &nbsp;
<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
				<tr>
					<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php $this->assign('mysuma', ((is_array($_tmp=$this->_tpl_vars['elem']['amount'])) ? $this->_run_mod_handler('tomoex', true, $_tmp) : smarty_modifier_tomoex($_tmp))); ?>
					<?php else: ?>
						<?php $this->assign('mysuma', ((is_array($_tmp=$this->_tpl_vars['elem']['amount'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp))); ?>
					<?php endif; ?>
<td align=right> <?php echo $this->_tpl_vars['mysuma']; ?>

<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['cashdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td> <?php echo $this->_tpl_vars['elem']['cashserial']; ?>
/<?php echo $this->_tpl_vars['elem']['cashyear']; ?>
 &nbsp;
<td> <?php echo $this->_tpl_vars['elem']['cashname']; ?>

<td> <?php echo $this->_tpl_vars['elem']['descrip']; ?>

<td>
			<?php if (empty ( $this->_tpl_vars['elem']['idcase'] )): ?>
&nbsp;
			<?php else: ?>
<?php echo $this->_tpl_vars['elem']['caseri']; ?>
/<?php echo $this->_tpl_vars['elem']['cayear']; ?>
 &nbsp;
			<?php endif; ?>
<td> <?php echo $this->_tpl_vars['elem']['username']; ?>

<td> <?php echo $this->_tpl_vars['elem']['cashier']; ?>

						<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php else: ?>
<td align=center>
<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="#" onclick="dele('<?php echo $this->_tpl_vars['elem']['dele']; ?>
'); return false;"><img src="images/free.gif" title="изтрий"></a>
<td>
<a href="#" onclick="fuprin('<?php echo $this->_tpl_vars['elem']['prin']; ?>
');return false;"><img src="images/print.gif" title="отпечати РКО"></a>
						<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
		<tr class='head2'>
					<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php $this->assign('mysuma1', ((is_array($_tmp=$this->_tpl_vars['ARSUMA']['suma1'])) ? $this->_run_mod_handler('tomoex', true, $_tmp) : smarty_modifier_tomoex($_tmp))); ?>
					<?php else: ?>
						<?php $this->assign('mysuma1', ((is_array($_tmp=$this->_tpl_vars['ARSUMA']['suma1'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp))); ?>
					<?php endif; ?>
<td align=right> <?php echo $this->_tpl_vars['mysuma1']; ?>

<td colspan=20> общо за периода

						<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php else: ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2pagi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endif; ?>

<script>
function dele(link){
	if(confirm('потвърди изтриването на РКО')) window.location.href=link;
}
</script>

<script>
function autosubminvo(event,obinpu){
//alert(obinpu.value);
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
		if (obinpu.value==""){
		}else{
			lipara= {date:obinpu.value,modeel:"<?php echo $this->_tpl_vars['MODEEL']; ?>
"};
			jQuery.ajax({
				url: "finainvodate.ajax.php"
				,data: lipara
				,type: "post"
				,success: fusucc
			})
		}
return false;
	}else{
return true;
	}
}
function fusucc(data){
//alert("data="+data);
	var arresu= data.split("/");
	var code= arresu[0];
	if (code=="0"){
		$("#error").text("");
document.location.href= arresu[1];
	}else{
		$("#error").text(arresu[1]);
	}
}
</script>