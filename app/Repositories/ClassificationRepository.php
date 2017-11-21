<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Classification;

class ClassificationRepository extends Repository
{
    protected $parents_array;

    /**
     * ClassificationRepository constructor.
     * @param Classification $classification
     */
    public function __construct(Classification $classification)
    {
        $this->model = $classification;
    }

    public function getParents($id)
    {
        $result = $this->model->where('id', $id)->first();

        $this->parents_array[$result->class] = ['name' => $result->name, 'uname' => $result->uname, 'class' => $result->class];
        if ($result->parent != 0) {
            $this->getParents($result->parent);
        }
        return array_reverse($this->parents_array);
    }

}