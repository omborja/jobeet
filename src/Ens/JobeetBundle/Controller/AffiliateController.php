<?php

namespace Ens\JobeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ens\JobeetBundle\Entity\Affiliate;
use Ens\JobeetBundle\Form\AffiliateType;
use Symfony\Component\HttpFoundation\Request;
use Ens\JobeetBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/affiliate")
 */
class AffiliateController extends Controller
{
    /**
     * Creates a new job entity.
     *
     * @Route("/new", name="affiliate_new")
     * @Method({"GET", "POST"})
     */
    public function newAction()
    {
        $entity = new Affiliate();
        $form = $this->createForm(new AffiliateType(), $entity);

        return $this->render('EnsJobeetBundle:Affiliate:affiliate_new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new affiliate entity.
     *
     * @Route("/create", name="affiliate_create")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        $affiliate = new Affiliate();
        $form = $this->createForm(new AffiliateType(), $affiliate);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isValid()) {

            $formData = $request->get('affiliate');
            $affiliate->setUrl($formData['url']);
            $affiliate->setEmail($formData['email']);
            $affiliate->setIsActive(false);

            $em->persist($affiliate);
            $em->flush();

            return $this->redirect($this->generateUrl('affiliate_wait'));
        }

        return $this->render('EnsJobeetBundle:Affiliate:affiliate_new.html.twig', array(
            'entity' => $affiliate,
            'form'   => $form->createView(),
        ));
    }

    /**
     *
     * @Route("/wait", name="affiliate_wait")
     * @Method({"GET", "POST"})
     */
    public function waitAction()
    {
        return $this->render('EnsJobeetBundle:Affiliate:wait.html.twig');
    }
}