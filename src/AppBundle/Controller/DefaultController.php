<?php

namespace AppBundle\Controller;

use AppBundle\Services\LocalisationService;
use AppBundle\Services\WeatherService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $localisation_service = new LocalisationService();
        $geoloc = $localisation_service->getGeolocalisation();

        $weather_service = new WeatherService($geoloc['lng'], $geoloc['lat']);
        $current_weather = $weather_service->getCurrentWeather();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}
