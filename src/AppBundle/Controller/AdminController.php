<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{

    /**
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/admin", name="admin_page")
     */

    public function adminAction()
    {
        return $this->render('admin/adminHomepage.html.twig');
    }
}
