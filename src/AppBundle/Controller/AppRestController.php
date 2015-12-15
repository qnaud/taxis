<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AppRestController extends Controller
{
    /**
     * Retourne la liste des taxis présents autour d'une latitude et d'une longitude données (au format JSON)
     *
     * @param $lat => latitude
     * @param $lon => longitude
     * @return Response
     */
    public function getTaxisAction($lat, $lon)
    {
        $response = new Response();

        if(null === $lat || null === $lon){
            $response->setContent('{"message": "Veuillez preciser une latitude et une longitude !"}');
        }else{
            // GET Json File
            //$path_json = 'https://guarded-ocean-4869.herokuapp.com/json/taxis_'.$lat.'_'.$lon.'.json';
            $path_json = $this->get('kernel')->getRootDir();
            var_dump($path_json);
            if(file_exists($path_json)){
                $response->setContent(file_get_contents($path_json));
            }else{
                $response->setContent('{}');
            }
        }

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Demande la réservation d'un taxi et retourne la réponse au format JSON
     *
     * @param $idTaxi
     * @return Response
     */
    public function getReservationAction($idTaxi)
    {
        $response = new Response();

        if(null === $idTaxi){
            $response->setContent('{"message": "Veuillez preciser l\'ID du taxi !"}');
        }else{
            $random_response = rand (0, 1);
            if($random_response){
                $response->setContent('{"message": "Votre taxi a bien ete reserve !"}');
            }else{
                $response->setContent('{"message": "Impossible de reserver ce taxi !"}');
            }
        }

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
