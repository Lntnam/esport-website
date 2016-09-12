<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 12/09/2016
 * Time: 06:45
 */

namespace App;


class FixtureMailer
{
    protected $settings;

    public function __construct($setting = null)
    {
        if (empty($setting)) {
            // Load settings
            $config = \Config::get('settings.mc_campaigns');

            if (!isset($config['fixtures']))
                throw new \Exception("Campaign [fixtures] not found in config\\settings.php");
            $this->settings = $config['fixtures'];
        }
        else {
            $this->settings = $setting;
        }
    }

    public function run()
    {
        if (!$this->_mc_data_constrain())
            return;
    }

    /**
     * @return boolean
     */
    private function _mc_data_constrain()
    {
        return true;
    }
}