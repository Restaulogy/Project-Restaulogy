/* Main Js Containing all custom code*/
$(function() {
    $( "#dob" ).datepicker(); 
    $( "#license_expiry" ).datepicker();
 });


function change_user_type(){
	if (document.getElementById('member_role_id').value == 3){
        //...patient
		$('.doctor_row').hide();
		$('.patient_row').show();
		$('.provider_row').hide();
		$('.staff_row').hide();
		$('#parent').attr('value', '');
		$('#min_value').attr('value', '0');
    }else if(document.getElementById('member_role_id').value == 2){
        //...provider admin
		$('.doctor_row').show();
		$('.patient_row').hide();
		$('.provider_row').show();
        $('.staff_row').show();
		$('#min_value').attr('value', '1');
	}else{
        //...all remaining access
		$('.doctor_row').hide();
		$('.patient_row').hide();
        $('.provider_row').hide();
		$('.staff_row').show();
		$('#parent').attr('value', '0');
		$('#min_value').attr('value', '');
	}
}  
 
