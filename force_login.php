<?php /* Functions.php */
add_action('template_redirect', 'force_login');

function force_login() {
	$redirect_to = '/index.php';
	// Change this line to change to where logging in redirects the user, i.e. '/', '/wp-admin', etc.

	$general = array();
	$general[] = get_bloginfo('url');
	$general[] = get_bloginfo('url') . '/';
	$general[] = get_bloginfo('url') . '/index.php';

	if (!is_user_logged_in())
	// && !in_array(currentPageURL(), $general))
	// &&
	// (currentPageURL() != bloginfo('url') || currentPageURL() != (bloginfo('url') . 'index.php')))
	{
		if (is_feed())
		{
			$credentials = array();
			$credentials['user_login'] = $_SERVER['PHP_AUTH_USER'];
			$credentials['user_password'] = $_SERVER['PHP_AUTH_PW'];

			$user = wp_signon($credentials);

			if (is_wp_error($user))
			{
				header( 'WWW-Authenticate: Basic realm="' . $_SERVER['SERVER_NAME'] . '"' );
				header( 'HTTP/1.0 401 Unauthorized' );
				die();
			} // if
		} // if
		else
		{
		  header('Location: /wp-login.php?redirect_to=' . $redirect_to);
			die();
		} // else
	} // if
} // force_login
?>
