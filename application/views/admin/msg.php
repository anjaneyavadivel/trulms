 <?php if($this->session->userdata('suc')) { $this->session->unset_userdata('err');?>
<div class="alert alert-success alert-dismissible" role="alert" id="msg">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<strong><span class="glyphicon glyphicon-ok"></span></strong><?php echo $this->session->userdata('suc');  echo $this->session->unset_userdata('suc'); ?>
</div>
<?php }  if($this->session->userdata('err')) { $this->session->unset_userdata('suc');?>
<div class="alert alert-danger alert-dismissible" role="alert" <?php if(isset($login)){?> style="width:420px" <?php }?>>
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<strong><span class="glyphicon glyphicon-remove"></span></strong> <?php echo $this->session->userdata('err'); echo $this->session->unset_userdata('err'); ?>
</div>
<?php }  ?>


