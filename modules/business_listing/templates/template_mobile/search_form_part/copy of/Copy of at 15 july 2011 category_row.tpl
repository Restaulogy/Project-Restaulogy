<table style="width:780px;border:none;">
	<tr>
		<td style="width:70px;border-bottom:none;">
	 		<b style="font-size:12px;">&nbsp;Category</b>
		</td>

		<td style="width:710px;border-bottom:none;">
		<div id="dialog_category_form">
      <div id="job_write_tree" class="new_dTree" style="text-align:left;height:300px; overflow-y:scroll;">

        <!--<p><a href="javascript: d1.openAll();">open all</a> | <a href="javascript: d1.closeAll();">close all</a></p>-->
	{literal}
        <script type="text/javascript">

        d1 = new new_dTree('d1');
        d1.add(0,-1,'Categories','','');
        {/literal}

        {assign var ="cat_str" value=$smarty.post.categories|escape}
        {if $cat_str}
         {assign var=cat_list value=","|explode:$cat_str}
        {/if}
        
        {section name=citm loop=$vs_all_cat}
           {if  (in_array($vs_all_cat[citm].id, $cat_list) eq false) && ($vs_all_cat[citm].isdisable eq 1) }
                 <!-- Do not Add category -->
           {else}
               {literal}d1.add({/literal}{$vs_all_cat[citm].id}{literal},{/literal}{$vs_all_cat[citm].pid}{literal},{/literal}'{$vs_all_cat[citm].title}'{literal},'',{/literal}'<input type="checkbox" style="width:25px;" name="nodes" onclick="cycleCheckboxes_div();" id="nodes{$vs_all_cat[citm].id}" value="{$vs_all_cat[citm].id}" {if in_array($vs_all_cat[citm].id, $cat_list) eq true}CHECKED{/if} {if $vs_all_cat[citm].isdisable eq 1}DISABLED{/if}/> <input type="hidden" id="node_title{$vs_all_cat[citm].id}" value="{$vs_all_cat[citm].title}" /><input type="hidden" id="node_parent{$vs_all_cat[citm].id}" value="{$vs_all_cat[citm].pid}" /><input type="hidden" value="{$vs_all_cat[citm].isdisable}"/>'{literal}){/literal}
           {/if}
        {/section}

        {literal}
       document.write(d1);
        </script>
    {/literal}
   </div>

      </div>

      <a href='#' onclick="$('#dialog_category_form').dialog('open');" style='font-size:12px;font-weight:bold;'>Select Category</a><span id="cat_list">
       <!--
                {if $cat_str}
                 <b style="color:black;font-size:14px;"><u>Selected Categories</u>:<b/>{assign var=cat_str value=","|explode:$cat_str}{assign var=list_cat value=","|explode:$list_category}{section name=itm loop=$cat_list}{if $cat_list[itm]>0}{if $smarty.section.itm.index > 0}|{/if}<a href="#" style="font-size:10px;" onclick="uncheck_element({$cat_list[itm]})" >{strip}{$list_cat[itm]}{/strip}</a>{/if}{/section}{/if}
        -->
        					</span>

{literal}
<script type='text/javascript'>
function cycleCheckboxes(what) {
    var myStr="";
    for (var i = 0; i<what.elements.length; i++) {
        if ((what.elements[i].name.indexOf('nodes') > -1)) {
            if (what.elements[i].checked) {
                myStr += what.elements[i].value + ',';
            }
        }
    }
    var strLen = myStr.length;
	myStr = myStr.slice(0,strLen-1);
	document.getElementById("searchform_categories").value=myStr;
}

function cycleCheckboxes_div()
{
	var myStr="";
	var mycatstr="";
	var my_nodes = document.getElementById('job_write_tree').getElementsByTagName('input');
	var i;
    for (var i = 0; i<my_nodes.length; i++) {
        if ((my_nodes[i].name.indexOf('nodes') > -1)) {
            if (my_nodes[i].checked) {
                //window.opener.document.form1.valor.value += what.elements[i].value + ',';
                 var catstr="";

                    myparentid = document.getElementById('node_parent'+my_nodes[i].value).value;
                   while (myparentid!=0){

                      if(document.getElementById('nodes'+myparentid).checked == false){
                           document.getElementById('nodes'+myparentid).checked = true ;
                                myStr += myparentid + ',';
						    catstr = 'node_title' +myparentid;
                            mycatstr += '<a href="#" style="font-size:10px;" onclick="uncheck_element('+myparentid+');" >' + document.getElementById(catstr).value + '</a>|';
                        }
                           myparentid = document.getElementById('node_parent'+myparentid).value;

                   }
                   myStr += my_nodes[i].value + ',';
                    var catstr="";
                    catstr = 'node_title' +my_nodes[i].value;
                    mycatstr += '<a href="#" style="font-size:10px;" onclick="uncheck_element('+ my_nodes[i].value+');" >' + document.getElementById(catstr).value + '</a>|';

            }
        }
    }
      var strLen = myStr.length;
	  myStr = myStr.slice(0,strLen-1);
	  strLen = mycatstr.length;
	  mycatstr = mycatstr.slice(0,strLen-1);
	 document.getElementById("searchform_categories").value=myStr;
	 document.getElementById("cat_list").innerHTML = "";
	 if (strLen>0)
	  {

	      document.getElementById("cat_list").innerHTML = '&nbsp;&nbsp;<b style="color:black;font-size:11px;"><u>Selected Categories</u>&nbsp;:<b/>&nbsp;'+ mycatstr + ' ';
	  }

}

function  uncheck_element(e_id)
    {
		var e_str = "";
		e_str = 'nodes' + e_id;
		document.getElementById(e_str).click();

	}
function in_array( what, where  ){
 	var a=-1;
	 	for(var i=0;i<where.length;i++){
  			if(what == where[i]){
    			a=i;
		       break;
   			}
   	} 	return a;

}
</script>
{/literal}
    <input type="text" style='display:none;' name="categories" id="searchform_categories" value="{$smarty.post.categories|escape}"/>
	</td>
	</tr>
</table>
