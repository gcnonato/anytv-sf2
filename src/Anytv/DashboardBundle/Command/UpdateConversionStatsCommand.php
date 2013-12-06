<?php

namespace Anytv\DashboardBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Anytv\DashboardBundle\Entity\Conversion;
use Anytv\DashboardBundle\Entity\Affiliate;
use Anytv\DashboardBundle\Entity\Youtube;

class UpdateConversionStatsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('anytv:update_conversion_stats')
            ->setDescription('Updating ConversionStats from Conversions.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = 'Updating ConversionStats from Conversions.';
        $container = $this->getContainer();
        $doctrine = $container->get('doctrine');
        $repository = $doctrine->getRepository('AnytvDashboardBundle:Conversion');
        $affiliate_repository = $doctrine->getRepository('AnytvDashboardBundle:Affiliate');
        $youtube_video_repository = $doctrine->getRepository('AnytvDashboardBundle:YoutubeVideo');
        $manager = $doctrine->getManager();
          
        $conversions = $repository->findBy(array('statsRequested'=>false), null, 500);
        
        $updated_affiliate_stats = 0;
        $updated_youtube_video_stats = 0;
        foreach($conversions as $conversion)
        {   
          $affiliate = $traffic_referral->getAffiliate();
          
          if($affiliate)
          {
            $affiliate->setClicks($affiliate->getClicks() + $traffic_referral->getClicks());
            $affiliate->setConversionCount($affiliate->getConversionCount() + $traffic_referral->getConversions());
    
            $updated_affiliate_stats++;  
              
          }
          
          $traffic_referral->setAffiliateStatsRequested(true);
        }
        
        $manager->flush();
                
        $output->writeln($text);
        $output->writeln($updated_affiliate_stats.' Affiliates updated.');
    }
}
