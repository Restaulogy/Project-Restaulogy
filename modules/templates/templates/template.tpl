{include file="header.tpl"}

<form onsubmit="return validate_form();" action="{$elgg_main_url}templates/templates.php" method="post" class="detail_view" enctype="multipart/form-data">
            <table style="border:1px solid gray;">
                <tr>
                    <th colspan="2">
                        Select Template
                    </th>
                </tr>
                <tr>
                    <td class="right_td">Post Title</td>
                    <td class="left_td">
                       <input type="text" name="post_title" value="{$post_title}"/>
                    </td>
                </tr>
                <tr>
                    <td class="right_td">Select Template</td>
                    <td class="left_td">
                        <select name="template_id" id="template_id">
                        
                         {if $templates_info}
                     		{section name=itm loop=$templates_info}
                                    <option  value="{$templates_info[itm].id}"  {if $templates_info[itm].id == $template_id || $templates_info[itm].id == $smarty.post.template_id }selected="selected"{/if}>{$templates_info[itm].title}</option>
                            {/section}
                        {/if}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="right_td">Template Images</td>
                    <td class="left_td">
                        <select name="templates_image_id" id="templates_image_id">

                         {if $templates_images}
                     		{section name=citm loop=$templates_images}
                                    <option  value="{$templates_images[citm].id}"  {if $templates_images[citm].id == $templates_image_id || $templates_info[citm].id == $smarty.post.templates_image_id }selected="selected"{/if}>{$templates_images[citm].title}</option>
                            {/section}
                        {/if}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="right_td">Upload Image</td>
                    <td class="left_td">
                        <input type="file" name="template_image"/>
                    </td>
                </tr>
                <tr>
                    <td class="right_td">Your Name</td>
                    <td class="left_td">
                       <input type="text" name="your_name" value="{$sender_name}"/>
                    </td>
                </tr>
                <tr>
                    <td class="right_td">Your Email</td>
                    <td class="left_td">
                       <input type="text" name="your_mail" value="{$sender_email}"/>
                    </td>
                </tr>
                <tr>
                    <td class="right_td">Connections Name</td>
                    <td class="left_td">
                       <input type="text" id="" name="friend_name" value="{$receiver_name}"/>
                    </td>
                </tr>
                <tr>
                    <td class="right_td">Connections Email</td>
                    <td class="left_td">
                       <input type="text" id="" name="friend_email" value="{$receiver_mail}"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="post_id" value="{$post_id}"/>
                        <input type="hidden" name="receiver_id" value="{$receiver_id}"/>
                        <input type="hidden" name="template_type"  value="{$template_type}"/>
                        <input type="submit" width="170" name="preview" value="Preview">
                        <input type="submit" width="170" name="send" value="Send">
                        <input type="submit" width="170" name="print" value="Print">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="bottom_line"></td>
                </tr>
            </table>



        </form>


{include file="footer.tpl"}
