<?php /* Smarty version 2.6.9, created on 2020-02-27 14:21:09
         compiled from fdxxlist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'fdxxlist.tpl', 51, false),array('modifier', 'date_format', 'fdxxlist.tpl', 56, false),)), $this); ?>

<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
<td class='d_table_title' colspan='200'> списък входящи документи <?php echo $this->_tpl_vars['FILTTX']; ?>
</td>
	</tr>
</thead>
					<?php if (count ( $this->_tpl_vars['LIST'] ) == 0): ?>
<tr>
<td>
няма вх.документи
					<?php else: ?>
<tr class='header'>
		<td><span> вх.номер </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> описание</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> подател</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> бележки</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> въвел </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> кога </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> към дело</span></td>
		<td class='sep'>&nbsp;</td>
		<td> <span>деловодител</span></td>
		<td class='sep'>&nbsp;</td>
<td> &nbsp; </td>
</tr>

<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
		<td align=right> <?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>
</td>
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
		<td> <?php echo $this->_tpl_vars['elem']['u2name']; ?>
 </td>
		<td class='sep'>&nbsp;</td>
		<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_docucase.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<td class='sep'>&nbsp;</td>
<td  align=center><a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
	</tr>
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
					<?php endif; ?>