<?php
/**
 * CoSign Id plugin for Craft CMS 3.x
 *
 * Craft 3 Plugin version of Cosign login
 *
 * @link      http://creativeservices.psu.edu
 * @copyright Copyright (c) 2020 WPSU Multimedia
 */

namespace cosignid\cosignid\variables;

use cosignid\cosignid\CosignId;

use Craft;

/**
 * @author    WPSU Multimedia
 * @package   CosignId
 * @since     0.0.1
 */
class CosignIdVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @param null $optional
     * @return string
     */
/*
    public function exampleVariable($optional = null)
    {
        $result = "And away we go to the Twig template...";
        if ($optional) {
            $result = "I'm feeling optional today...";
        }
        return $result;
    }
*/
    
    public function studentId()
    {
	    //check if remote user defined
		if(isset($_SERVER['REMOTE_USER'])){
			 return $_SERVER['REMOTE_USER'];
		}
		//if not, return false
		else{
			//try login again
			if ($_SERVER['HTTP_HOST'] == 'localhost:8080')
				{
					$_SERVER['REMOTE_USER'] = trim(explode("|",$_COOKIE['token'])[0]);
					return true;
				}

			    if ( isset( $_SERVER['REMOTE_USER'] ) and !empty( $_SERVER['REMOTE_USER'] ) )
			    {
				    if ( $_SERVER['AUTH_TYPE'] == 'Cosign' and isset( $_SERVER['COSIGN_SERVICE'] ) )
				    {
					    $service_name = preg_replace('/\./', '_', $_SERVER['COSIGN_SERVICE']);
					    if ( isset( $_COOKIE[$service_name] ) )
					    {
						    return true;
					    }
				    }
			    }

			    return false;

		}

    }
}
