<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserController extends Controller
{

    /**
     * @Route("/", name="root")
     */
    public function indexAction()
    {
//        if ($this->isGranted('ROLE_ADMIN')) {
//            return $this->redirectToRoute('adminPage');
//        }
        $user = $this->getUser();
        return $this->redirectToRoute('userPage',array('id' => $user->getId()));
    }


    /**
     * @Route("id{id}",name="userPage")
     */
    public function showUserAction($id) {

        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);


        return $this->render('user/personal_page.html.twig', array('user' => $user));
    }



    /**
     * @Route("/registration", name="registrationPage")
     */
    public function transitionOnRegistrationFormAction()
    {
        return $this->render(':user:registration.html.twig');
    }

    /**
     * @Route("/registration/new", name="registrationNew")
     */
    public function registrationAction(Request $request)
    {
        $user = new User();
        $user->setUsername(mb_strtolower($request->get('_username')));

        if($request->get('_password') != $request->get('_password-2')) {
            $error = 'Пароли не совпадают';
            return $this->render(':user:registration.html.twig', array('error' => $error));
        }
        $plainPassword = $request->get('_password');
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encoded);
        $user->setFirstName($request->get('_firstName'));
        $user->setSecondName($request->get('_secondName'));
        $user->setEmail($request->get('_email'));
        $user->setPost($request->get('_select'));

//        $user->setRoles('ROLE_USER');
        $em = $this->getDoctrine()->getManager();
        try {
            $em->persist($user);
            $em->flush();
        } catch(\Exception $e) {
            $error = 'Логин уже занят';
            return $this->render(':user:registration.html.twig', array('error' => $error));
        }
//        if ($this->isGranted('ROLE_ADMIN')) {
//            return $this->showUserAction($user->getId());
//        }
        $token = new UsernamePasswordToken($user, $user->getPassword(), 'database_users', $user->getRoles() );
        $this->get('security.token_storage')->setToken($token);

        return $this->redirectToRoute('userPage',array('id' => $user->getId()));
    }

    /**
     * @Route("id{id}/addExperiment", name="experimentPage")
     */
    public function addExperimentAction($id)
    {
        $user = $this->getUser();
        return $this->render(':experiment:new_experiment.html.twig', array('user' => $user) );
    }

    /**
     * @Route("/id{id}/experiment/id{experimentId}", name="userExperiment")
     */
    public function showUserExperimentAction($id, $experimentId)
    {
        $user = $this->getUser();
        if ($user!= $this->getDoctrine()->getRepository('AppBundle:User')->find($id) ) {
            return $this->redirectToRoute('userPage',array('id' => $user->getId()));
        }
        $exp = $this->getDoctrine()->getRepository('AppBundle:Experiment')->find($experimentId);

        return $this->render(':experiment:user_experiment.html.twig', array('user' => $user, 'experiment' => $exp));
    }













}