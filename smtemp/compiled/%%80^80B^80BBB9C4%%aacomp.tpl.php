<?php /* Smarty version 2.6.9, created on 2020-07-03 14:22:33
         compiled from aacomp.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'aacomp.tpl', 57, false),array('modifier', 'replace', 'aacomp.tpl', 70, false),array('modifier', 'nl2br', 'aacomp.tpl', 123, false),)), $this); ?>
<table class="d_table" width=';' cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
	<td class='d_table_title' colspan='200'>списък на жалбите </td>
		</tr>
	</thead>
		<tr class='header'>
<td><span> вх.номер </span></td>
		<td class='sep'>&nbsp;</td>
<td><span> постъпила </span></td>
		<td class='sep'>&nbsp;</td>
<td><span> описание</span></td>
		<td class='sep'>&nbsp;</td>
<td><span> подател</span></td>
		<td class='sep'>&nbsp;</td>
<td><span> бележки</span></td>
		<td class='sep'>&nbsp;</td>
<td><span> въвел </span></td>
		<td class='sep'>&nbsp;</td>
<td><span> към дело</span></td>
		<td class='sep'>&nbsp;</td>
<td> <span>деловодител</span></td>
		<td class='sep'>&nbsp;</td>
<td> статус </td>
		<td class='sep'>&nbsp;</td>
<td> дата </td>
		<td class='sep'>&nbsp;</td>
<td> бележки </td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		</tr>
		<tbody>
<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
	<tr onmouseover='this.className="trdocu";' onmouseout='if(this!==trcurr)this.className="";' onclick="trclic(this);">
		<td align=right> <?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>
</td>
		<td class='sep'>&nbsp;</td>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['docucrea'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

		<td class='sep'>&nbsp;</td>
		<td> <?php echo $this->_tpl_vars['elem']['text']; ?>
</td>
		<td class='sep'>&nbsp;</td>
		<td> <?php echo $this->_tpl_vars['elem']['from']; ?>
</td>
		<td class='sep'>&nbsp;</td>
<td align=center>
	<?php if (empty ( $this->_tpl_vars['elem']['notes'] )): ?>
&nbsp;
	<?php else: ?>
<img src="images/view.png" title='<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elem']['notes'])) ? $this->_run_mod_handler('replace', true, $_tmp, ";", "; ") : smarty_modifier_replace($_tmp, ";", "; ")))) ? $this->_run_mod_handler('replace', true, $_tmp, ",", ", ") : smarty_modifier_replace($_tmp, ",", ", ")); ?>
'>
	<?php endif; ?>
		<td class='sep'>&nbsp;</td>
<td align=center>
<img src="images/view.png" title='<?php echo $this->_tpl_vars['elem']['u2name']; ?>
'>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_docucase.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['ARSTAT'][$this->_tpl_vars['elem']['currstat']]; ?>
 <?php echo $this->_tpl_vars['stin']; ?>

		<td class='sep'>&nbsp;</td>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['currdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

		<td class='sep'>&nbsp;</td>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['notes'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

		<td class='sep'>&nbsp;</td>
<td align=center>
<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="промени"></a>
		</tr>

		<?php endforeach; endif; unset($_from); ?>
		</tbody>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
		</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {
	$('.caselist').cluetip({ width: 240, local:true, cursor:'pointer' });
});
var trcurr;
function trclic(obje){
	if (trcurr){
		trcurr.className= "";
	}else{
	}
	obje.className= "trdocu";
	trcurr= obje;
}
</script>
