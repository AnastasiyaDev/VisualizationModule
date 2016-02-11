<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Table;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class TableController extends Controller
{

    /**
     * @Route("/tableid{id}", name="filingTable")
     */
    public function indexAction($id)
    {
        $table = $this->getDoctrine()
            ->getRepository('AppBundle:Table')
            ->find($id);

        if(!$table) {
            throw $this->createNotFoundException('No found test for id'.$id);
        }
        return $this->render('experiment/table/filling_table.html.twig', array('table' => $table));
    }

    /**
     * @Route("experimentid{id}/table/new", name="newTable")
     */
    public function tableAction($id, Request $request)
    {
        $table = new Table();

        $table->setTitle($request->get('_title'));
        $table->setInfo($request->get('_info'));
        $table->setTableDate(new \DateTime(date('d.m.Y', strtotime($request->get('_tabledate')))));
        $table->setColumnLable($request->get('_clable'));
        $table->setRowLable($request->get('_rlable'));
        $table->setColumnCount($request->get('_col-count'));
        $table->setRowCount($request->get('_row-count'));

        $exp = $this->getDoctrine()->getRepository('AppBundle:Experiment')->find($id);
        $table->setExperiment($exp);

        $em = $this->getDoctrine()->getManager();
//        $em->persist($this->getExperiment());
        $em->persist($exp);
        $em->persist($table);
        $em->flush();

        return $this->redirectToRoute('filingTable', array('id' => $table->getId() ));
    }

    /**
     * @Route("experimentid{id}/table/new", name="fillingTable")
     */
    public function filledTableAction($id, Request $request)
    {




    }







}
