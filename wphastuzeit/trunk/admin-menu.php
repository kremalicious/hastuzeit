	<div id="front-admin">
		<?php 
			global $user_identity, $user_ID, $user_email, $user_login, $current_user;
			get_currentuserinfo();
			
			if ( !is_user_logged_in() ) { ?>
			
			<a id="login-link" class="loggedout" href="<?php echo get_option('home'); ?>/wp-login.php">v Login</a>
				
				<form action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
				
				    <p><label for="log">Benutzername</label><input type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20" /> </p>
				
				    <p><label for="pwd">Passwort</label><input type="password" name="pwd" id="pwd" size="20" /></p>
					<p>
						<input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" />
				       	<label for="rememberme">Erinnere dich an mich</label>
				       	<input type="submit" name="submit" class="submit" value="Login" />
				    </p>
				
				    <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
					<p><a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword">Passwort vergessen?</a></p>
				</form>
			
		<?php } else { ?>
		
		<a id="login-link" class="loggedin" href="#">v Admin Men&uuml;</a>
		
		<ul id="admin-box">
            <li id="hello">
            	<?php 
			 		echo get_avatar( $user_email, $size = '20' );
				 ?>
				<?php
					$greetings = array(
				    'Hallo',
				    'Hello',
				    'Schalom',
				    'Bonjour',
				    'Ciao',
				    'Salaam',
				    'Hala',
				    'Ni hao',
				    'Szia',
				    'Ahoy',
				    'Hi',
				    'Mingalaba',
				    'Merhaba',
				    );
					$number = count($greetings)-1;
					$randNumber = rand(0, $number);
					echo $greetings[$randNumber];
				?>
            	<strong><?php echo $current_user->user_firstname; ?></strong>
            </li>

            <li id="hello-dave">Just what do you think you're doing?</li>
            
            <!-- For all logged in users -->
            <li class="dashboard"><a href="<?php echo get_option('home'); ?>/wp-admin/">Dashboard</a></li>
            <li class="profile"><a href="<?php echo get_option('home'); ?>/wp-admin/profile.php">Dein Profil</a></li>
            
            <!-- Just for Contributors and above -->
            <?php if ( current_user_can('level_1') ) : ?>
            	
            	<li class="new-post"><a href="<?php echo get_option('home'); ?>/wp-admin/post-new.php">Neuer Artikel</a></li>
            	<li class="articles"><a href="<?php echo get_option('home'); ?>/wp-admin/edit.php?author=<?php echo $current_user->ID; ?>">Deine Artikel</a></li>
            	             
            <?php endif ?>
            
            <!-- Just for Editors and above -->
            <?php if ( current_user_can('level_5') ) : ?>
            
            	<li class="articles"><a href="<?php echo get_option('home'); ?>/wp-admin/edit.php">Artikel &Uuml;bersicht</a></li>
            
            <?php endif ?>
            
            <!-- Just for Admins -->
            <?php if (current_user_can('level_10')) : ?>
            
            	<li class="sidebar-widgets"><a href="<?php echo get_option('home'); ?>/wp-admin/widgets.php">Sidebar Widgets</a></li>
            	<li class="new-user"><a href="<?php echo get_option('home'); ?>/wp-admin/user-new.php">Neuer Benutzer</a></li>
            
            <?php endif	?>
            
            <li class="logout"><a href="<?php echo wp_logout_url( $_SERVER['REQUEST_URI'] ); ?>">Logout</a></li>
        </ul>
	
	<?php }	?>
	
	</div>