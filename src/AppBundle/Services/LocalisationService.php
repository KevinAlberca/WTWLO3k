<?php
/**
 * Created by PhpStorm.
 * User: awh
 * Date: 04/11/2016
 * Time: 12:09
 */

namespace AppBundle\Services;


class LocalisationService
{
    protected $user_ip;

    public function __construct() {
        $this->user_ip = $_SERVER['REMOTE_ADDR'];
    }

    public function getGeolocalisation() {
        $localisation = $this->_getGeolocalisation();

        return [
            "lat" => $localisation['geoplugin_latitude'],
            "lng" => $localisation['geoplugin_longitude'],
            "country" => $localisation['geoplugin_countryCode'],
        ];

    }

    private function _getGeolocalisation() {
        return unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$this->user_ip));
    }
}