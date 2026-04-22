<?php /* Smarty version 2.6.9, created on 2020-02-28 11:16:39
         compiled from deliexte.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'deliexte.tpl', 61, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "delihead.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.inputlink {background:khaki;font:normal 8pt verdana;}
</style>

<br>
				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head1'>
<td colspan='200'>
Списък на документи от външни източници според текущия филтър
&nbsp;&nbsp;&nbsp;&nbsp;
														<span class="doinpu">
само от избран източник
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARSOURPOSTNAME'],'ID' => 'idsour','C1' => 'inputlink','C2' => 'input','ONCH' => "document.location.href=$(this).get(0).options[$(this).get(0).selectedIndex].value;")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
							</span>
											<tr class='head2'>
<td> вх.ном
<td> дата
<td> източник
<td> адресат
<td> адрес
<td> метод
<td class="head3"> взет
<td class="head3"> връчен
<td class="head3"> върнат
<td class="head3"> статус
<td class="head3"> бел
<td class="head3"> &nbsp;
<td class="head3"> <input class="cbox" type=checkbox name="cball" id="cball" onclick="cbtran($(this).attr('checked'));">
<script>
function cbtran(flag){
	if (flag){
		$("input[@name='cbdeli[]']").attr("checked",true);
	}else{
		$("input[@name='cbdeli[]']").attr("checked",false);
	}
}
</script>
	
	<?php $_from = $this->_tpl_vars['ARPOST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idpost'] => $this->_tpl_vars['elpost']):
?>
				<tr>
<td> <?php echo $this->_tpl_vars['elpost']['serial']; ?>
/<?php echo $this->_tpl_vars['elpost']['year']; ?>

		<?php if (empty ( $this->_tpl_vars['elpost']['docunotes'] )): ?>
		<?php else: ?>
<img src="images/view.png" title='<?php echo $this->_tpl_vars['elpost']['docunotes']; ?>
'>
		<?php endif; ?>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elpost']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td> <?php echo $this->_tpl_vars['elpost']['sourname']; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "deli2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php endforeach; endif; unset($_from); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2pagi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<tr>
<td colspan=20>
	<div style="float:right">
	само в маркираните документи
<br>
<div class="link butt" onclick="fubegi('<?php echo $this->_tpl_vars['LINKEDIT']; ?>
');"> корегирай полета </div>
<div class="link butt" onclick="fubegi('<?php echo $this->_tpl_vars['LINKCLEAR']; ?>
');"> изчисти полета </div>
	</div>

				</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "deli.inc.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {
	$("#idsour").val("<?php echo $this->_tpl_vars['IDSOUR']; ?>
");
	$('.ctip').cluetip({ width: 300, local:true, cursor:'pointer' });
});
</script>
