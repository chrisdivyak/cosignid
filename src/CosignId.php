<?php
/**
 * CoSign Id plugin for Craft CMS 3.x
 *
 * Craft 3 Plugin version of Cosign login
 *
 * @link      http://creativeservices.psu.edu
 * @copyright Copyright (c) 2020 WPSU Multimedia
 */

namespace cosignid\cosignid;

use cosignid\cosignid\variables\CosignIdVariable;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Class CosignId
 *
 * @author    WPSU Multimedia
 * @package   CosignId
 * @since     0.0.1
 *
 */
class CosignId extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var CosignId
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '0.0.1';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('cosignId', CosignIdVariable::class);
                
                
                
                //Get Cosign info after 2-factor authentication
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
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'co-sign-id',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
