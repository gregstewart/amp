<?php
	error_reporting(0);
	/*
	// default test variables
	$_POST['r_database'] = 'databaseName';
	$_POST['r_username'] = 'databaseUsername';
	$_POST['r_password'] = 'databasePassword';
	$_POST['r_host'] = 'localhost';
	$_POST['r_url'] = 'http://www.url.com/tcias_admin/';
	$_POST['r_path'] = 'C:\\Path\\To\\Web\\site\\tcias_admin';
	$_POST['r_site_name'] = '&amp;amp; &gt;&gt; admin';
	*/
	// settings
	$defaultErr = "<p>Please contact us (<a href=\"mailto: info@teacupinastorm.com\" title=\"Send us an error report\">info@teacupinastorm.com</a>).</p>";
	// write the config file function
	function writeConfigFile($u,$p,$s,$d,$h,$us,$pa) {
		$pathToConfigInfo = "../global/_config_info.php";
		// try to trap write permissions here for windows
		
		if(file_exists($pathToConfigInfo)) {
			$fr = fopen($pathToConfigInfo, 'w');
			/* Must be 0444 (octal), NOT just 444 */
			if(!chmod($pathToConfigInfo, 0444)) {
				echo ("Error -- couldn't open myfile.txt for reading!");
				exit;
			} else {
				$c="<?php
	// check if array exists
	if(!isset(\$config)) {
		global \$config;
		\$config = array();
	}
	
	// populate the array with config settings
	\$config['siteID'] = 'f926b87567d4affc6618d83f73c2cc87';
	\$config['url'] = '".$u."';
	\$config['path'] = '".$p."';
	\$config['siteName'] = '".$s."';
	\$config['dBName'] = '".$d."';
	\$config['dBHost'] = '".$h."';
	\$config['dBUsername'] = '".$us."';
	\$config['dBPassword'] = '".$pa."';
?>";
				fwrite($fr, $c);
			}
			$myvalue = fgets($fr, 1024);
			fclose($fr);
			chmod($pathToConfigInfo, 0444);
			return;
		} else {
			echo("<p>Couldn't find the file. Check your path.<br />Path to file: ".$pathToConfigInfo."</p>".$defaultErr);
			exit;	
		}
	}
	
	if (isset($_POST['r_url']) && $_POST['r_url'] != "") {
		$progressMessage = "<p>Processing:</p><ul>";
		// execute the write function
		writeConfigFile($_POST['r_url'], $_POST['r_path'], $_POST['r_site_title'], $_POST['r_database_name'], $_POST['r_host_name'], $_POST['r_user_name'], $_POST['r_password']);
		$progressMessage .= "<li>Config settings captured.</li>";
		// ok now include the created config file
		include("../global/_config_info.php");
		// include the db connect file
		include("../global/db_stuff.php");
		//test connection
		$conn = db_connect();
		if ($conn) {
			$progressMessage .= "<li>Database connection verified.</li>";
		} else {
			echo("<p>Sorry database connection failed. The reasons for this could be as follows:</p>
				<ul>
					<li>The user credentials you have supplied are incorrect</li>
					<li>The database name was not correct</li>
					<li>The database has not been created yet.</li>
				</ul>
			<p>Please verify these before progresing.</p>".$defaultErr);
			exit;	
		}
		$progressMessage .= "</ul><p>Configuration done. For security reasons, please don't forget to delete this directory and to reset the permissions on the _config_info.php file <strong>TO</strong> read-only again.</p>";	
	}
?>
<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CMS set up</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../global/css/gregs_tcias.css">
<script language="JavaScript1.2" type="text/javascript" src="../global/js/c_validation.js"></script>
<style>
#form {
	width: 500px; 
	padding: 5px; 
	margin: 0px auto;
	font-family: verdana;
	font-size: 0.8em;
	float : left;
}
div.row {
  clear : both;
  padding-top : 10px;
}
div.row span.label {
  float : left;
  width : 160px;
  text-align : right;
}

div.row span.formw {
  float : right;
  width : 310px;
  text-align : left;
} 

legend {
}

fieldset {
	margin : 0;
	padding : 5px;
}
/*input {
	border: 1px solid #000;
	font-family: verdana;
	font-size: 0.8em;
}
textarea {
	border: 1px solid #000;
	font-family: verdana;
	font-size: 0.8em;
}
select {
	border: 1px solid #000;
	font-family: verdana;
	font-size: 0.8em;
}*/
</style>
</head>

