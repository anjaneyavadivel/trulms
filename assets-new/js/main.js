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
$('.submit-form-btn').click(function(){
	$('#new_button').trigger('click');
});
function form_submit(val){
	document.getElementById(val).submit();
}
$('#add_form').click(function(){
$.validator.addMethod("loginRegex", function(value, element) 
{
   return this.optional(element) || /^[\w\d\s-]+$/i.test(value);
   //return this.optional(element) || /^[a-z0-9\\-]+$/i.test(value); -----for login script
}, "Department must contain only letters, numbers, or dashes.");	
 $("#add_depatment").validate({
			rules: {
				department: {
					required: true,
					maxlength: 49,
					loginRegex:true,
					remote:{
					 type:"post",
					 url:base_path+"department_vaildation",
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
});
