<?php
	/**
	 * GIT DEPLOYMENT SCRIPT
	 */
 
	// The commands
	$commands = array(
		//'echo $PWD',
		//'whoami',
		'git pull',
		'git status'
	);
 
	// Run the commands for output
	$output = '';
	foreach($commands AS $command){
		// Run it
		$tmp = shell_exec($command);
		// Output
		$output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
		$output .= htmlentities(trim($tmp)) . "\n";
	}
 
	// Make it pretty for manual user access
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>GIT DEPLOYMENT SCRIPT</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<pre>
            ,'\   |\    _____________________________
           / /.:  ;;   |                             |
          / :'|| //    |  Git Deployment Script v1.0 |
         (| | ||;'    /    Toothless Wariors Group 5 |
        / ||,;'-.._    |_____________________________|
        : ,;,`';:.--`
        |:|'`-(\\
        ::: \-'\`'
         \\\ \,-`.
          `'\ `.,-`-._      ,-._
   ,-.       \  `.,-' `-.  / ,..`.
  / ,.`.      `.  \ _.-' \',: ``\ \
 / / :..`-'''``-)  `.   _.:''  ''\ \
: :  '' `-..''`/    |-''  |''  '' \ \

<?php echo $output; ?>
</pre>
</body>
</html>