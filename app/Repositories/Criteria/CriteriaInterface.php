<?php

namespace App\Repositories\Criteria;


/**
 * Interface CriteriaInterface
 * @package App\Repositories\Criteria
 */
interface CriteriaInterface
{


    /**
     * @param bool $status
     * @return mixed
     */
    public function skipCriteria($status = true);


    /**
     * @return mixed
     */
    public function getCriteria();


    /**
     * @param Criteria $criteria
     * @return mixed
     */
    public function getByCriteria(Criteria $criteria);


    /**
     * @param Criteria $criteria
     * @return mixed
     */
    public function pushCriteria(Criteria $criteria);


    /**
     * @return mixed
     */
    public function applyCriteria();
}