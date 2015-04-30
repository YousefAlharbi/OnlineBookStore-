<?php
$pageTitle = "Site Map";
include 'sitemap.html.php';


/*
	Author: Noha Salem
	Date: 24 Dec 14
	Description: Display the site map to the user
	reference - http://www.codingforums.com/showthread.php?t=71882
*/
function contains($needle, $haystack)
{
    return strpos($haystack, $needle) !== false;
}

function getDirectory( $path = '.', $level = 0 ){

    $ignore = array( 'cgi-bin', '.', '..', "images", "js", "includes","photovalidate.php","css","references","Things to do.txt","displaysession.php" );
    $dh = @opendir( $path );

    while( false !== ( $file = readdir( $dh ) ) ){
        if( !in_array( $file, $ignore ) ){

            $spaces = str_repeat( '&nbsp;', ( $level * 4 ) );
            if( is_dir( "$path/$file" ) ){

					echo "<strong>$spaces <a href='".$path."/".$file."'>".$file."</a></strong><br />";
					getDirectory( "$path/$file", ($level+1) );
            } else {
            	if(!contains('html',$file) && !contains('php',$file))
            	{
                echo "$spaces $file<br />";
				}

            }
        }
    }

    closedir( $dh );
}
?>