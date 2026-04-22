<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from deliinfobase.ajax.tpl */ ?>
<style>
.he7 {font: normal 7pt verdana !important; background-color:silver !important; padding-left:4px;}
.ro7 {font: normal 7pt verdana !important; border-bottom: 1px solid black !important;}
.ertype {background-color:lightsalmon;cursor:help;}
</style>
			<?php if ($this->_tpl_vars['ISTTIP']): ?>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script>
$(document).ready(function() {
	$('.deliinfo').cluetip({ width: 660, cursor:'help' });
});
</script>
			<?php else: ?>
			<?php endif; ?>