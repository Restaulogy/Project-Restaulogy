{include file='header.tpl'}
{literal}
<style type="text/css">
	 #div1 {
         float:left;
    	 display-inline:inline-block; width:15%;
    	 border:1px solid #fff;background: #efefef;
    	 margin:1%;
    	 min-height:200px;
	 }
	 table#div2 {
    	 margin:1%;
    	 display-inline:inline-block;
    	 width:80%;float:left;
    	 border:1px solid #fff;background: #efefef;
    	 border-spacing: 10px;
         border-collapse: separate;
	 }
	 table#div2 td{
	 	 border:1px solid #000;
		 width:18%; 
		 height:120px;
		 padding:1%;
		 
	 }
	  #div1 img, table#div2 td img{
	 	width :120px;
		height:120px;
		margin:5px 15px;
		display:inline-block; 
	 }
	  table#div2 td img{
			margin:0px;
		}
		 
</style>
{/literal}

<div class="wrapper" > 
<h1>{$_lang.tbl_table_type.layout}</h1> 

{if $error_msg}
	<center>{$error_msg}</center>
{/if}
{include file="tbl_table_layout/tabs.tpl"}

 <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)">
	 {foreach $divtables as $table}
			<img src="{$website}/images/tables/{$table@key}.png" class="flip-horizontal" draggable="true" alt="{$table@key}" ondragstart="drag(event)" id="drag{$table@key}" />
	{/foreach}
 </div>
  	
 <table id="div2" ondrop="drop(event)" ondragover="allowDrop(event)">
  {for $i=0;$i<5;$i++}
 	<tr>
		 {for $j=0;$j<5;$j++}
    		 <td id="cell_{$i}_{$j}" posX="{$i}" posY="{$j}">
                 {if $gridtable["{$i}_{$j}"]}
                    <img src="{$website}/images/tables/{$gridtable["{$i}_{$j}"].table_id}.png"  draggable="true" alt="{$gridtable["{$i}_{$j}"].table_id}" ondragstart="drag(event)" id="drag{$gridtable["{$i}_{$j}"].table_id}" />
                 {/if}
             </td>
		 {/for}		 
	</tr> 
	{/for}	
 </table>


</div> <!--/#wrapper-->
{include file='footercontent.tpl'}
{literal}  

<script type="text/javascript">
 
  function save_layout_position(table,posX,posY){
		if(table > 0){ 
			ajaxian({'action':'save_layout_position','var1':table,'var2':posX,'var3':posY },function(){  alert('Transfered Successfully'); }); 
		} 
	}

	function allowDrop(ev){
		ev.preventDefault();
	}
	 
	function drag(ev){
		//target1 = ev.target.cloneNode(true);
		 ev.dataTransfer.setData("Text",ev.target.id);
	}

	function drop(ev){
		ev.preventDefault();
		//alert(ev.target.tagName);
		if(ev.target.tagName.toUpperCase() == 'IMG'){
			
		}else{ 
			var data=ev.dataTransfer.getData("Text");
		  var table_id = $('#' + data).attr('alt');
			//alert(table_id);
			var posX = -1; var posY = -1;
		  if(table_id > 0){  
                //alert(ev.target.tagName.toUpperCase());
                if(ev.target.tagName.toUpperCase() == 'TABLE'){

                }else if(ev.target.tagName.toUpperCase() == 'TD'){
			 		 cell_id = ev.target.id;
					 var objcell = $('#' + cell_id);
                     //alert(trim(ev.target.innerHTML.length));
					 if(IsNonEmpty(ev.target.firstChild.innerHTML)==false){
						 ev.target.appendChild(document.getElementById(data));
						 posX = objcell.attr('posX');
						 posY = objcell.attr('posY');
						 save_layout_position(table_id,posX,posY);
					 } 
				 }else{
				 	ev.target.appendChild(document.getElementById(data));
				    save_layout_position(table_id,posX,posY);
				 }
			} 
		} 
	}
</script>
{/literal} 
</body></html>
