<?php /* Smarty version 2.6.9, created on 2024-10-28 16:58:06
         compiled from agentmakeeq.ajax.tpl */ ?>
<?php $this->assign('myheadcode', "
<script type='text/javascript' src='autocomp/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='autocomp/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='autocomp/thickbox-compressed.js'></script>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
<link rel='stylesheet' type='text/css' href='autocomp/thickbox.css' />
");  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array('HEADCODE' => $this->_tpl_vars['myheadcode'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.header.tpl", 'smarty_include_vars' => array('TITLE' => 'приравняване към друг представител')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

Ще приравните <nobr> <b><?php echo $this->_tpl_vars['AGNAME']; ?>
 (<?php echo $this->_tpl_vars['AGCOUN']; ?>
)</b> </nobr>
<br>
към друг представител.
<br>
<br>
Изберете другия представител (въведи текст)
<br>
<input type="text" name="newagent" id="newagent" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'newagent','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
<br>
<b>ВНИМАНИЕ.</b>
<br>
<br>
След приравняването ВСИЧКИТЕ <?php echo $this->_tpl_vars['AGCOUN']; ?>
 на 
<br>
<b><?php echo $this->_tpl_vars['AGNAME']; ?>
</b>
ще преминат към новия представител,
<br>
<br>
<b><?php echo $this->_tpl_vars['AGNAME']; ?>
</b> ще остане БЕЗ ДЕЛА и може да бъде изтрит.
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'приравни','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
//$('#newagent').autocomplete("agentauto.ajax.php",{matchContains:false, cacheLength:20, extraParams:{idmark:<?php echo $this->_tpl_vars['IDMARK']; ?>
}});
	$('#newagent').autocomplete("agentauto.ajax.php",{matchContains:false, cacheLength:20, scrollHeight:400
	,formatItem: function(data, i, total) {
		var mycase= (data[2]) ? data[2] : 0;
		var mytext= (mycase==1) ? " дело" : " дела";
		var mycont= data[0]+" ["+mycase+mytext+"]";
			if (data[1]==<?php echo $this->_tpl_vars['IDMARK']; ?>
){
	return "<font color=red>"+mycont+"</font>";
			}else{
	return mycont;
			}
		}
	});
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>