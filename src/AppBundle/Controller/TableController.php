<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Column;
use AppBundle\Entity\Row;
use AppBundle\Entity\Table;
use AppBundle\Entity\CellValue;
use AppBundle\Entity\Benchmark;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class TableController extends Controller
{

    /**
     * @Route("experimentid{experimentid}/tableid{id}", name="filingTableForm")
     */
    public function indexAction($id, $experimentid)
    {
        $table = $this->getDoctrine()
            ->getRepository('AppBundle:Table')
            ->find($id);
        $exp = $this->getDoctrine()
            ->getRepository('AppBundle:Experiment')
            ->find($experimentid);

        if(!$table) {
            throw $this->createNotFoundException('No found table for id'.$id);
        }


        return $this->render('experiment/table/filling_table.html.twig', array('table' => $table));
    }

    /**
     * @Route("experimentid{id}/table/new", name="newTable")
     */
    public function tableAction($id, Request $request)
    {
        $table = new Table();
        $em = $this->getDoctrine()->getManager();

        $table->setTitle($request->get('_title'));
        $table->setInfo($request->get('_info'));
        $table->setTableDate(new \DateTime(date('d.m.Y', strtotime($request->get('_tabledate')))));
        $table->setColumnLabel($request->get('_clable'));
        $table->setRowLabel($request->get('_rlable'));
        $table->setColumnCount($request->get('_col-count'));
        $table->setRowCount($request->get('_row-count'));
        $table->setCellLabel($request->get('_cellable'));

        //row create
        for ($i = 0 ; $i < $table->getRowCount(); $i++) {
            $row = new Row();
            $row->setTable($table);
            $em->persist($row);
        }

        //col create
        for ($i = 0 ; $i < $table->getColumnCount(); $i++) {
            $col = new Column();
            $col->setTable($table);
            $em->persist($col);
        }

        $exp = $this->getDoctrine()->getRepository('AppBundle:Experiment')->find($id);
        $table->setExperiment($exp);


        $em->persist($exp);
        $em->persist($table);
        $em->flush();

        return $this->redirectToRoute('filingTableForm', array('id' => $table->getId() , 'experimentid' => $exp->getId() ));
    }

    /**
     * @Route("/tableid{id}/final", name="fillingTable")
     */
    public function filledTableAction($id, Request $request)
    {
        $array = $request->get('value');
        $table = $this->getDoctrine()->getRepository('AppBundle:Table')->find($id);
        $em = $this->getDoctrine()->getManager();

        foreach ($array as $rowId => $item) {
            $row = $this->getDoctrine()->getRepository('AppBundle:Row')
                ->find($rowId);
            foreach ($item as $colId => $value) {
                $col = $this->getDoctrine()->getRepository('AppBundle:Column')
                    ->find($colId);
                $cellValue = new CellValue();
                $cellValue->setValue($value);
                $cellValue->setColumn($col);
                $cellValue->setRow($row);
                $em->persist($cellValue);
                $em->persist($row);
                $em->persist($col);
            }
        }
        $table->setFiling(true);
        $em->flush();

        return $this->redirectToRoute('finalTable', ['id' => $table->getId()]);
    }

    /**
     * @Route("/tableid{id}/finalTable", name="finalTable")
     */
    public function finalTableAction($id)
    {
        $table = $this->getDoctrine()->getRepository('AppBundle:Table')->find($id);

        if (!$table->getFiling()) {
            return $this->redirectToRoute('filingTableForm', ['id' => $table->getId() , 'experimentid' => $table->getExperiment()->getId()]);
        }
        return $this->render('experiment/table/final_table.html.twig', [
                'table' => $table,
                'benchmarkList' => $this->getDoctrine()->getRepository('AppBundle:Benchmark')->findAll(),
            ]);
    }

    /**
     * @Route("/tableid{id}/edit", name="editTableForm")
     */
    public function editTestFormAction(Request $request, $id){

        $table = $this->getDoctrine()->getRepository('AppBundle:Table')->find($id);

        return $this->render('experiment/table/edit_table.html.twig', ['table' => $table]);

    }

    /**
     * @Route("/tableid{id}/save", name="saveTable")
     */
    public function saveTableAction($id, Request $request)
    {
        $array = $request->get('value');
        $table = $this->getDoctrine()->getRepository('AppBundle:Table')->find($id);
        $em = $this->getDoctrine()->getManager();

        foreach ($array as $valueId => $item) {
            $cellValue = $this->getDoctrine()->getRepository('AppBundle:CellValue')
                ->find($valueId);
            $cellValue->setValue($item);
            $em->persist($cellValue);
        }
        $em->flush();

        return $this->redirectToRoute('finalTable', ['id' => $table->getId()]);
    }

}
