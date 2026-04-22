<?php /* Smarty version 2.6.9, created on 2020-02-27 13:05:07
         compiled from _archive.inc.tpl */ ?>
							<?php if ($this->_tpl_vars['FLAGARCHIVE']): ?>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script>
$(document).ready(function() {
	$('.arch').cluetip({ width: 300, local:true, cursor:'pointer' });
});
</script>
							<?php else: ?>
							<?php endif; ?>