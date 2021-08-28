<?php

namespace Moovin\Job\Backend;

use Moovin\Job\Backend\AccountTemplate;

class SavingAccount extends AccountTemplate
{
    /**
     * @param float $value  Valor inical da conta
     */
    public function __construct(float $value)
    {
        parent::__construct($value);
        $this->tax = 0.8;
        $this->maxWithdraw = 1000;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return "Conta poupança - Valor: B$ " . $this->value;
    }
}
