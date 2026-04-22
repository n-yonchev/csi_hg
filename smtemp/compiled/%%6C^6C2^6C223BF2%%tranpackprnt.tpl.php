<?php /* Smarty version 2.6.9, created on 2020-03-05 11:20:29
         compiled from tranpackprnt.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'tranpackprnt.tpl', 8, false),array('modifier', 'date_format', 'tranpackprnt.tpl', 39, false),array('modifier', 'tomo3', 'tranpackprnt.tpl', 50, false),)), $this); ?>
<style>
.head {font: normal 10pt verdana;}
.text {font: normal 8pt verdana; margin-top:8px;}
.cont {font: bold 8pt verdana; padding:4px; letter-spacing:4pt; border:1px solid black;}
.cred {font: bold 10pt verdana; letter-spacing:4pt;}
</style>

								<?php echo smarty_function_counter(array('start' => 1,'assign' => 'coun'), $this);?>

<?php $_from = $this->_tpl_vars['ARDATA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
				<div style="height:118mm; padding: 0px 0px 0px 10px; margin: 2px 0px 2px 80px;">
				<table height=100%>
				<tr><td>
							<?php if (isset ( $this->_tpl_vars['elem']['idcase'] )): ?>
<div class="text" align=right>
изп.дело <b><?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>
</b>
&nbsp;&nbsp;
деловодител <b><?php echo $this->_tpl_vars['elem']['username']; ?>
</b>
</div>
							<?php else: ?>
							<?php endif; ?>
				<table width=100%>
				<tr>
				<td>
<div class="cred"> 
КРЕДИТЕН ПРЕВОД 
</div>
<div class="text"> 
от <b>пакет <?php echo $this->_tpl_vars['IDPACK']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['PACKCREA'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</b>
<br>
нареден от банка <b><?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['IDBANK']]; ?>
</b>
<br>
създаден от <b><?php echo $this->_tpl_vars['elem']['usernametran']; ?>
</b> 
<br>
на <b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['timetran'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y %H:%M:%S') : smarty_modifier_date_format($_tmp, '%d.%m.%Y %H:%M:%S')); ?>
</b>
</div>
				<td align=right>
<span class="text"> сума на превода </span>
&nbsp;
<span class="cont"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['amount'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
 </span>
				</table>
				<?php if ($this->_tpl_vars['IDBANK'] == 1): ?>
<div class="text"> основание за плащане </div>
<div class="cont"> <?php echo $this->_tpl_vars['elem']['text']; ?>
 </div>
				<?php else: ?>
<div class="text"> основание </div>
<div class="cont"> <?php echo $this->_tpl_vars['elem']['t1']; ?>
 </div>
<div class="text"> още пояснения </div>
<div class="cont"> <?php echo $this->_tpl_vars['elem']['t2']; ?>
 </div>
				<?php endif; ?>
<div class="text"> получател </div>
<div class="cont"> <?php echo $this->_tpl_vars['elem']['clainame']; ?>
 </div>
				<table>
				<tr>
				<td>
<div class="text"> IBAN на получателя </div>
<div class="cont"> <?php echo $this->_tpl_vars['elem']['iban']; ?>
 </div>
				<td width=20>
				<td>
<div class="text"> BIC на получателя </div>
<div class="cont"> <?php echo $this->_tpl_vars['elem']['bic']; ?>
 </div>
				</table>
<div class="text"> банка на получателя </div>
<div class="cont"> <?php echo $this->_tpl_vars['elem']['bankname']; ?>
 </div>
							<?php if ($this->_tpl_vars['elem']['isring']): ?>
<br>
<span class="text"> RINGS </span>
&nbsp;
<span class="cont"> да </span>
							<?php else: ?>
							<?php endif; ?>
				</table>
				</div>
																<?php echo smarty_function_counter(array('assign' => 'coun'), $this);?>

								<?php if ($this->_tpl_vars['coun'] % 2 == 0): ?>
<br>
	<hr>
<br>
								<?php else: ?>
<br style="page-break-after: always;">
								<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
