var base_path = $('#header').attr('class');
//alert(base_path);
function active_deactive_class(url,type) 
{
	//alert(type);
	if(type==0)
	{
		$('#confirmation-msg1').html('Are you sure you would like to De-Active this record?');
	}
	else if(type==2)
	{
		$('#confirmation-msg1').html('Are you sure you would like to Approve this record?');
	}
	else if(type==3)
	{
		$('#confirmation-msg1').html('Are you sure you would like to Back From this page?');
	}
	else
	{
		$('#confirmation-msg1').html('Are you sure you would like to Active this record?');
	}
	if(type==3)
	{
		
	$('#form_sub_enable').html('<a href="'+url+'" class="btn btn-default btn-border activedeactiveconf-btn">Yes</a><button class="btn btn-default btn-border activedeactiveconf-close" data-dismiss="modal">No</button>');
	}
	else
	{
		$('#form_sub_enable').html('<a href="'+url+'/'+type+'" class="btn btn-default btn-border activedeactiveconf-btn">Yes</a><button class="btn btn-default btn-border activedeactiveconf-close" data-dismiss="modal">No</button>');
	}
}
function form_action_msg(type)
{
	if(type==1)
	{
		$('#confirmation-msg2').html('Are you sure you would like to Update this record?');
	}
}
$('.submit-form-btn').click(function(){
	$('#new_button').trigger('click');
});
function form_submit(val){
	//alert(val);
	document.getElementById(val).submit();
}
$('#add_form').click(function(){
$.validator.addMethod("loginRegex", function(value, element) 
{
   return this.optional(element) || /^[\w\d\s-]+$/i.test(value);
   //return this.optional(element) || /^[a-z0-9\\-]+$/i.test(value); -----for login script
}, "Name must contain only letters, numbers, or dashes.");
var vaildation	=	'_vaildation';	
 $("#add_depatment").validate({
			rules: {
				department: {
					required: true,
					maxlength: 49,
					loginRegex:true,
					remote:{
					 type:"post",
					 url:base_path+"department"+vaildation,
				 },
				},
			},
			messages:{
				department:{
					required:"This field is required",
					remote:"Already Exists this one..!",
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
	 $("#edit_depatment").validate({
			rules: {
				department: {
					required: true,
					maxlength: 49,
					loginRegex:true,
					remote:{
					 type:"post",
					 url:base_path+"edit_department"+vaildation,
					 data: { 'deptID': $('#deptID').val() },
				 },
				},
			},
			messages:{
				department:{
					required:"This field is required",
					remote:"Already Exists this one..!",
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
		
		/*Designation*/
		
		$("#add_designation").validate({
			rules: {
				name: {
					required: true,
					maxlength: 99,
					loginRegex:true,
					remote:{
					 type:"post",
					 url:base_path+"designation"+vaildation,
				 },
				},
			},
			messages:{
				name:{
					required:"This field is required",
					remote:"Already Exists this one..!",
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
	 $("#edit_designation").validate({
			rules: {
				name: {
					required: true,
					maxlength: 49,
					loginRegex:true,
					remote:{
					 type:"post",
					 url:base_path+"edit_designation"+vaildation,
					 data: { 'desigID': $('#desigID').val() },
				 },
				},
			},
			messages:{
				name:{
					required:"This field is required",
					remote:"Already Exists this one..!",
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
		/*Role*/
		
		$("#add_role").validate({
			rules: {
				roleName: {
					required: true,
					maxlength: 49,
					loginRegex:true,
					remote:{
					 type:"post",
					 url:base_path+"role"+vaildation,
				 },
				},
			},
			messages:{
				roleName:{
					required:"This field is required",
					remote:"Already Exists this one..!",
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
	 $("#edit_role").validate({
			rules: {
				roleName: {
					required: true,
					maxlength: 49,
					loginRegex:true,
					remote:{
					 type:"post",
					 url:base_path+"edit_role"+vaildation,
					 data: { 'desigID': $('#desigID').val() },
				 },
				},
			},
			messages:{
				roleName:{
					required:"This field is required",
					remote:"Already Exists this one..!",
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
		/*Payment Mode*/
		
		$("#add_payment_mode").validate({
			rules: {
				paymentMode: {
					required: true,
					maxlength: 49,
					loginRegex:true,
					remote:{
					 type:"post",
					 url:base_path+"payment_mode"+vaildation,
				 },
				},
			},
			messages:{
				paymentMode:{
					required:"This field is required",
					remote:"Already Exists this one..!",
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
	 $("#edit_payment_mode").validate({
			rules: {
				paymentMode: {
					required: true,
					maxlength: 49,
					loginRegex:true,
					remote:{
					 type:"post",
					 url:base_path+"edit_payment_mode_vaildation",
					 data: { 'paymentModeID': $('#paymentModeID').val() },
				 },
				},
			},
			messages:{
				paymentMode:{
					required:"This field is required",
					remote:"Already Exists this one..!",
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
		/*Payment status*/
		
		$("#add_payment_status").validate({
			rules: {
				payStatus: {
					required: true,
					maxlength: 49,
					loginRegex:true,
					remote:{
					 type:"post",
					 url:base_path+"payment_status"+vaildation,
				 },
				},
			},
			messages:{
				payStatus:{
					required:"This field is required",
					remote:"Already Exists this one..!",
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
	 $("#edit_payment_status").validate({
			rules: {
				payStatus: {
					required: true,
					maxlength: 49,
					loginRegex:true,
					remote:{
					 type:"post",
					 url:base_path+"edit_payment_status"+vaildation,
					 data: { 'payStatusID': $('#payStatusID').val() },
				 },
				},
			},
			messages:{
				payStatus:{
					required:"This field is required",
					remote:"Already Exists this one..!",
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
		/*Employee Types*/
		
		$("#add_employee_types").validate({
			rules: {
				typename: {
					required: true,
					maxlength: 49,
					loginRegex:true,
					remote:{
					 type:"post",
					 url:base_path+"employee_types"+vaildation,
				 },
				},
			},
			messages:{
				typename:{
					required:"This field is required",
					remote:"Already Exists this one..!",
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
	 $("#edit_employee_types").validate({
			rules: {
				typename: {
					required: true,
					maxlength: 49,
					loginRegex:true,
					remote:{
					 type:"post",
					 url:base_path+"edit_employee_types"+vaildation,
					 data: { 'employetypeID': $('#employetypeID').val() },
				 },
				},
			},
			messages:{
				typename:{
					required:"This field is required",
					remote:"Already Exists this one..!",
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
		$("#add_employee").validate({
			rules: {
				empname: {
					required: true,
					maxlength: 29,
					loginRegex:true,
				},
				sex:{
					required: true,
				},
				fathername:{
					required: true,
					maxlength: 29,
					loginRegex:true,
				},
				deptid:{
					required: true,
				},
				designation:{
					required: true,
				},
				employeetype:{
					required: true,
				},
				mobile:{
					required: true,
					maxlength: 13,
				},
				city:{
					required: true,
					maxlength: 50,
				},
				state:{
					required: true,
					maxlength: 50,
				},
				country:{
					required: true,
					maxlength: 50,
				},
				joiningdate:{
					required: true,
				},
				reportingto:{
					required: true,
				},
				photo:{
					required: true,
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
		$("#edit_employee").validate({
			rules: {
				empname: {
					required: true,
					maxlength: 29,
					loginRegex:true,
				},
				sex:{
					required: true,
				},
				fathername:{
					required: true,
					maxlength: 29,
					loginRegex:true,
				},
				deptid:{
					required: true,
				},
				designation:{
					required: true,
				},
				employeetype:{
					required: true,
				},
				mobile:{
					required: true,
					maxlength: 13,
				},
				city:{
					required: true,
					maxlength: 50,
				},
				state:{
					required: true,
					maxlength: 50,
				},
				country:{
					required: true,
					maxlength: 50,
				},
				joiningdate:{
					required: true,
				},
				reportingto:{
					required: true,
				},
				
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
		$("#add_driver").validate({
			rules: {
				dlno: {
					required: true,
					maxlength: 49,
					loginRegex:true,
				},
				sex:{
					required: true,
				},
				/*contact details*/
				name:{
					required: true,
					maxlength: 49,
					loginRegex:true,
				},
				companyName:{
					required: true,
					maxlength: 49,
					loginRegex:true,
				},
				addressline1:{
					required: true,
					maxlength: 99,
					loginRegex:true,
				},
				city:{
					required: true,
					maxlength: 50,
				},
				state:{
					required: true,
					maxlength: 50,
				},
				country:{
					required: true,
					maxlength: 50,
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
		$("#add_vehicleowner").validate({
			rules: {
				/*contact details*/
				name:{
					required: true,
					maxlength: 49,
					loginRegex:true,
				},
				companyName:{
					required: true,
					maxlength: 49,
					loginRegex:true,
				},
				addressline1:{
					required: true,
					maxlength: 99,
					loginRegex:true,
				},
				city:{
					required: true,
					maxlength: 50,
				},
				state:{
					required: true,
					maxlength: 50,
				},
				country:{
					required: true,
					maxlength: 50,
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
		$("#add_vehicle").validate({
			rules: {
				/*contact details*/
				name:{
					required: true,
					maxlength: 49,
					loginRegex:true,
				},
				companyName:{
					required: true,
					maxlength: 49,
					loginRegex:true,
				},
				addressline1:{
					required: true,
					maxlength: 99,
					loginRegex:true,
				},
				city:{
					required: true,
					maxlength: 50,
				},
				state:{
					required: true,
					maxlength: 50,
				},
				country:{
					required: true,
					maxlength: 50,
				},
				vehno:{
					required: true,
					maxlength: 50,
				},
				vehmake:{
					required: true,
					maxlength: 50,
				},
				roadpermitno:{
					required: true,
					maxlength: 50,
				},
				validity:{
					required: true,
				},
				insurancepolicydtls:{
					required: true,
					
				},
			},
			 submitHandler: function (form) {
				$('#form_submiting').trigger('click');
				 return false;
			 }
		});
});
