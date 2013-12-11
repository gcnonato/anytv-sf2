<?php

namespace Anytv\DashboardBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Anytv\DashboardBundle\Entity\AffiliateUser;

class UpdateMailchimpSubscribeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('anytv:update_mailchimp_subscription')
            ->setDescription('Updating MailChimp Affiliate Subscription.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = 'Updating MailChimp Affiliate Subscription.';
        $container = $this->getContainer();
        $doctrine = $container->get('doctrine');
        $repository = $doctrine->getRepository('AnytvDashboardBundle:AffiliateUser');
        $manager = $doctrine->getManager();
        $hype_mailchimp = $container->get('hype_mailchimp');
          
        $affiliate_users = $repository->findBy(array('mailchimpSubscribed'=>false), null, 5);
        
        $updated_affiliates = 0;
        foreach($affiliate_users as $affiliate_user)
        {   
          $result = $hype_mailchimp->getList()->subscribe(trim($affiliate_user->getEmail()), 'html', false, false, false);
          
          if($result)
          {
            $updated_affiliates++;   
          }
          
          $affiliate_user->setMailchimpSubscribed(true);
        }
        
        $manager->flush();
                
        $output->writeln($text);
        $output->writeln($updated_affiliates.' MailChimp Affiliate Subscriptions updated.');
    }
}
