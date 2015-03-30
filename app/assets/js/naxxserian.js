$(function(){
	$(".scroll-to-password-field").live("click", function(){
		$("#scroll-to-password-field").ScrollTo();
		$("#member_old_password").focus();
	});
});