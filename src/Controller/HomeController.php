<?php

namespace App\Controller;

use App\Geolocation\Geolocate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request): Response
    {
       //$ip_address = $request->getClientIp();
        //$ip_address = getUserIpAddr();
        $prohibited_country = "United States";

        $geolocate = new Geolocate();
        $arr_result = $geolocate->getIPCoordinate();

        if ($arr_result["country_name"] != $prohibited_country){
            return $this->redirectToRoute('app_login');
        }
        return $this->render('home/index.html.twig', [

        ]);
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(): Response
    {
        return $this->render('home/profile.html.twig', [
            'profile' => 'ConnectedController',
        ]);
    }
}
