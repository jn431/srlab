<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
	<div class="tile slim">
		<p class="center">Don’t have an account? <a href="<?= wp_registration_url(); ?>">Sign up</a></p>
	</div>
	<div id="customer_register" class="tile slim">
		<h2 class="title center"><?php esc_html_e('Sign Up', 'woocommerce'); ?></h2>
		<form method="post" class="acc-form form--1 register" <?php do_action('woocommerce_register_form_tag'); ?>>
			<?php do_action('woocommerce_register_form_start'); ?>
			<?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
				<div class="form-wrap">
					<label for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="input" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
				</div>
			<?php endif; ?>
			<div class="form-wrap">
				<label for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
				<input type="email" class="input" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" />
			</div>
			<?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
				<div class="form-wrap">
					<label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
					<input type="password" class="input" name="password" id="reg_password" autocomplete="new-password" />
				</div>
			<?php else : ?>
				<div><?php esc_html_e('A password will be sent to your email address.', 'woocommerce'); ?></div>
			<?php endif; ?>
			<?php do_action('woocommerce_register_form'); ?>
			<div class="form-wrap center">
				<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
				<button type="submit" class="b--hero center pri--btn" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
			</div>
			<?php do_action('woocommerce_register_form_end'); ?>
			<div class="hr form-row">OR</div>
			<div class="form-row">
				<div class="nsl-container nsl-container-block" data-align="center">
					<div class="nsl-container-buttons"><a href="http://localhost/dental/wp-login.php?loginSocial=google&amp;redirect=http%3A%2F%2Flocalhost%2Fdental%2Flogin%2F" rel="nofollow" aria-label="Continue with <b>Google</b>" data-plugin="nsl" data-action="connect" data-provider="google" data-popupwidth="600" data-popupheight="600">
							<div class="nsl-button nsl-button-default nsl-button-google" data-skin="light" style="background-color:#fff;">
								<div class="nsl-button-svg-container"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
										<path fill="#4285F4" d="M20.64 12.2045c0-.6381-.0573-1.2518-.1636-1.8409H12v3.4814h4.8436c-.2086 1.125-.8427 2.0782-1.7959 2.7164v2.2581h2.9087c1.7018-1.5668 2.6836-3.874 2.6836-6.615z"></path>
										<path fill="#34A853" d="M12 21c2.43 0 4.4673-.806 5.9564-2.1805l-2.9087-2.2581c-.8059.54-1.8368.859-3.0477.859-2.344 0-4.3282-1.5831-5.036-3.7104H3.9574v2.3318C5.4382 18.9832 8.4818 21 12 21z"></path>
										<path fill="#FBBC05" d="M6.964 13.71c-.18-.54-.2822-1.1168-.2822-1.71s.1023-1.17.2823-1.71V7.9582H3.9573A8.9965 8.9965 0 0 0 3 12c0 1.4523.3477 2.8268.9573 4.0418L6.964 13.71z"></path>
										<path fill="#EA4335" d="M12 6.5795c1.3214 0 2.5077.4541 3.4405 1.346l2.5813-2.5814C16.4632 3.8918 14.426 3 12 3 8.4818 3 5.4382 5.0168 3.9573 7.9582L6.964 10.29C7.6718 8.1627 9.6559 6.5795 12 6.5795z"></path>
									</svg></div>
								<div class="nsl-button-label-container">Sign Up with <b>Google</b></div>
							</div>
						</a></div>
				</div>
			</div>
		</form>
	</div>
<?php endif; ?>