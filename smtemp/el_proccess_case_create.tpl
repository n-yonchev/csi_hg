{assign var="myheadcode" value="
<script type='text/javascript' src='autocomp/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='autocomp/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='autocomp/thickbox-compressed.js'></script>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
<link rel='stylesheet' type='text/css' href='autocomp/thickbox.css' />
<script type='text/javascript' src='js/_docuedit.js'></script>
"}
{include file="_ajax.header.tpl" HEADCODE=$myheadcode}

{assign var="_title" value='въведи нов документ за образуване на делa с ел партида'}

{include file='_window.header.tpl' TITLE=$_title TABS=$TABS}
{include file="_erform.tpl"}

{literal}
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
{/literal}
{*---- 10.04.2009 допълнително потвърждение само при серия нови дела+документи ----*}
<div class="loading">
    <img src="images/spinner.gif">
</div>
<table class="form-bg">
    <tr>
    {*---- лява зона ----*}
        <td valign=top>
            тип
            <br>

            {include file="_select.tpl" FROM=$ARDOCUTYPENAME ID="idtype" C1="input" C2="inputer" 
            ONCH="$('#text').attr('value',$(this).get(0).options[$(this).get(0).selectedIndex].text);"}
            <div id="base">
                описание
                <br> 
                <input type="text" name="text" id="text" size=50 {include file="_erelem.tpl" ID="text" C1="input" C2="inputer"}>

                <br> подател
                <br> 
                <input type="text" name="from" id="from" size=40 {include file="_erelem.tpl" ID="from" C1="input" C2="inputer"}>

                <br>бележки
                <br>
                <textarea rows=2 cols=55 name="notes" id="notes" {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}></textarea>

                <br> ключове за ел. изпълнителен лист
                <br> 
                <textarea name="el_process_list" cols=55 rows=4 id="el_process_list" {include file="_erelem.tpl" ID="el_process_list" C1="input" C2="inputer"}></textarea>
            </div>
                    
            <br>
            {include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
        </td>
    </tr>
</table>

{if isset($CASEER)}
    <span style="font: normal 8pt verdana;">
        <br>
        <br>
        грешки в списъка с дела
        {assign var=perrow value=6}
        {counter start=$perrow assign=coun}
        <table align=center class="calist">
            {foreach from=$CASEER item=ele2 key=key2}
                {if $coun==$perrow}
                    {counter start=1 assign=coun}
                    <tr>
                {else}
                    {counter assign=coun}
                {/if}

                {if $ele2.type==0}
                    {assign var=textti value="делото липсва. кликни, за да го създадеш"}
                    {assign var=tdclas value="erro"}
                    {assign var=onclic value="caseacti('cont"|cat:$ele2.idcode|cat:"','"|cat:$ele2.link|cat:"');"}
                {elseif $ele2.type==2}
                    {assign var=textti value="делото липсва, но номера превишава максималния "|cat:$ele2.link}
                    {assign var=tdclas value="erro"}
                    {assign var=onclic value=""}
                {else}
                    {assign var=textti value="дублирано дело"}
                    {assign var=tdclas value="dubl"}
                    {assign var=onclic value=""}
                {/if}

                <td id="cont{$ele2.idcode}"> 
                    <span class="{$tdclas}" title="{$textti}" onclick="{$onclic}"> 
                        {$ele2.text} 
                    </span>
                </td>
            {/foreach}
        </table>
    </span>
{/if}

{if $ISPOST or $EDIT==0 and $smarty.session.iscreacase}
{else}
    <script>
        $(document).ready(function() {ldelim}
            $('#creano').show();
        {rdelim});
    </script>
{/if}

<script>
    var sendlist= [
        {$SENDCODE}
    ];

    function caseacti(p1,p2){ldelim}
        $("#"+p1).html("<img src='ajaxload.gif'>");
        $("#"+p1).load(encodeURI("docucase.ajax.php"+p2));
    {rdelim}

    {*---- 17.10.2018 външен източник ----*}
    postclic();
    var oldtype= {$smarty.post.idtype} +0;

    function postclic(){ldelim}
	    var obje= document.getElementById("ispost");
        if(obje.checked){ldelim}
            oldtype= $('#idtype').val();
            $('#idtype').val({$EXTETYPE});
            $('#dipost').hide();
            $('#base').hide();
            {if $EDIT==0}
                $('#disour').show();
            {/if}
        {rdelim}else{ldelim}
            $('#idtype').val(oldtype);
            $('#base').show();
            {if $ISPOST}
                $('#dipost').hide();
            {else}
                $('#dipost').show();
            {/if}
            $('#disour').hide();
        {rdelim}

        resizeNyroModalIframe();
    {rdelim}

    function puttext(mark){ldelim}
        var obje= $("#idtype");
        $('#text').attr('value',$(obje).get(0).options[$(obje).get(0).selectedIndex].text);

        {*---- 28.11.2016 - отговор на запитване НАП ----*}
        {if $EDIT==0}
            if (mark==1){ldelim}
                var idcu= $(obje).val();
                if (arnapp[idcu]){ldelim}
                    $(document.body).html("<img src='ajaxload.gif'>");
                    document.location.href= arnapp[idcu];
                {rdelim}
            {rdelim}
        {/if}
    {rdelim}

    {*---- за взискател ----*}
    function toggno(obje){ldelim}
        var obcont= $("#docuclaizone");
        var oblist= $("#docuclailist");

        if ($(obje).attr("checked")){ldelim}
            $(obcont).show().focus();
            $(oblist).show();
        {rdelim}else{ldelim}
            $(obcont).hide();
            $(oblist).hide();
        {rdelim}

        resizeNyroModalIframe();
    {rdelim}

    {*---- за осн.данни ----*}
    function toggbase(obje){ldelim}
        var obcont= $("#docubasezone");

        if ($(obje).attr("checked")){ldelim}
            $(obcont).show().focus();
        {rdelim}else{ldelim}
            $(obcont).hide();
        {rdelim}

        resizeNyroModalIframe();
    {rdelim}

    function getdocuclai(event,obinpu){ldelim}
        var event= (event) ? event : window.event;
        var code= (event.charCode) ? event.charCode : event.keyCode;
        if (code==13){ldelim}
            var claivalu= $("#docuclai").val();

            $("#docuclailist").html("<img src='ajaxload.gif'>");
            $("#docuclailist").load(encodeURI("docueditsear.ajax.php?para="+claivalu),{ldelim}{rdelim},function() {ldelim}
                resizeNyroModalIframe();
            {rdelim});

            {*---- СТАНДАРТ -----*}
            {*---- ----------------------------------- -----*}
            event.preventDefault ? event.preventDefault() : (event.returnValue=false);
            event.stopPropagation ? event.stopPropagation() : (event.cancelBubble = true);

            return false;
            {*---- ----------------------------------- -----*}
        {rdelim}else{ldelim}
            return true;
        {rdelim}
    {rdelim}
</script>

{literal}
	<script type="text/javascript">
		function get_second_docuclai(event,obinpu){
			var event= (event) ? event : window.event;
			var code= (event.charCode) ? event.charCode : event.keyCode;
			if (code==13){
				var claivalu= $("#docusecoclai").val();

				$("#docuclailist").html("<img src='ajaxload.gif'>");
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
			var object = document.getElementById('secondclai');
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
                $(".loading").css('display', 'flex');
            });
        });
	</script>
{/literal}

<style>
    table.calist td span {ldelim}padding-left:10px;padding-right:10px;margin-left:4px;{rdelim}
    .norm {ldelim}color:black;cursor:help;{rdelim}
    .dubl {ldelim}color:white;background-color:black;cursor:help;{rdelim}
    .erro {ldelim}color:white;background-color:red;cursor:pointer;{rdelim}
    .e2inva {ldelim}color:white;background-color:orange;cursor:help;{rdelim}
    .e2exis {ldelim}color:white;background-color:green;cursor:help;{rdelim}
</style>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
