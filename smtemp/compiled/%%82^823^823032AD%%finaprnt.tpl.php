<?php /* Smarty version 2.6.9, created on 2024-01-25 12:09:20
         compiled from finaprnt.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'finaprnt.tpl', 27, false),)), $this); ?>
<style>
.head {font: normal 16pt verdana;}
.text {font: normal 12pt verdana;}
.cont {font: bold 12pt verdana; padding-left: 20px;}
</style>

<div align=right>
изп.дело <b><?php echo $this->_tpl_vars['ROCASE']['serial']; ?>
/<?php echo $this->_tpl_vars['ROCASE']['year']; ?>
</b>
&nbsp;&nbsp;
деловодител <b><?php echo $this->_tpl_vars['ROCASEUSER']['name']; ?>
</b>
</div>
<div style="border: 2px solid black; padding: 10px 10px 10px 10px; margin: 10px 0px 10px 80px;">

<center>
<div class="head"> ПОСТЪПЛЕНИЕ </div>
<div class="cont"> <?php echo $this->_tpl_vars['ARTYPE'][$this->_tpl_vars['ROFINA']['idtype']]; ?>
 </div>
</center>
<div class="text"> сума </div>
<div class="cont"> <?php echo $this->_tpl_vars['ROFINA']['inco']; ?>
 </div>
<div class="text"> описание </div>
<div class="cont"> <?php echo $this->_tpl_vars['ROFINA']['descrip']; ?>
 </div>
<?php if ($this->_tpl_vars['ROOPNAME']): ?>
	<div class="text"> наредител </div>
	<div class="cont"> <?php echo $this->_tpl_vars['ROOPNAME']; ?>
 </div>
<?php endif; ?>
<div class="text"> създадено </div>
<div class="cont"> <?php echo ((is_array($_tmp=$this->_tpl_vars['ROFINA']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y %H:%M:%S') : smarty_modifier_date_format($_tmp, '%d.%m.%Y %H:%M:%S')); ?>
 от <?php echo $this->_tpl_vars['ROUSER']['name']; ?>
 </div>
		<?php if (isset ( $this->_tpl_vars['ROBANK'] )): ?>
<br>
<div class="text"> информация от извлечение № <b><?php echo $this->_tpl_vars['ROBANK']['idfinabank']; ?>
</b> </div>
<br>
<div class="text"> време </div>
<div class="cont"> <?php echo $this->_tpl_vars['ROBANK']['date']; ?>
 <?php echo $this->_tpl_vars['ROBANK']['hour']; ?>
 </div>
<div class="text"> референция </div>
<div class="cont"> <?php echo $this->_tpl_vars['ROBANK']['reference']; ?>
 </div>
		<?php else: ?>
		<?php endif; ?>

</div>
		<?php if ($this->_tpl_vars['FIRST'] == 1): ?>
<br>
<br>
<br>
	<hr>
<br>
<br>
<br>
		<?php elseif ($this->_tpl_vars['FIRST'] == 2): ?>
<br style="page-break-after: always;">
		<?php else: ?>
		<?php endif; ?>