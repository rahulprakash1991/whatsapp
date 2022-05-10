<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
	?>
<div id="main-wrapper">
<?php
                 if($notification)
                    {
                    ?>
                    <div class="alert alert-danger no-border successmessage">
                        <span class="text-semibold"> <?php echo $notification;?></span>
                    </div>
                    <?php
                }
                ?>
                <?php
                 if($notification1)
                    {
                    ?>
                    <div class="alert alert-success no-border successmessage">
                        <span class="text-semibold"> <?php echo $notification1;?></span>
                    </div>
                    <?php
                }
                ?>
<form class="form-horizontal"  action="<?php echo base_url();?>recovery" method="post">

    <div class="form-group <?PHP if(form_error('email')){ echo 'has-error';} ?>">
    
        <input type="text" autocomplete="off" maxlength="255" name="email" id="email" class="form-control" placeholder="Email" >
        <label class="error"><?php echo form_error('email'); ?></label>
    </div>
    
    <div class="form-group">
 
		<input class="btn btn-info btn-block" type="submit" name="submit" value="Submit" id="submit_button"  />
       
	</div>
	 <div class="form-group">
        	<a href="<?php echo base_url();?>login" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Back to Login</a>
        </div>
</form>
</div>

