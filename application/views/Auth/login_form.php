<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - Login Form View
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2016, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

if( ! isset( $optional_login ) )
{
	//	echo '<h1>Login</h1>';
}

if( ! isset( $on_hold_message ) )
{
	if( isset( $login_error_mesg ) )
	{
                                    
		echo '
			<div class="alert alert-danger" role="alert">
				<p>
					Login Error #' . $this->authentication->login_errors_count . '/' . config_item('max_allowed_attempts') . ': Invalid Username, Email Address, or Password.
				</p>
				<p>
					Username, email address and password are all case sensitive.
				</p>
			</div>
		';
	}

	if( $this->input->get('logout') )
	{
		echo '
			<div class="alert alert-success" role="alert">
				<p>
					You have successfully logged out.
				</p>
			</div>
		';
	}

	echo form_open( $login_url, array( 'class' => 'm-t-md' ) ); 
	?>

    <div class="form-group">
        <input type="text" autocomplete="off" maxlength="255" name="login_string" id="login_string" class="form-control" placeholder=" <?php echo $this->lang->line('login_identity_label'); ?>" required>
    </div>
    
    <div class="form-group">
       <!--  <input type="password" name="login_pass" id="login_pass" class="form-control password" placeholder="Password" maxlength="<?php echo config_item('max_chars_for_password'); ?>" autocomplete="off" onfocus="this.removeAttribute('readonly');" required> -->

                <div class="input-group" id="show_hide_password">
           <input type="password" name="login_pass" id="login_pass" class="form-control password" placeholder="<?php echo $this->lang->line('login_identity_label_password'); ?>" maxlength="<?php echo config_item('max_chars_for_password'); ?>" autocomplete="off" onfocus="this.removeAttribute('readonly');" required>

          <div class="input-group-addon">
            <a href="javascript:void(0);" id="eyehidden" onclick="showpassword()"><i class="fa fa-eye" aria-hidden="true"></i></a>
          </div>
        </div>
    </div>
       <div class="form-group">
      <div class="col-md-12" align="right">
       
        <a href="<?php echo base_url();?>recovery" ><i class="fa fa-lock m-r-5"></i> <?php echo $this->lang->line('login_forgot_password'); ?></a> </div>
    </div>

    
		<?php
            if( config_item('allow_remember_me') )
            {
            ?>
                <br />
                <label for="remember_me" class="form_label">Remember Me</label>
                <input type="checkbox" id="remember_me" name="remember_me" value="yes" />
            <?php
            }
			
			$link_protocol = USE_SSL ? 'https' : NULL;
		?>
		 <br>
		<input class="btn btn-info btn-block" type="submit" name="submit" value="<?php echo $this->lang->line('login_button_name'); ?>" id="submit_button"  />
        <!--	
        <a  class="display-block text-center m-t-md text-sm" href="<?php echo site_url('Auth/recover', $link_protocol); ?>">
			Forgot Password?
        </a>
        -->
	</div>
</form>
<script type="text/javascript">
    function showpassword(){
      event.preventDefault();
      if($('#show_hide_password input').attr("type") == "text"){
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password #eyehidden').html('<i class="fa fa-eye" aria-hidden="true"></i>');
      }else if($('#show_hide_password input').attr("type") == "password"){
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password #eyehidden').html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
      }
    }
    </script>
	<?php
	}
	else
	{
		// EXCESSIVE LOGIN ATTEMPTS ERROR MESSAGE
		echo '
			<div class="alert alert-danger" role="alert">
				<p>
					Excessive Login Attempts
				</p>
				<p>
					You have exceeded the maximum number of failed login<br />
					attempts that this website will allow.
				<p>
				<p>
					Your access to login and account recovery has been blocked for ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes.
				</p>
				<p>
					Please use the <a href="/Auth/recover">Account Recovery</a> after ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes has passed,<br />
					or contact us if you require assistance gaining access to your account.
				</p>
			</div>
		';
	}

/* End of file login_form.php */
/* Location: /community_auth/views/Auth/login_form.php */ 
