<?php

namespace Moovin\Job\Backend;

use Moovin\Job\Backend\AccountTemplate;

class CheckingAccount extends AccountTemplate
{
    /**
     * @param float $value  Valor inicial da conta
     */
    public function __construct(float $value)
    {
        parent::__construct($value);
        $this->tax = 2.5;
        $this->maxWithdraw = 600;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return "Conta corrente - Valor: B$ " . $this->value;
    }
}
