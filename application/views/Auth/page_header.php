<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Community Auth</title>
	<style>
		body{background:#fee;}
		#menu{float:left;width:100%;background:pink;}
		@media only screen and ( min-width:801px ){
			#menu{float:right;width:25%;}
		}
	</style>

	<?php

		// Add any javascripts
		if( isset( $javascripts ) )
		{
			foreach( $javascripts as $js )
			{
			
				echo '<script src="' . $js . '"></script>' . "\n";

			}
		}
		if( isset( $final_head ) )
		{
			echo $final_head;
		}
	?>
</head>
<body>
<div id="menu">
	<ul>
		<li><?php
			$link_protocol = USE_SSL ? 'https' : NULL;

			if( isset( $auth_user_id ) ){
				echo anchor( site_url('Auth/logout', $link_protocol ),'Logout');
			}else{
				echo anchor( site_url(LOGIN_PAGE . '?redirect=examples', $link_protocol ),'Login','id="login-link"');
			}
		?></li>
	
	</ul>
</div>
