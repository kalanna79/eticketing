<?php

namespace NbGraphics\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $locale = $request->getLocale();
        $content = $this->get('templating')->render('NbGraphicsCoreBundle:Default:index.html.twig', array('_locale' => $locale));
        return new Response($content);
    }
    
    public function mentionsAction()
    {
        $content = $this->get('templating')->render('NbGraphicsCoreBundle:Default:mentions.html.twig');
        return new Response($content);
    }
    
    public function tarifsAction()
    {
        $content = $this->get('templating')->render('NbGraphicsCoreBundle:Default:tarifs.html.twig');
        return new Response($content);
    }
}
 