<body>
<?php include("../global/_header.php"); ?>
<?php 
	if ($_POST['r_user_name']) {
		if ($errMessage != "") {
?>
<div class="alert"><p><?php echo($errMessage); ?></p></div>
<?php
		} else if ($progressMessage != "") {
?>
<div id="intro"><?php echo($progressMessage); ?></div>
<?php
		}
	} else {
		if (!$_GET['step']) {
			$_GET['step']=1;
		}
		
		switch($_GET['step']) {
			case "1":
?>
<div id="intro">
	<p>Before submitting continuing the set up process, please verify that you have gathered the following infromation and completed the following steps.</p>
	<ol>
		<li>That you have MySQL configured and created a database that will hold the CMS tables.</li>
		<li>Created an appropriate user account with access privileges. The appliication requires permissions to SELECT, UPDATE, DELETE and INSERT.</li>
		<li>Imported the dbStruct.sql file (found in this setup folder) into the database you had previously created (for a brief instructions on how to do so, please consult your documentation [Install Guide], for a more detailed overview you'll need to consult the MySQL documentation).</li>
		<li>Make sure that the _config_info.php file in /global/ is <strong>NOT</strong> read-only.</li>
	</ol>
	<p><a href="?step=2" title="Ok on to the next step">Next</a>.</p>
</div>
<?php
				break;
			
			case "2":
?>
<div id="intro">
	<p>Ok if you have completed the previous step, complete the form below providing all the requested information so that the &amp;amp; can log into the database and do it's stuff.</p>
	<p>If not go <a href="?step=1" title="Ok on to the next step">back here</a> and make the complete the steps outlined previoulsy.</p>
</div>
<div id="form">
	<form method="post" action="index.php" name="frm_setup" id="frm_setup" enctype="application/x-www-form-urlencoded" onsubmit="return verify(this);">
		<fieldset>
		<legend>Site info</legend>
		<div class="row" align="center">
	  		<span class="alert" id="elField1"></span>
		</div>
		<div class="row">
		  	<label for="r_title">
				<span class="label">Site title:</span>
				<span class="formw"><input type="text" size="20" name="r_site_title" id="r_site_title" title="text input: for the display name, e.g. amp" value="<?php if (isset($_POST['r_site_title'])) { echo($_POST['r_site_title']); } ?>" tabindex="1" /></span>
		  	</label>
		</div>
		<div class="row" align="center">
	  		<span class="alert" id="elField2"></span>
		</div>
		<div class="row">
			<label for="r_url">
			  	<span class="label">Site URL:</span>
			  	<span class="formw"><input type="text" size="35" name="r_url" id="r_url" title="text input: for the full url of the CMS" value="<?php if (isset($_POST['r_url'])) { echo($_POST['r_url']); } ?>" tabindex="2" /></span>
		  	</label>
		</div>
		<div class="row" align="center">
	  		<span class="alert" id="elField3"></span>
		</div>
		<div class="row">
		  	<label for="r_path">
				<span class="label">Path:</span>
				<span class="formw"><input type="text" size="35" name="r_path" id="r_path" title="text input: for the physical path to your site" value="<?php if (isset($_REQUEST['r_path'])) { echo($_REQUEST['r_path']); } ?>" tabindex="3" /><br />Please note: <em>use "/" instead of "\" for the path info</em></span>
				
		  	</label>
		</div>
 		</fieldset>
		<fieldset>
		<legend>Database info</legend>
		<div class="row" align="center">
	  		<span class="alert" id="elField5"></span>
		</div>
		<div class="row">
		  	<label for="r_database_name">
				<span class="label">Database name:</span>
				<span class="formw"><input type="text" size="25" name="r_database_name" id="r_database_name" title="text input: for the name of your database" value="<?php if (isset($_POST['r_database_name'])) { echo($_POST['r_database_name']); } ?>" tabindex="4" /></span>
		  	</label>
		</div>
		<div class="row" align="center">
	  		<span class="alert" id="elField6"></span>
		</div>
		<div class="row">
		  	<label for="r_user_name">
				<span class="label">Database user name:</span>
				<span class="formw"><input type="text" size="15" name="r_user_name" id="r_user_name" title="text input: for the user name to login into your database" value="<?php if (isset($_POST['r_user_name'])) { echo($_POST['r_user_name']); } ?>" tabindex="5" /></span>
		  	</label>
		</div>
		<div class="row" align="center">
	  		<span class="alert" id="elField7"></span>
		</div>
		<div class="row">
		  	<label for="r_password">
				<span class="label">Database password:</span>
				<span class="formw"><input type="password" size="15" name="r_password" id="r_password" title="text input: for the password to login into your database" value="<?php if (isset($_POST['r_password'])) { echo($_POST['r_password']); } ?>" tabindex="6" /></span>
		  	</label>
		</div>
		<div class="row" align="center">
	  		<span class="alert" id="elField8"></span>
		</div>
		<div class="row">
		  	<label for="r_host_name">
				<span class="label">Database host name:</span>
				<span class="formw"><input type="text" size="15" name="r_host_name" id="r_host_name" title="text input: for the database server host name" value="<?php if (isset($_POST['r_host_name'])) { echo($_POST['r_host_name']); } ?>" tabindex="7" /></span>
		  	</label>
		</div>
		</fieldset>
		<div class="row" align="center">
	  		<input type="submit" name="btn_submit" id="btn_submit" value="submit"/>
		</div>
	</form>
</div>
<?php
				break;
		}	
	}
?>

<?php include("../global/_footer.php"); ?>
</body>
</html>