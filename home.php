<?php
// including necessary files
require_once 'config/config.php';
if (!isset($_SESSION['id'])) {
	// Redirection to login page twitter or facebook
	header("location: index.php");
}
?>
<html>
<head>
<link rel="stylesheet" href="css/styles.css" />
</head>
<body>

<?php
if ($_SESSION['oauth_provider'] == 'twitter') {
	echo "
	<div>
		<a href='http://twitter.com/{$_SESSION['screen_name']}' target='_blank' title='Click to go to Twitter account'>
			{$_SESSION['name']} Logged in <img src='images/twitter.png'>
		</a>
	</div>
	<table>
		<thead>
			<tr>
				<th>User Details</th>
			</tr>
			<tr>
				<th><img src='{$_SESSION['profile_image_url']}'>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Logged in as: <b>{$_SESSION['name']}&nbsp;</b>
				</td>
			</tr>
			<tr>
				<td>@{$_SESSION['screen_name']}&nbsp;</td>
			</tr>";
	if (!empty($_SESSION['url']))
	echo "<tr>
			<td>{$_SESSION['description']}&nbsp;</td>
		  </tr>";

	echo "<tr>
			<td>{$_SESSION['location']}&nbsp;</td>
		  </tr>";
	if (!empty($_SESSION['url']))
	echo "<tr>
				<td><a href='{$_SESSION['url']}'>{$_SESSION['url']}</a>
				</td>
			</tr>";
	echo "<tfoot>
			<tr>
				<td><a href='logout.php' title='Click to logout'>Logout from <img src='images/twitter.png'></a>
				</td>
			</tr>
		</tfoot>
		</tbody>
	</table>
	";
	
	echo "
		<table>
		  <thead>
			<tr>
				<th colspan='2'>Contact Details</th>
			</tr>
		  </thead>
		  
		  <tr>
		  	<td><b>Name</b></td><td>{$_SESSION['name']}&nbsp;</td>
		  </tr>
		  <tr>
			<td><b>Screen  name</b></td><td>{$_SESSION['screen_name']}&nbsp;</td>
		  </tr>
		  <tr>
			<td><b>Location</b></td><td>{$_SESSION['location']}&nbsp;</td>
		  </tr>
		  <tr>
			<td><b>Time zone</b></td><td>{$_SESSION['time_zone']}&nbsp;</td>
		  </tr>
		  <tr>
			<td><b>UTC offset</b></td><td>{$_SESSION['utc_offset']}&nbsp;</td>
		  </tr>
		  <tr>
			<td><b>Language</b></td><td>{$_SESSION['lang']}&nbsp;</td>
		  </tr>";
	echo '</table>';
} elseif ($_SESSION['oauth_provider'] == 'facebook') {
	echo "
		<div>
			<a href='http://www.facebook.com/{$_SESSION['username']}' target='_blank' title='Click to go to Facebook account'>
				{$_SESSION['name']} Logged in <img src='images/facebook.png'>
			</a>
		</div>
		
		<table>
		<thead>
			<tr>
				<th>User Details</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Logged in as: <b>{$_SESSION['name']}&nbsp;</b></td>
			</tr>
			<tr>
				<td>{$_SESSION['username']}&nbsp;</td>
			</tr>
			<tr>
				<td>{$_SESSION['link']}&nbsp;</td>
			</tr>
			<tr>
				<td>{$_SESSION['hometown']['name']}&nbsp;</td>
			</tr>
			<tr>
				<td>{$_SESSION['location']['name']}&nbsp;</td>
			</tr>
			<tr>
				<td>{$_SESSION['bio']}&nbsp;</td>
			</tr>
			<tr>
				<td>{$_SESSION['gender']}&nbsp;</td>
			</tr>
			<tr>
				<td>{$_SESSION['languages']}&nbsp;</td>
			</tr>
		<tfoot>
			<tr>
				<td><a href='logout.php' title='Click to logout'>Logout from <img src='images/facebook.png'>
				</a></td>
			</tr>
		</tfoot>
		</tbody>
	</table>
	";
	echo '<table>';
	echo "
		<thead>
			<tr>
		  		<th colspan='2'>Contact Details</th>
		  	</tr>
		</thead>
		  <tr>
		  	<td><b>Name</b></td><td>{$_SESSION['name']}&nbsp;</td>
		  </tr>
		  <tr>
			<td><b>Link</b></td><td>{$_SESSION['link']}&nbsp;</td>
		  </tr>
		  <tr>
			<td><b>Username</b></td><td>{$_SESSION['username']}&nbsp;</td>
		  </tr>
		  <tr>
			<td><b>Hometown</b></td><td>{$_SESSION['hometown']['name']}&nbsp;</td>
		  </tr>
		  <tr>
			<td><b>Location</b></td><td>{$_SESSION['location']['name']}&nbsp;</td>
		  </tr>
		  <tr>
			<td><b>Bio</b></td><td>{$_SESSION['bio']}&nbsp;</td>
		  </tr>
		  <tr>
			<td><b>Gender</b></td><td>{$_SESSION['gender']}&nbsp;</td>
		  </tr>
		  <tr>
			<td><b>Timezone</b></td><td>{$_SESSION['timezone']}&nbsp;</td>
		  <tr>
			<td><b>Languages</b></td><td>{$_SESSION['languages']}&nbsp;</td>
		  </tr>
		  ";
	echo '</table>';
} elseif ($_SESSION['oauth_provider'] == 'personal') {
	require_once 'personal/personal.php';
	$gems = $_SESSION['gems'];
	
	echo "
	<div>
		<a href='http://personal.com/' target='_blank' title='Click to go to Personal account'>
			Personal.com
		</a><br />
		<a href='logout.php' title='Click to logout'>Logout from Personal.com</a>
	</div>";
	
	if (!empty($gems)) {
		echo "
		<table style='width:90%'>
		  <thead>
			<tr>
				<th colspan='2'>Personal Contact info Gem Details</th>
			</tr>
		  </thead>";
		$count = 0;
		foreach ($gems as $gem) {
			$count  += 1;
			$details = getGemDetail($gem->gem_instance_id);
			echo "
		  <thead>
			<tr>
				<th colspan='2'>Gem {$count}</th>
			</tr>
		  </thead>
		  		
		  <tr>
		  	<td><b>Name</b></td><td>{$details['contact_info_name']}&nbsp;</td>
		  </tr>
		  <tr>
		  	<td><b>Email</b></td><td>{$details['personal_email']}&nbsp;</td>
		  </tr>
		  <tr>
		  	<td><b>Secondary email</b></td><td>{$details['personal_secondary_email']}&nbsp;</td>
		  </tr>
		  <tr>
		  	<td><b>Home mobile phone</b></td><td>{$details['home_mobile_phone']}&nbsp;</td>
		  </tr>
		  <tr>
		  	<td><b>Home phone</b></td><td>{$details['home_phone']}&nbsp;</td>
		  </tr>
		  <tr>
		  	<td><b>Contact info fax</b></td><td>{$details['contact_info_fax']}&nbsp;</td>
		  </tr>
		  <tr>
		  	<td><b>Personal website</b></td><td>{$details['personal_website']}&nbsp;</td>
		  </tr>
		  <tr>
		  	<td><b>Facebook profile</b></td><td>{$details['facebook_profile']}&nbsp;</td>
		  </tr>
		  <tr>
		  	<td><b>Twitter name</b></td><td>{$details['twitter_name']}&nbsp;</td>
		  </tr>";
		}
		echo '</table>';
	} else {
		echo "<table style='width:90%'>
		  <thead>
			<tr>
				<th colspan='2'>No Gems found</th>
			</tr>
		  </thead>
		  </table>
		  ";
	}
}
?>
</body>
</html>
