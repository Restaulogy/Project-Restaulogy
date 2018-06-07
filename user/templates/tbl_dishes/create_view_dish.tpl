    <div class="field-row">
		<label for="dish_chef_notes">{$_lang.tbl_dishes.label.dish_chef_notes}</label>
		<textarea name="dish_chef_notes" id="dish_chef_notes">{$smarty.post.dish_chef_notes}</textarea>
		<div class="error" id="dish_chef_notes_err"></div>
	</div>
	
    <div class="field-row">
		<label for="dish_ingrad_allergic_contents">{$_lang.tbl_dishes.label.dish_ingrad_allergic_contents}</label>
		<textarea name="dish_ingrad_allergic_contents" id="dish_ingrad_allergic_contents">{$smarty.post.dish_ingrad_allergic_contents}</textarea>
		<div class="error" id="dish_ingrad_allergic_contents_err"></div>
	</div>

	<div class="field-row">
		<label for="dish_allergy">{$_lang.tbl_dishes.label.dish_allergy}</label>
		<select id="dish_allergy" name="dish_allergy[]" multiple="multiple" data-native-menu="false" >
         <option value="" data-placeholder="true">Select From List</option>
		 {foreach $lst_allergies as $alergy}
		 	<option value="{$alergy@key}" {if $smarty.post.dish_allergy &&  in_array($alergy@key,$smarty.post.dish_allergy) }selected="selected"{/if}>{$alergy}</option>
		 {/foreach}
		 </select>
		 
		<div class="error" id="dish_allergy_err"></div>
	</div>


