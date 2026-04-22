<?php /* Smarty version 2.6.9, created on 2020-02-27 15:33:26
         compiled from finarest.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'finarest.tpl', 47, false),array('modifier', 'tomoney', 'finarest.tpl', 160, false),array('modifier', 'date_format', 'finarest.tpl', 170, false),)), $this); ?>
	<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<thead>
	<tr>
<td class='d_table_title' colspan='200'> списък на ИГНОРИРАНИТЕ постъпления
	</tr>
	</thead>

<style>
.head {font:normal 7pt verdana; background-color:#efefef; border-right: 1px solid #cdcdcd; border-bottom: 1px solid #cdcdcd;}
</style>

<td class="head" align=right> сума
<td class="head"> тип
<td class="head" align=center> време
<td class="head">
<td class="head">
<td class="head" align=center> дело
<td class="head" align=center> деловодител
<td class="head" align=center> нераз<br>пред
<td class="head" align=center> при<br>ключ 
<td class="head" align=center> дата погасяв

<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
						<?php $this->assign('myid', $this->_tpl_vars['elem']['id']); ?>
	<tr onmouseover='this.className="trdocu";' onmouseout='this.className="";' >
<td class="head" valign=top align=right> <b><?php echo $this->_tpl_vars['elem']['inco']; ?>
</b>
				<?php $this->assign('idtype', $this->_tpl_vars['elem']['idtype']); ?>
				<?php if ($this->_tpl_vars['idtype'] == 1): ?>
					<?php $this->assign('finaba', ((is_array($_tmp="/")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elem']['sour']['idfinabank']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elem']['sour']['idfinabank']))); ?>
				<?php else: ?>
					<?php $this->assign('finaba', ""); ?>
				<?php endif; ?>
<td valign=top> <nobr><?php echo ((is_array($_tmp=$this->_tpl_vars['ARTYPE'][$this->_tpl_vars['idtype']])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['finaba']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['finaba'])); ?>
 </nobr></td>
<td valign=top align=left>
						<?php if ($this->_tpl_vars['idtype'] == 1):  echo $this->_tpl_vars['elem']['sour']['date']; ?>
 <?php echo $this->_tpl_vars['elem']['sour']['hour']; ?>

						<?php elseif ($this->_tpl_vars['idtype'] == 2):  echo $this->_tpl_vars['elem']['cashdate']; ?>

						<?php else: ?>
&nbsp;
						<?php endif; ?>
<td align=center valign=top>
				<?php if ($this->_tpl_vars['idtype'] == 1): ?>
<img src="images/view.png" class="ttip" rel="#cont<?php echo $this->_tpl_vars['myid']; ?>
" title="ред от извлечението" style="cursor:help">
<span id="cont<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
	<table align=center>
	<tr>
	<td align=left valign=top> време
	<td width=10>
<td> <b><?php echo $this->_tpl_vars['elem']['sour']['date']; ?>
 <?php echo $this->_tpl_vars['elem']['sour']['hour']; ?>
</b>
	<tr>
	<td align=left valign=top> постъпление
	<td width=10>
<td> <b><?php echo $this->_tpl_vars['elem']['sour']['amount']; ?>
</b>
	<tr>
	<td align=left valign=top> описание
	<td width=10>
<td> <b><?php echo $this->_tpl_vars['elem']['sour']['desc1']; ?>
</b>
	<tr>
	<td align=left valign=top> кореспондент
	<td width=10>
<td> <b><?php echo $this->_tpl_vars['elem']['sour']['desc2']; ?>
</b>
	<tr>
	<td align=left valign=top> основание
	<td width=10>
<td> <b><?php echo $this->_tpl_vars['elem']['sour']['desc3']; ?>
</b>
	<tr>
	<td align=left valign=top> пояснения
	<td width=10>
<td> <b><?php echo $this->_tpl_vars['elem']['sour']['desc4']; ?>
</b>
	<tr>
	<td align=left valign=top> референция
	<td width=10>
<td> <b><?php echo $this->_tpl_vars['elem']['sour']['reference']; ?>
</b>
	</table>
</span>
				<?php else: ?>
<img src="images/view.png" title="<?php echo $this->_tpl_vars['elem']['descrip']; ?>
" style="cursor:help">
				<?php endif; ?>
<td align=center valign=top>
<a href="<?php echo $this->_tpl_vars['elem']['rest']; ?>
">
<img src="images/restore.gif" title="възстанови">
</a>
			<?php if (empty ( $this->_tpl_vars['elem']['idcase'] )): ?>
<td align=center valign=top>
			<?php else: ?>
<td align=left valign=top>
<span class="finahist" title="виж делото" onclick="document.location.href='<?php echo $this->_tpl_vars['elem']['viewcase']; ?>
'; return false;">
<?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>
 </span>
</td>
			<?php endif; ?>
<td align=left valign=top> <?php echo $this->_tpl_vars['elem']['username']; ?>
 &nbsp; </td>
<td align=right valign=top> 
	<?php if ($this->_tpl_vars['elem']['rest'] == 0): ?>
-
	<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['elem']['rest'])) ? $this->_run_mod_handler('tomoney', true, $_tmp, 2) : smarty_modifier_tomoney($_tmp, 2)); ?>

	<?php endif; ?>
</td>
<td align=center>
	<?php if ($this->_tpl_vars['elem']['idcase'] <> 0 && $this->_tpl_vars['elem']['rest'] == 0): ?>
		<?php if ($this->_tpl_vars['elem']['isclosed'] == 1): ?>
<span class="yes" title="ПРИКЛЮЧЕНО на <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['timeclosed'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
">&nbsp;</span>
		<?php else: ?>
&nbsp;
		<?php endif; ?>
	<?php else: ?>
<span class="no" title="приключването е невъзможно">&nbsp;</span>
	<?php endif; ?>
</td>
<td align=left>
	<?php if ($this->_tpl_vars['elem']['idcase'] <> 0 && $this->_tpl_vars['elem']['rest'] == 0): ?>
		<?php if ($this->_tpl_vars['elem']['isclosed'] == 1): ?>
			<?php if (empty ( $this->_tpl_vars['elem']['datebala'] )): ?>
				<?php $this->assign('daco', "няма"); ?>
				<?php $this->assign('dast', 'finahistno'); ?>
			<?php else: ?>
				<?php $this->assign('daco', ((is_array($_tmp=$this->_tpl_vars['elem']['datebala'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y"))); ?>
				<?php $this->assign('dast', 'finahist'); ?>
			<?php endif; ?>
				<?php if ($this->_tpl_vars['HIST']):  echo $this->_tpl_vars['daco']; ?>

				<?php else: ?>
<a href="<?php echo $this->_tpl_vars['elem']['date']; ?>
" class="nyroModal" target="_blank">
<span class="<?php echo $this->_tpl_vars['dast']; ?>
" title="корегирай датата"> <?php echo $this->_tpl_vars['daco']; ?>

</span></a>
				<?php endif; ?>
		<?php else: ?>
&nbsp;
		<?php endif; ?>
	<?php else: ?>
&nbsp;
	<?php endif; ?>
</td>

<?php endforeach; endif; unset($_from); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</table>


<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {
	$('.ttip').cluetip({ width: 300, local:true, cursor:'pointer' });
	$('.hist').cluetip({ width: 240, local:true, cursor:'pointer' });
	$('.finahist').cluetip({ width: 240, local:true, cursor:'pointer' });
$('.filt1').cluetip({
//	cluetipClass: 'rounded', 
	arrows: true, 
	width: 220,
	sticky: true,
	mouseOutClose: true,
	closeText: '<b>x</b>',
	closePosition: 'title'
	});
$('.info').cluetip({ width: 360, cursor:'help' });
});
</script>

