<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig');
    }

    /**
     * @Route("/custom", name="custom")
     * @param Requestst $request
     * @return Response
     */
    public function custom(Request $request)
    {
        $name = $request->get('name');
        return $this->render('main/custom.html.twig',[
            'name'  => $name
        ]);
    }
}
