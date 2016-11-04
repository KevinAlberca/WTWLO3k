<?php
/**
 * Created by PhpStorm.
 * User: awh
 * Date: 04/11/2016
 * Time: 10:42
 */

namespace AppBundle\Services;


class WeatherService
{
    static public $API_URL = 'http://api.openweathermap.org/data/2.5/';
    private $_api_key = 'cd86905a9de4a374fed7422a848926e4';
    public $lon;
    public $lat;

    public function __construct(String $lon, String $lat) {
        $this->lon = $lon;
        $this->lat = $lat;
    }

    public function getCurrentWeather() {
        $api_url = $this->_getCurrentWeatherUrl();
        $json = $this->_getCurrentWeatherJSON($api_url);

        return $json;
    }

    private function _getCurrentWeatherUrl() {
        if($this->_api_key != null){
            return self::$API_URL . '/weather?lat='.$this->lat.'&lon='.$this->lon.'&units=metric&apiKey='.$this->_api_key;
        } else {
            throw new \Error('You must have an api_key in src/AppBundle/Services/WeatherService.php');
        }
    }

    private function _getCurrentWeatherJSON(String $url_to_call) {
        return json_decode(file_get_contents($url_to_call));
    }

}