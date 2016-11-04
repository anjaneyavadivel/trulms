
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
		
	$('#form_sub_enable').html('<a href="'+url+'" class="btn btn-default btn-border activedeactiveconf-btn">Ok</a><button class="btn btn-default btn-border activedeactiveconf-close" data-dismiss="modal">Cancel</button>');
	}
	else
	{
		$('#form_sub_enable').html('<a href="'+url+'/'+type+'" class="btn btn-default btn-border activedeactiveconf-btn">Ok</a><button class="btn btn-default btn-border activedeactiveconf-close" data-dismiss="modal">Cancel</button>');
	}
}