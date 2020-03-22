<?php

namespace App\Controller;

use App\Entity\Patient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CasesController extends AbstractController
{
    /**
     * @Route("/cases", name="cases")
     */
    public function index()
    {
        return new RedirectResponse($this->generateUrl('cases_my'));
    }

    /**
     * @Route("/cases/my", name="cases_my")
     */
    public function myCases(Request $request)
    {
        $form = $this->generateAddPatientForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            /** @var Patient $patient  */
            $patient = $form->getData();

            //TODO: FETCH DATA FROM SERVICE
            // $this->getParameter("service_url");

            $caseData = json_decode(file_get_contents($this->getParameter("service_url") . "/api/people/" . $patient->getUniqueId()), true);

            if($caseData) {
                $singleHousehold = false;
                $preconditions = [];

                foreach($caseData["initialQuestionnaireAnswers"] as $answer) {
                    if($answer["question"] == "Leben sie mit anderen Menschen zusammen im Haushalt?") {
                        if($answer["answer"] == "Ja") {
                            $singleHousehold = true;
                        }
                    }
                    if($answer["question"] == "Wie alt sind sie?") {
                        switch($answer["answer"]) {
                            case "60-80":
                            case "80>":
                                $preconditions[] = "Alter " . $answer["answer"];
                                break;
                        }
                    }
                    if($answer["question"] == "Rauchen Sie?") {
                        switch($answer["answer"]) {
                            case "Ja":
                                $preconditions[] = "Raucher";
                                break;
                        }
                    }
                    if($answer["question"] == "Sind sie Schwanger?") {
                        switch($answer["answer"]) {
                            case "Ja":
                                $preconditions[] = "Schwanger";
                                break;
                        }
                    }
                    if($answer["question"] == "Sind sie innerhalb der letzten 4 Wochen verreist?") {
                        switch($answer["answer"]) {
                            case "Ja":
                                $preconditions[] = "Reisender";
                                break;
                        }
                    }

                }
            }


            $patient->setSingleHousehold($singleHousehold);
            $patient->setPreconditions($preconditions);

            $patient->setUniqueId(str_replace(["-", "_"], ["", ""], $patient->getUniqueId()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($patient);
            $em->flush();

            return new RedirectResponse($this->generateUrl('cases_my'));
        }

        $patientRepo = $this->getDoctrine()->getRepository(Patient::class);
        $patients = $patientRepo->findAll();

        return $this->render('cases/case_list.html.twig', [
            'menu_active' => 'cases_my',
            'patients' => $patients,
            'add_patient' => $form->createView()
        ]);
    }

    private function generateAddPatientForm() {

        $patient = new Patient();
        $patient->setAddedOn(new \DateTime("now"));

        $form = $this->createFormBuilder($patient)
            ->add('uniqueId', TextType::class, ['attr' => ['placeholder' => "A12-B23", 'maxlength' => 7]])
            ->add('firstname', TextType::class, ['required' => false, 'attr' => ['placeholder' => "Max"]])
            ->add('lastname', TextType::class, ['required' => false, 'attr' => ['placeholder' => "Mustermann"]])
            ->add('monitorUntil', DateType::class, ['widget' => 'single_text'])
            ->add('save', SubmitType::class, ['label' => 'Fall hinzufügen'])
            ->getForm();

        return $form;
    }
}
