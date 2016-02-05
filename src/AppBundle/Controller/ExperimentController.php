<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Experiment;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class ExperimentController extends Controller
{

    /**
     * @Route("/experimentid{id}", name="aboutExperiment")
     */
    public function indexAction($id)
    {
        $exp = $this->getDoctrine()
            ->getRepository('AppBundle:Experiment')
            ->find($id);

//        $user = $this->getUser();
//        if (!$user->getExperiment()->isEmpty()) {
//            foreach ($user->getExperiment()->getValues() as $userExperiment) {
//                if ($userExperiment === $test)
//                    return $this->redirectToRoute('userTest', array('id' => $user->getId(), 'testId' => $test->getId()));
//            }
//        }
        if(!$exp) {
            throw $this->createNotFoundException('No found test for id'.$id);
        }
        return $this->render('experiment/about_experiment.html.twig', array('exreriment' => $exp));
    }

    /**
     * @Route("/experiment/new", name="newExperiment")
     */
    public function experimentAction(Request $request)
    {
        $exp = new Experiment();

        $exp->setName($request->get('_expname'));
        $exp->setDescription($request->get('_description'));
        $exp->setExpDate(new \DateTime(date('d.m.Y', strtotime($request->get('_expdate')))));
        $exp->setStatus($request->get('_status'));


        $em = $this->getDoctrine()->getManager();
        $em->persist($exp);
        $em->flush();

        return $this->redirectToRoute('aboutExperiment', array('id' => $exp->getId()));
    }

}
