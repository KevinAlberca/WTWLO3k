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
        $weather = $current_weather->weather[0]->main;

        $moment = intval(date("h")) > 7 && intval(date("h")) < 21 ? "day" : "night";

        $videos = [
            "day" => [
                "Clear" => [
                    "2G8LAiHSCAs",
                    "OdIJ2x3nxzQ",
                    "x30YOmfeVTE",
                    "EjBR8con4dU",
                    "yJV7qevsCcw",
                ],
                "Clouds" => [
                    "SynzKC4fWp0",
                    "4QOIvQptS4A",
                    "ljx-kwWIV8Y"
                ],
                "Rain" => [
                    "SynzKC4fWp0",
                    "4QOIvQptS4A",
                    "ljx-kwWIV8Y"
                ]
            ],
            "night" => [
                "Clear" => [
                    "E77jmtut1Zc",
                    "W8tVwiYsgHg",
                    "UfsQhSYJVTc",
                    "1esaH_VDlK4"
                ],
                "Clouds" => [
                    "aiAmAcaDQrM",
                    "Md_tYP1yiIQ",
                    "SynzKC4fWp0",
                    "4QOIvQptS4A",
                    "ljx-kwWIV8Y"
                ],
                "Rain" => [
                    "aiAmAcaDQrM",
                    "Md_tYP1yiIQ",
                    "SynzKC4fWp0",
                    "4QOIvQptS4A",
                    "ljx-kwWIV8Y"
                ]
            ]

        ];

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'weather' => $weather,
            'moment' => $moment,
            'videos' => $videos[$moment]["Clear"]
        ]);
    }
}
