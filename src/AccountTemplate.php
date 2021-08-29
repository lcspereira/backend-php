<?php

namespace Moovin\Job\Backend;

use Moovin\Job\Backend\AccountException;

class AccountTemplate
{
    /**
     * @var float
     */
    protected $value;
    /**
     * @var float
     */
    protected $tax;
    /**
     * @var float
     */
    protected $maxWithdraw;

    /**
     * @param float $value          Valor inicial da conta
     * @param float $tax            Taxa de saque
     * @param float $maxWithdraw    Máximo de retirada
     */
    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @return float    Valor da conta
     */
    public function getValue() : float
    {
        return $this->value;
    }

    /**
     * Retirada de valor da conta
     *
     * @param float $value  Valor a ser retirado
     *
     * @return void
     *
     * @throws AccountException Dispara exceção se o saldo é insuficiente
     *                          ou se valor excede o limite máximo da sessão
     */
    public function withdraw(float $value) : void
    {
        if (($value + $this->tax) > $this->value) {
            throw new AccountException("Saldo insuficiente");
        } elseif ($value > $this->maxWithdraw) {
            throw new AccountException("Excedido valor máximo");
        }
        $this->value -= ($value + $this->tax);
    }

    /**
     * @param float $value  Valor a ser depositado
     *
     * @return void
     */
    public function deposit(float $value) : void
    {
        $this->value += $value;
    }

    /**
     * @param AccountTemplate $destAccount  Conta de destino da transefência
     * @param float $value  Valor a ser transferido
     *
     * @return void
     *
     * @throws AccountException Dispara exceção se saldo é insuficiente
     */
    public function transfer(AccountTemplate $destAccount, float $value) : void
    {
        if ($value > $this->value) {
            throw new AccountException("Saldo insuficiente");
        }
        $this->value -= $value;
        $destAccount->deposit($value);
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return "Conta genérica - Valor: B$ " . $this->value;
    }
}