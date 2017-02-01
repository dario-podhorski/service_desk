<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ClientController extends Controller
{
    /**
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/client", name="client_page")
     */

    public function adminAction()
    {
        return $this->render('client/clientPage.html.twig');
    }
}
