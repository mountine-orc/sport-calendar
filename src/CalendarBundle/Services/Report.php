<?php
namespace CalendarBundle\Services;

use CalendarBundle\Repository\ExerciseRepository;


class Report
{
    /**
     * Set time
     *
     * @param ExerciseRepository $repository
     *
     */
    function __construct(ExerciseRepository $repository)
    {
        $this->repository = $repository;
    }

    function getLastTrainingsReport()
    {

    }
}
