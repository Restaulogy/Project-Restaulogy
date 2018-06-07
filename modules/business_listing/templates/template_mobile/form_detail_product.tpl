<table class="job_detail_panal_table">
 <tr>
  <td class="detail_right_td">
     Products and services
  </td>
 	<td class="detail_left_td">
    <div style="width:200px;overflow-x:scroll !important">
    <textarea style="width:95%;" rows="5" id="xtra_1" name="xtra_1">{if $xtra_1}{$xtra_1}{else}{$smarty.post.xtra_1}{/if}</textarea>
    <div class="toggle_editor_container" onchange="tinyMCE.triggerSave();"><a class="toggle_editor" href="javascript:toggleEditor('xtra_1');">Add/Remove editor</a></div>
    </div>
  </td>
</tr>
</table>

