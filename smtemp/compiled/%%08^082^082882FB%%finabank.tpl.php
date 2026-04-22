<?php /* Smarty version 2.6.9, created on 2020-02-27 15:33:09
         compiled from finabank.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'finabank.tpl', 49, false),)), $this); ?>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />

<style>
.head {font:normal 8pt verdana; background-color:#efefef; border-right: 1px solid #cdcdcd; border-top: 1px solid #cdcdcd;}
.head2 {font:normal 8pt verdana; background-color:#efefef; border-right: 1px solid #cdcdcd;}
td {font:normal 8pt verdana;}
</style>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
			<td class='d_table_title' colspan='200'>банкови извлечения</td>
		</tr>
		<tr>
			<td class='d_table_button' colspan='200'>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</td>
		</tr>
	</thead>
		<tr >
<td class="head2" colspan=8> &nbsp; </td>
<td class="head2" colspan=8 align=center> брой редове </td>
		</tr>
		<tr>
<td class="head"> № </td>
<td class="head"> банка </td>
<td class="head"> от дата </td>
<td class="head"> до дата </td>
<td class="head"> нач.салдо </td>
<td class="head"> кр.салдо </td>
<td class="head"> обработено </td>
<td class="head"> &nbsp; </td>
<td class="head" align=center width=60> общо </td>
<td class="head" align=center width=60> разход </td>
<td class="head" align=center width=60> дублир.<br>постъпл. </td>
<td class="head" align=center width=60> нови<br>постъпл. </td>
<td class="head"> &nbsp; </td>
		</tr>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td align=right> <?php echo $this->_tpl_vars['elem']['id']; ?>
 </td>
<td > <?php echo $this->_tpl_vars['BANKLIST'][$this->_tpl_vars['elem']['codebank']]; ?>
 </td>
<td > <?php echo $this->_tpl_vars['elem']['date1']; ?>
 </td>
<td > <?php echo $this->_tpl_vars['elem']['date2']; ?>
 </td>
<td align=right> <?php echo $this->_tpl_vars['elem']['balance1']; ?>
 </td>
<td align=right> <?php echo $this->_tpl_vars['elem']['balance2']; ?>
 </td>
<td > <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M:%S") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M:%S")); ?>
 </td>
						<?php $this->assign('myid', $this->_tpl_vars['elem']['id']); ?>
		
<td > <img src="images/view.png" class="ttip" rel="#cont<?php echo $this->_tpl_vars['myid']; ?>
" title="допълнителна информация" style="cursor:help;"></td>
<td align=right> <?php echo $this->_tpl_vars['elem']['cotot']; ?>
 &nbsp;&nbsp;</td>
<td align=right> <?php echo $this->_tpl_vars['elem']['cotot']-$this->_tpl_vars['elem']['coinp']; ?>
 &nbsp;&nbsp;</td>
<td align=right bgcolor="<?php if ($this->_tpl_vars['elem']['codub'] == 0): ?>salmon<?php else:  endif; ?>"> <?php echo $this->_tpl_vars['elem']['codub']; ?>
 &nbsp;&nbsp;</td>
<td align=right> <?php echo $this->_tpl_vars['elem']['conew']; ?>
 &nbsp;&nbsp;</td>
<td > 
<a href="<?php echo $this->_tpl_vars['elem']['viewrows']; ?>
" class="nyroModal" target="_blank"><img src="images/view.png" title="виж редовете"></a>
</td>

<span id="cont<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
сметка IBAN : <b><?php echo $this->_tpl_vars['elem']['iban']; ?>
</b>
<br>
архивен файл :
<br>
<b><?php echo $this->_tpl_vars['elem']['filename']; ?>
</b>
<br>
</span>
		</tr>
		<?php endforeach; endif; unset($_from);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</table>
<br>

<script type="text/javascript">
$(document).ready(function() {
	$('.ttip').cluetip({ width: 360, local:true, cursor:'pointer' });
});
</script>