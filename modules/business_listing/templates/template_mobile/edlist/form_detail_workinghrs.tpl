<div data-role="page" id="workhrs">
    {include file="$deftpl/edlist/header.tpl"}
    <div data-role="content">

  {php}
     $_vs_current_listing=$this->get_template_vars("vs_current_listing");
     $_vs_current_listing=$_vs_current_listing["business_hours"];
  {/php}

  {literal}
 <script type="text/javascript">
  function validate_wrk_hrs(start_hrs , end_hrs ){
    var start_hr =  parseInt(start_hrs.replace(":"));
    var end_hr =  parseInt(end_hrs.replace(":"));
    if((isNaN(start_hr)==false) && (isNaN(end_hr)==false)){
       var start_tm = start_hrs.split(":");
       if((parseInt(start_tm[0]) == 0) && (start_tm[0]!='00')){
           start_tm[0] = start_tm[0].replace('0', '');
       }
       var start_time = (parseInt(start_tm[0])* 60) + parseInt(start_tm[1]);
       var end_tm = end_hrs.split(":");
       if((parseInt(end_tm[0]) == 0) && (end_tm[0]!='00')){
           end_tm[0] = end_tm[0].replace('0', '');
       }
       var end_time = (parseInt(end_tm[0])* 60) + parseInt(end_tm[1]);

       if(end_time > start_time){
           return true;
       }
    }else if((isNaN(start_hr)) && (isNaN(end_hr))){
       return true;
    }
    return false;
 }
 
  function validate_week_wrk_hrs(){
      var weekdays =new Array("sun","mon","tues", "wed", "fri","sat");
      var error = true;
        /*
for (x in weekdays){
          if (validate_wrk_hrs(document.getElementById(weekdays[x]+'_start').value ,document.getElementById(weekdays[x]+'_end').value)==false){
              document.getElementById(weekdays[x]+'_hrs_error').style.display = 'block';
                error = false;
          }else{
              document.getElementById(weekdays[x]+'_hrs_error').style.display = 'none';
          }
        }
*/
        return error;
  }

  function apply_def_wrk_hrs(){

     //if(validate_wrk_hrs($('#def_start').val(),$('#def_end').val())){
        //..Set monday Timing To Default
            $('#mon_start').val($('#def_start').val());
            $('#mon_end').val($('#def_end').val());
            $('#mon_start').selectmenu('refresh');
            $('#mon_end').selectmenu('refresh');
        //..Set tuesday Timing To Default
            $('#tues_start').val($('#def_start').val());
            $('#tues_end').val($('#def_end').val());
            $('#tues_start').selectmenu('refresh');
            $('#tues_end').selectmenu('refresh');
        //..Set wedday Timing To Default
            $('#wed_start').val($('#def_start').val());
            $('#wed_end').val($('#def_end').val());
            $('#wed_start').selectmenu('refresh');
            $('#wed_end').selectmenu('refresh');
        //..Set thursday Timing To Default
            $('#thurs_start').val($('#def_start').val());
            $('#thurs_end').val($('#def_end').val());
            $('#thurs_start').selectmenu('refresh');
            $('#thurs_end').selectmenu('refresh');
        //..Set friday Timing To Default
            $('#fri_start').val($('#def_start').val());
            $('#fri_end').val($('#def_end').val());
            $('#fri_start').selectmenu('refresh');
            $('#fri_end').selectmenu('refresh');
        //..Set satday Timing To Default
            $('#sat_start').val($('#def_start').val());
            $('#sat_end').val($('#def_end').val());
            $('#sat_start').selectmenu('refresh');
            $('#sat_end').selectmenu('refresh');
        //..Set sunday Timing To Default
            $('#sun_start').val($('#def_start').val());
            $('#sun_end').val($('#def_end').val());
            $('#sun_start').selectmenu('refresh');
            $('#sun_end').selectmenu('refresh');
     //}else{
     //    alert("Please Enter Proper Timing");
     //}
 }
 </script>
   {/literal}
    <table class="job_detail_panal_table" style="margin-left:-10px;paddding:0px;">
    <tr>
        <td  class="detail_right_td" VALIGN="MIDDLE" style="width:60px;">
            default:
        </td>
        <td class="detail_left_td">
            <select id="def_start" name="def_start" style="width:90px;">
            {php}
                echo getMeBusHours();
            {/php}
            </select>
        </td>
        <td class="detail_right_td" VALIGN="MIDDLE" style="width:10px;">-</td>
        <td class="detail_left_td" style="width:60px;">
            <select id="def_end" name="def_end" style="width:90px;">
            {php}
                echo getMeBusHours();
            {/php}
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <center>
                <input type="button" value="Apply To All" data-theme="a"data-icon="check" onclick="apply_def_wrk_hrs();" data-inline='true'/>
            <center>
        </td>
    </tr>
     <tr>
          <td  class="detail_right_td" VALIGN="MIDDLE" style="width:60px;">
             Monday:
          </td>

          <td class="detail_left_td" style="width:60px;">
            <select id="mon_start" name="mon_start">
            {php}
                $_mon_start=$_vs_current_listing["mon_start"];
                if ($_POST["mon_start"]){
                    $_mon_start=$_POST["mon_start"];
                }
                echo getMeBusHours($_mon_start);
            {/php}
            </select>
            </td>
            <td class="detail_right_td" VALIGN="MIDDLE" style="width:10px;">-</td>
            <td class="detail_left_td" style="width:60px;">

            <select id="mon_end" name="mon_end">
            {php}
                $_mon_end=$_vs_current_listing["mon_end"];
                if ($_POST["mon_end"]){
                    $_mon_end=$_POST["mon_end"];
                }
                echo getMeBusHours($_mon_end);
            {/php}
            </select>
          </td>
     </tr>
     <tr>
        <td colspan="4">
            <span style="display:none;" class="error_td" id="mon_hrs_error">
            Please, Add Proper Timing
            </span>
        </td>
     </tr>
       <tr>
          <td  class="detail_right_td" VALIGN="MIDDLE" style="width:60px;">
            Tuesday:
        </td>
          <td class="detail_left_td" style="width:60px;">
            <select id="tues_start" name="tues_start">
            {php}
                $_tues_start=$_vs_current_listing["tues_start"];
                if ($_POST["tues_start"]){
                    $_tues_start=$_POST["tues_start"];
                }
                echo getMeBusHours($_tues_start);
            {/php}
            </select>
            </td>
            <td class="detail_right_td" VALIGN="MIDDLE" style="width:10px;">-</td>
            <td class="detail_left_td" style="width:60px;">
            <select id="tues_end" name="tues_end">
            {php}
                $_tues_end=$_vs_current_listing["tues_end"];
                if ($_POST["tues_end"]){
                    $_tues_end=$_POST["tues_end"];
                }
                echo getMeBusHours($_tues_end);
            {/php}
            </select>
          </td>
     </tr>
      <tr>
        <td colspan="4">
            <span style="display:none;" class="error_td" id="tues_hrs_error">
            Please, Add Proper Timing
            </span>
        </td>
     </tr>
     <tr>
          <td  class="detail_right_td" VALIGN="MIDDLE" style="width:60px;">
            Wednesday:
          </td>
          <td class="detail_left_td" style="width:60px;">
            <select id="wed_start" name="wed_start">
            {php}
                $_wed_start=$_vs_current_listing["wed_start"];
                if ($_POST["wed_start"]){
                    $_wed_start=$_POST["wed_start"];
                }
                echo getMeBusHours($_wed_start);
            {/php}
            </select>
            </td>
            <td class="detail_right_td" VALIGN="MIDDLE" style="width:10px;">-</td>
            <td class="detail_left_td" style="width:60px;">
            <select id="wed_end" name="wed_end">
            {php}
                $_wed_end=$_vs_current_listing["wed_end"];
                if ($_POST["wed_end"]){
                    $_wed_end=$_POST["wed_end"];
                }
                echo getMeBusHours($_wed_end);
            {/php}
            </select>
          </td>
     </tr>
    <tr>
        <td colspan="4">
            <span style="display:none;" class="error_td" id="wed_hrs_error">
            Please, Add Proper Timing
            </span>
        </td>
     </tr>
     <tr>
          <td  class="detail_right_td" VALIGN="MIDDLE" style="width:60px;">
            Thursday:
          </td>
          <td class="detail_left_td" style="width:60px;">
            <select id="thurs_start" name="thurs_start">
            {php}
                $_thurs_start=$_vs_current_listing["thurs_start"];
                if ($_POST["thurs_start"]){
                    $_thurs_start=$_POST["thurs_start"];
                }
                echo getMeBusHours($_thurs_start);
            {/php}
            </select>
        </td>
        <td class="detail_right_td" VALIGN="MIDDLE" style="width:10px;">-</td>
        <td class="detail_left_td" style="width:60px;">
            <select id="thurs_end" name="thurs_end">
            {php}
                $_thurs_end=$_vs_current_listing["thurs_end"];
                if ($_POST["thurs_end"]){
                    $_thurs_end=$_POST["thurs_end"];
                }
                echo getMeBusHours($_thurs_end);
            {/php}
            </select>
          </td>
     </tr>
     <tr>
        <td colspan="4">
            <span style="display:none;" class="error_td" id="thurs_hrs_error">
            Please, Add Proper Timing
            </span>
        </td>
     </tr>
     <tr>
          <td  class="detail_right_td" VALIGN="MIDDLE" style="width:60px;">
            Friday:
          </td>
          <td class="detail_left_td" style="width:60px;">
            <select id="fri_start" name="fri_start">
            {php}
                $_fri_start=$_vs_current_listing["fri_start"];
                if ($_POST["fri_start"]){
                    $_fri_start=$_POST["fri_start"];
                }
                echo getMeBusHours($_fri_start);
            {/php}
            </select>
            </td>
            <td class="detail_right_td" VALIGN="MIDDLE" style="width:10px;">-</td>
            <td class="detail_left_td" style="width:60px;">
            <select id="fri_end" name="fri_end">
            {php}
                $_fri_end=$_vs_current_listing["fri_end"];
                if ($_POST["fri_end"]){
                    $_fri_end=$_POST["fri_end"];
                }
                echo getMeBusHours($_fri_end);
            {/php}
            </select>
          </td>
     </tr>
     <tr>
        <td colspan="4">
            <span style="display:none;" class="error_td" id="fri_hrs_error">
            Please, Add Proper Timing
            </span>
        </td>
     </tr>
     <tr>
          <td  class="detail_right_td" VALIGN="MIDDLE" style="width:60px;">
            Saturday:
          </td>
          <td class="detail_left_td" style="width:60px;">
            <select id="sat_start" name="sat_start">
            {php}
                $_sat_start=$_vs_current_listing["sat_start"];
                if ($_POST["sat_start"]){
                    $_sat_start=$_POST["sat_start"];
                }
                echo getMeBusHours($_sat_start);
            {/php}
            </select>
            </td>
            <td class="detail_right_td" VALIGN="MIDDLE" style="width:10px;">-</td>
            <td class="detail_left_td" style="width:60px;">
            <select id="sat_end" name="sat_end">
            {php}
                $_sat_end=$_vs_current_listing["sat_end"];
                if ($_POST["sat_end"]){
                    $_sat_end=$_POST["sat_end"];
                }
                echo getMeBusHours($_sat_end);
            {/php}
            </select>
          </td>
     </tr>
      <tr>
        <td colspan="4">
            <span style="display:none;" class="error_td" id="sat_hrs_error">
            Please, Add Proper Timing
            </span>
        </td>
     </tr>
     <tr>
          <td  class="detail_right_td" VALIGN="MIDDLE" style="width:60px;">
            Sunday:
          </td>
          <td class="detail_left_td" style="width:60px;">
            <select id="sun_start" name="sun_start">
            {php}
                $_sun_start=$_vs_current_listing["sun_start"];
                if ($_POST["sun_start"]){
                    $_sun_start=$_POST["sun_start"];
                }
                echo getMeBusHours($_sun_start);
            {/php}
            </select>
            </td>
            <td class="detail_right_td" VALIGN="MIDDLE" style="width:10px;">-</td>
            <td class="detail_left_td" style="width:60px;">
            <select id="sun_end" name="sun_end">
            {php}
                $_sun_end=$_vs_current_listing["sun_end"];
                if ($_POST["sun_end"]){
                    $_sun_end=$_POST["sun_end"];
                }
                echo getMeBusHours($_sun_end);
            {/php}
            </select>
          </td>
     </tr>
     <tr>
        <td colspan="4">
            <span style="display:none;" class="error_td" id="sun_hrs_error">
            Please, Add Proper Timing
            </span>
        </td>
     </tr>
 </table>
 	</div><!-- content -->
    {include file="$deftpl/edlist/footer.tpl"}
</div><!-- page -->
