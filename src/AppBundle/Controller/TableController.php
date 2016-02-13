<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Column;
use AppBundle\Entity\Row;
use AppBundle\Entity\Table;
use AppBundle\Entity\CellValue;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class TableController extends Controller
{

    /**
     * @Route("/tableid{id}", name="filingTableForm")
     */
    public function indexAction($id)
    {
        $table = $this->getDoctrine()
            ->getRepository('AppBundle:Table')
            ->find($id);

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
        $em->persist($exp);
        $em->persist($table);
        $em->flush();

        return $this->redirectToRoute('filingTable', array('id' => $table->getId() ));
    }

    /**
     * @Route("/tableid{id}/final", name="fillingTable")
     */
    public function filledTableAction($id, Request $request)
    {
        $array = $request->get('value');
        $table = $this->getDoctrine()->getRepository('AppBundle:Table')->find($id);
        $em = $this->getDoctrine()->getManager();

        $k = 0;
        for ($i = key($array); $i <= count($array); $i++) {
            $row = New Row();
            $row->setTable($table);
            for ($j = key($array[$i]); $j <= count($array[$i]); $j++ ) {
                if ($j == 0) {
                $col = new Column();
                $col->setTable($table);
                $em->persist($col);
                    echo 1;
                }
                $tableValue = new CellValue();
                $tableValue->setTable($table);
                $tableValue->setValue($array[$i][$j]);
                $tableValue->setColumn($col);
                $em->persist($tableValue);
            }


            foreach($array[$i] as $item) {




            }
//            for($j = 0; $j < $table->getColumnCount();$j++) {
//                $col = new Column();
//                $col->setTable($table);
//                $em->persist($col);
//                echo $j;
//                foreach($array[$i] as $item) {
//                    $tableValue = new CellValue();
//                    $tableValue->setTable($table);
//                    $tableValue->setValue($item);
//                    $tableValue->setColumn($col);
//                    $em->persist($tableValue);
//                }
//            }
            echo '<br>';

            $em->persist($row);
        }
        $em->persist($table);

        die();
        $em->flush();

        return $this->redirectToRoute('finalTable', ['id' => $table->getId()]);
    }

    /**
     * @Route("/tableid{id}/finalTable", name="finalTable")
     */
    public function finalTableAction($id)
    {
        $table = $this->getDoctrine()->getRepository('AppBundle:Table')->find($id);
        return $this->render('experiment/table/ok.html.twig', ['table' => $table]);
    }



}
