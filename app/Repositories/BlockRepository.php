<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Block;

class BlockRepository extends Repository
{
    public function __construct(Block $block)
    {
        $this->model = $block;
    }

}