<?php

namespace Anytv\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MailController extends Controller
{
    public function indexAction(Request $request)
    {
        $translator = $this->get('translator');
  
  
        
        //$hype_mailchimp = $this->get('hype_mailchimp');
        
        //$partners = $hype_mailchimp->getList()->subscribe('dennis@any.tv');
  
        $partners = null;
        
        
        return $this->render('AnytvDashboardBundle:Mail:index.html.twig', array('title'=>$translator->trans('Mail Subscribers'), 'partners'=>$partners));
    }
    
    
}
