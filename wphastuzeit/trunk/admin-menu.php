	<div id="front-admin">
		<?php 
			global $user_identity, $user_ID, $user_email, $user_login;
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
				 	echo get_avatar( $user_email, $size = '20' ); ?>
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
				
            	<strong><?php echo $user_login ?></strong>
            
            </li>
            <li><a class="dashboard" href="<?php echo get_option('home'); ?>/wp-admin/">Admin Dashboard</a></li>
            <li><a class="profile" href="<?php echo get_option('home'); ?>/wp-admin/profile.php">Dein Profil</a></li>
            <?php if ( current_user_can('level_2') ) : ?>
            	
            	<li><a class="new-post" href="<?php echo get_option('home'); ?>/wp-admin/post-new.php">Neuer Artikel</a></li>
            	
            	<?php if ( current_user_can('level_3') ) : ?>
            		<li><a class="new-page" href="<?php echo get_option('home'); ?>/wp-admin/page-new.php">Neue Seite</a></li>
            	 <?php endif ?>
            	 
            	<li><a class="new-file" href="<?php echo get_option('home'); ?>/wp-admin/media-new.php">Dateien hochladen</a></li>
            	<li><a class="sidebar-widgets" href="<?php echo get_option('home'); ?>/wp-admin/widgets.php">Sidebar Widgets</a></li>
            
            <?php endif ?>
            
            <?php if (current_user_can('level_10')) : ?>
            	
            	<li><a class="new-user" href="<?php echo get_option('home'); ?>/wp-admin/user-new.php">Neuer Benutzer</a></li>
            
            <?php endif	?>
            
            <li><a class="logout" href="<?php echo wp_logout_url( get_permalink() ); ?>">Logout</a></li>
        </ul>
	
	<?php }	?>
	
	</div>