<?php

namespace CalendarBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExerciseController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $reportService = $this->get('calendar.report');
        $reportData = $reportService->getLastTrainingsReport();

        return $this->render('calendar/index.html.twig', [
            'report_data' => $reportData
         ]);
    }
}
