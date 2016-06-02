<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Benchmark;
use AppBundle\Entity\CellValue;
use AppBundle\Entity\Experiment;
use AppBundle\Entity\User;
use Proxies\__CG__\AppBundle\Entity\Column;
use Proxies\__CG__\AppBundle\Entity\Row;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class BenchmarkController extends Controller
{

    /**
     * @Route("id{id}/benchmarkid{benchId}", name="filingBenchForm")
     */
    public function indexAction($id, $benchId)
    {
        $bench = $this->getDoctrine()
            ->getRepository('AppBundle:Benchmark')
            ->find($benchId);

        if(!$bench) {
            throw $this->createNotFoundException('No found table for id'.$id);
        }


        return $this->render('benchmark/filling_benchmark.html.twig', array('benchmark' => $bench));
    }

    /**
     * @Route("/benchmark/new", name="newBenchmark")
     */
    public function benchmarkAction( Request $request)
    {
        $bench = new Benchmark();
        $em = $this->getDoctrine()->getManager();

        $bench->setName($request->get('_benchname'));
        $bench->setDescription($request->get('_description'));
        $bench->setProcessor($request->get('_processor'));
        $bench->setBenchDate(new \DateTime(date('d.m.Y', strtotime($request->get('_benchdate')))));
        $bench->setColumnCount($request->get('_col-count'));
        $bench->setRowCount($request->get('_row-count'));

        //row create
        for ($i = 0 ; $i < $bench->getRowCount(); $i++) {
            $row = new Row();
            $row->setBenchmark($bench);
            $em->persist($row);
        }

        //col create
        for ($i = 0 ; $i < $bench->getColumnCount(); $i++) {
            $col = new Column();
            $col->setBenchmark($bench);
            $em->persist($col);
        }

        $user = $this->getUser();
        $bench->setUser($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->persist($bench);
        $em->flush();

        return $this->redirectToRoute('filingBenchForm', array(
            'id' => $user->getId(),
            'benchId' => $bench->getId(),
        ));
    }


    /**
     * @Route("/benchid{id}/final", name="fillingBench")
     */
    public function filledTableAction($id, Request $request)
    {
        $array = $request->get('value');
        $bench = $this->getDoctrine()->getRepository('AppBundle:Benchmark')->find($id);
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
//        $bench->setFiling(true);
        $em->flush();

        return $this->redirectToRoute('finalBench', ['id' => $bench->getId()]);
    }

    /**
     * @Route("/benchmarkid{id}/finalBenchmark", name="finalBench")
     */
    public function finalBenchAction($id)
    {
        $bench = $this->getDoctrine()->getRepository('AppBundle:Benchmark')->find($id);

//        if (!$table->getFiling()) {
//            return $this->redirectToRoute('filingTableForm', ['id' => $table->getId() , 'experimentid' => $table->getExperiment()->getId()]);
//        }

        return $this->render('benchmark/final_benchmark.html.twig', ['benchmark' => $bench]);
    }

    
    /**
     * Ajax bench 
     * 
     * @Route("bench", name="getBench")
     */
    public function getBenchAction(Request $request){

        $id = ($request->get('id'));
        $bench = $this->getDoctrine()->getRepository('AppBundle:Benchmark')->find($id);

        $arr = null;
        $first = true;
        foreach ($bench->getRows() as $row) {
            if (!$first){
                foreach ($row->getValues() as $value){
                    $arr[] = $value->getValue();
                }
            }
            $first = false;
        }

        $response = new Response(json_encode($arr), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
}
