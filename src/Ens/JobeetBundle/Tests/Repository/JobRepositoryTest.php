<?php

/**
 * Created by PhpStorm.
 * User: saelm
 * Date: 18/04/18
 * Time: 10:25
 */
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class JobRepositoryTest extends WebTestCase
{

    public function testGetForLuceneQuery()
    {
        $em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $job = new Job();
        $job->setType('part-time');
        $job->setCompany('Sensio');
        $job->setPosition('FOO6');
        $job->setLocation('Paris');
        $job->setDescription('WebDevelopment');
        $job->setHowToApply('Send resumee');
        $job->setEmail('jobeet[at]example.com');
        $job->setUrl('<a class="vglnk" href="http://sensio-labs.com" rel="nofollow"><span>http</span><span>://</span><span>sensio</span><span>-</span><span>labs</span><span>.</span><span>com</span></a>');
        $job->setIsActivated(false);

        $em->persist($job);
        $em->flush();

        $jobs = $em->getRepository('EnsJobeetBundle:Job')->getForLuceneQuery('FOO6');
        $this->assertEquals(count($jobs), 0);

        $job = new Job();
        $job->setType('part-time');
        $job->setCompany('Sensio');
        $job->setPosition('FOO7');
        $job->setLocation('Paris');
        $job->setDescription('WebDevelopment');
        $job->setHowToApply('Send resumee');
        $job->setEmail('jobeet[at]example.com');
        $job->setUrl('<a class="vglnk" href="http://sensio-labs.com" rel="nofollow"><span>http</span><span>://</span><span>sensio</span><span>-</span><span>labs</span><span>.</span><span>com</span></a>');
        $job->setIsActivated(true);

        $em->persist($job);
        $em->flush();

        $jobs = $em->getRepository('EnsJobeetBundle:Job')->getForLuceneQuery('position:FOO7');
        $this->assertEquals(count($jobs), 1);
        foreach ($jobs as $job_rep) {
            $this->assertEquals($job_rep->getId(), $job->getId());
        }

        $em->remove($job);
        $em->flush();

        $jobs = $em->getRepository('EnsJobeetBundle:Job')->getForLuceneQuery('position:FOO7');

        $this->assertEquals(count($jobs), 0);
    }

}