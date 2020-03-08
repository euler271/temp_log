<?php

namespace App\Controller;

use App\Entity\Measurement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
	public function index()
	{
		return $this->render('main.html.twig', [
			'content' => "Dieser Controller gehört zu einer API",
		]);
	}


	public function addMeasurement($api_key){


		if($api_key && $_POST['temperature'] && $_POST['humidity']){
			$entityManager = $this->getDoctrine()->getManager();

			$measurement = new Measurement();
			$measurement->setTemperature($_POST['temperature']);
			$measurement->setHumidity($_POST['humidity']);
			$measurement->setCreatedOn(new \DateTime());
			$entityManager->persist($measurement);
			$entityManager->flush();

			return new Response('Created measurement with id'.$measurement->getId().' '.json_encode($_POST));
		}

		return new Response("No Data!");
	}
}