<?php
namespace CalendarBundle\Services;

use Doctrine\ORM\EntityManager;


class Report
{
    /**
     *
     * @param EntityManager $em
     *
     */
    function __construct(EntityManager $em)
    {
        $this->repository = $em->getRepository("CalendarBundle:Exercise");
    }

    function getLastTrainingsReport()
    {
        $report = [
            "today" => [],
            "one_week_ago" => [],
            "two_weeks_ago" => []
        ];

        $query = $this->repository->createQueryBuilder('p')
            ->where('p.date = :today')
            ->orWhere('p.date = :one_week_ago')
            ->orWhere('p.date = :two_weeks_ago')
            ->setParameter('today', new \DateTime('today'), \Doctrine\DBAL\Types\Type::DATE)
            ->setParameter('one_week_ago', new \DateTime('-1 week'), \Doctrine\DBAL\Types\Type::DATE)
            ->setParameter('two_weeks_ago', new \DateTime('-2 week'), \Doctrine\DBAL\Types\Type::DATE)
            ->getQuery();
        $result =  $query->getResult();

        foreach ($result as $val){
            $exercise = $val->getDescription()." ".$val->getWeight()." X ".$val->getCount();

            switch ($val->getDate()->format('Y-m-d')){
                case (new \DateTime('today'))->format('Y-m-d'):
                    $report["today"][] = $exercise;
                    break;
                case (new \DateTime('-1 week'))->format('Y-m-d'):
                    $report["one_week_ago"][] = $exercise;
                    break;
                case (new \DateTime('-2 week'))->format('Y-m-d'):
                    $report["two_weeks_ago"][] = $exercise;
                    break;
            }
        }

        return $report;
    }
}
