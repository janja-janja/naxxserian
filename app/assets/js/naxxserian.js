$(function(){
	/*password_field scroll_to()*/
	$(".scroll-to-password-field").live("click", function(){
		$("#scroll-to-password-field").ScrollTo();
		$("#member_old_password").focus();
	});/*end password_field scroll_to()*/

	
	/*guarantor_details selector*/
	$("#guarantorDetails").change(function(){
		var guarantor_id = $(this).val();
		alert(guarantor_id);
	});/*end guaranto_deatils() selector*/

	
});