<?php /* Smarty version 2.6.9, created on 2026-03-10 15:41:48
         compiled from el_proccess_case_create.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'el_proccess_case_create.tpl', 76, false),array('modifier', 'cat', 'el_proccess_case_create.tpl', 89, false),)), $this); ?>
<?php $this->assign('myheadcode', "
<script type='text/javascript' src='autocomp/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='autocomp/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='autocomp/thickbox-compressed.js'></script>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
<link rel='stylesheet' type='text/css' href='autocomp/thickbox.css' />
<script type='text/javascript' src='js/_docuedit.js'></script>
"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array('HEADCODE' => $this->_tpl_vars['myheadcode'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->assign('_title', 'въведи нов документ за образуване на делa с ел партида'); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['_title'],'TABS' => $this->_tpl_vars['TABS'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<style>
    .loading {
        position: fixed;
        background-color: #cad9ec;
        width: 100%;
        height: 100%;
        top: -5px;
        left: -5px;
        display: flex;
        align-items: center;
        justify-content: center;
        display: none;
    }
</style>
'; ?>

<div class="loading">
    <img src="images/spinner.gif">
</div>
<table class="form-bg">
    <tr>
            <td valign=top>
            тип
            <br>

            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARDOCUTYPENAME'],'ID' => 'idtype','C1' => 'input','C2' => 'inputer','ONCH' => "$('#text').attr('value',$(this).get(0).options[$(this).get(0).selectedIndex].text);")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <div id="base">
                описание
                <br> 
                <input type="text" name="text" id="text" size=50 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'text','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>

                <br> подател
                <br> 
                <input type="text" name="from" id="from" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'from','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>

                <br>бележки
                <br>
                <textarea rows=2 cols=55 name="notes" id="notes" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'notes','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>></textarea>

                <br> ключове за ел. изпълнителен лист
                <br> 
                <textarea name="el_process_list" cols=55 rows=4 id="el_process_list" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'el_process_list','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>></textarea>
            </div>
                    
            <br>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </td>
    </tr>
</table>

<?php if (isset ( $this->_tpl_vars['CASEER'] )): ?>
    <span style="font: normal 8pt verdana;">
        <br>
        <br>
        грешки в списъка с дела
        <?php $this->assign('perrow', 6); ?>
        <?php echo smarty_function_counter(array('start' => $this->_tpl_vars['perrow'],'assign' => 'coun'), $this);?>

        <table align=center class="calist">
            <?php $_from = $this->_tpl_vars['CASEER']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['ele2']):
?>
                <?php if ($this->_tpl_vars['coun'] == $this->_tpl_vars['perrow']): ?>
                    <?php echo smarty_function_counter(array('start' => 1,'assign' => 'coun'), $this);?>

                    <tr>
                <?php else: ?>
                    <?php echo smarty_function_counter(array('assign' => 'coun'), $this);?>

                <?php endif; ?>

                <?php if ($this->_tpl_vars['ele2']['type'] == 0): ?>
                    <?php $this->assign('textti', "делото липсва. кликни, за да го създадеш"); ?>
                    <?php $this->assign('tdclas', 'erro'); ?>
                    <?php $this->assign('onclic', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp="caseacti('cont")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ele2']['idcode']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ele2']['idcode'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "','") : smarty_modifier_cat($_tmp, "','")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ele2']['link']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ele2']['link'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "');") : smarty_modifier_cat($_tmp, "');"))); ?>
                <?php elseif ($this->_tpl_vars['ele2']['type'] == 2): ?>
                    <?php $this->assign('textti', ((is_array($_tmp="делото липсва, но номера превишава максималния ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ele2']['link']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ele2']['link']))); ?>
                    <?php $this->assign('tdclas', 'erro'); ?>
                    <?php $this->assign('onclic', ""); ?>
                <?php else: ?>
                    <?php $this->assign('textti', "дублирано дело"); ?>
                    <?php $this->assign('tdclas', 'dubl'); ?>
                    <?php $this->assign('onclic', ""); ?>
                <?php endif; ?>

                <td id="cont<?php echo $this->_tpl_vars['ele2']['idcode']; ?>
"> 
                    <span class="<?php echo $this->_tpl_vars['tdclas']; ?>
" title="<?php echo $this->_tpl_vars['textti']; ?>
" onclick="<?php echo $this->_tpl_vars['onclic']; ?>
"> 
                        <?php echo $this->_tpl_vars['ele2']['text']; ?>
 
                    </span>
                </td>
            <?php endforeach; endif; unset($_from); ?>
        </table>
    </span>
<?php endif; ?>

<?php if ($this->_tpl_vars['ISPOST'] || $this->_tpl_vars['EDIT'] == 0 && $_SESSION['iscreacase']): ?>
<?php else: ?>
    <script>
        $(document).ready(function() {
            $('#creano').show();
        });
    </script>
<?php endif; ?>

<script>
    var sendlist= [
        <?php echo $this->_tpl_vars['SENDCODE']; ?>

    ];

    function caseacti(p1,p2){
        $("#"+p1).html("<img src='ajaxload.gif'>");
        $("#"+p1).load(encodeURI("docucase.ajax.php"+p2));
    }

        postclic();
    var oldtype= <?php echo $_POST['idtype']; ?>
 +0;

    function postclic(){
	    var obje= document.getElementById("ispost");
        if(obje.checked){
            oldtype= $('#idtype').val();
            $('#idtype').val(<?php echo $this->_tpl_vars['EXTETYPE']; ?>
);
            $('#dipost').hide();
            $('#base').hide();
            <?php if ($this->_tpl_vars['EDIT'] == 0): ?>
                $('#disour').show();
            <?php endif; ?>
        }else{
            $('#idtype').val(oldtype);
            $('#base').show();
            <?php if ($this->_tpl_vars['ISPOST']): ?>
                $('#dipost').hide();
            <?php else: ?>
                $('#dipost').show();
            <?php endif; ?>
            $('#disour').hide();
        }

        resizeNyroModalIframe();
    }

    function puttext(mark){
        var obje= $("#idtype");
        $('#text').attr('value',$(obje).get(0).options[$(obje).get(0).selectedIndex].text);

                <?php if ($this->_tpl_vars['EDIT'] == 0): ?>
            if (mark==1){
                var idcu= $(obje).val();
                if (arnapp[idcu]){
                    $(document.body).html("<img src='ajaxload.gif'>");
                    document.location.href= arnapp[idcu];
                }
            }
        <?php endif; ?>
    }

        function toggno(obje){
        var obcont= $("#docuclaizone");
        var oblist= $("#docuclailist");

        if ($(obje).attr("checked")){
            $(obcont).show().focus();
            $(oblist).show();
        }else{
            $(obcont).hide();
            $(oblist).hide();
        }

        resizeNyroModalIframe();
    }

        function toggbase(obje){
        var obcont= $("#docubasezone");

        if ($(obje).attr("checked")){
            $(obcont).show().focus();
        }else{
            $(obcont).hide();
        }

        resizeNyroModalIframe();
    }

    function getdocuclai(event,obinpu){
        var event= (event) ? event : window.event;
        var code= (event.charCode) ? event.charCode : event.keyCode;
        if (code==13){
            var claivalu= $("#docuclai").val();

            $("#docuclailist").html("<img src='ajaxload.gif'>");
            $("#docuclailist").load(encodeURI("docueditsear.ajax.php?para="+claivalu),{},function() {
                resizeNyroModalIframe();
            });

                                    event.preventDefault ? event.preventDefault() : (event.returnValue=false);
            event.stopPropagation ? event.stopPropagation() : (event.cancelBubble = true);

            return false;
                    }else{
            return true;
        }
    }
</script>

<?php echo '
	<script type="text/javascript">
		function get_second_docuclai(event,obinpu){
			var event= (event) ? event : window.event;
			var code= (event.charCode) ? event.charCode : event.keyCode;
			if (code==13){
				var claivalu= $("#docusecoclai").val();

				$("#docuclailist").html("<img src=\'ajaxload.gif\'>");
				$("#docuclailist").load(encodeURI("docueditsear.ajax.php?second=true&para="+claivalu),{},function() {
					resizeNyroModalIframe();
                    setTimeout("resizeNyroModalIframe();",1000);
				});

				/*---- СТАНДАРТ -----*/
				/*---- ----------------------------------- -----*/
				event.preventDefault ? event.preventDefault() : (event.returnValue=false);
				event.stopPropagation ? event.stopPropagation() : (event.cancelBubble = true);
				return false;
				/*---- ----------------------------------- -----*/
			}else{
				return true;
			}
		}

		function toggleSecondClaimer(){
			var object = document.getElementById(\'secondclai\');
			var obcont= $("#docusecoclaizone");
			if ($(object).attr("checked")){
				$(obcont).show().focus();
			}else{
				$(obcont).hide();
			}

			resizeNyroModalIframe();
		}

        $("document").ready(function () {
            $("#submit").click(function() {
                console.log("test loading");
                $(".loading").css(\'display\', \'flex\');
            });
        });
	</script>
'; ?>


<style>
    table.calist td span {padding-left:10px;padding-right:10px;margin-left:4px;}
    .norm {color:black;cursor:help;}
    .dubl {color:white;background-color:black;cursor:help;}
    .erro {color:white;background-color:red;cursor:pointer;}
    .e2inva {color:white;background-color:orange;cursor:help;}
    .e2exis {color:white;background-color:green;cursor:help;}
</style>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>