{************************ Date Control For The Mobile Site ***************************


	1) $field_id =  id For the Field which will be used on the further opertion. it must be uniqe
	2) $field_name = name for the field


 *************************************************************************************}

		<table id="{$field_id}_contain" style="width:100%;">
			<tr>
				<td VALIGN="TOP" style="width:80%;">
					<input style="width:100%;" data-inline="true" type="date" name="{$field_name}" id="{$field_id}" value="" READONLY/>
				</td>
                <td VALIGN="TOP" style="width:20%;">
                    <a data-inline="true" href="#" id="{$field_id}_showcal" data-role="button" data-iconpos="notext" data-icon="grid" title="Show Calander" onclick='javascript:toggle_datepicker("{$field_id}", 1);'></a>
            <a style="display:none;" data-inline="true" href="#" id="{$field_id}_hidecal" data-role="button" data-iconpos="notext" data-icon="grid" title="Hide Calander" onclick='javascript:toggle_datepicker("{$field_id}", 0);'></a>
				</td>
			</tr>
		</table>

