<?php

namespace Moovin\Job\Backend\Tests;

use Moovin\Job\Backend\SavingAccount;
use Moovin\Job\Backend\AccountException;

class SavingAccountTest extends \PHPUnit_Framework_TestCase
{
    public function testWithdaw()
    {
        $account = new SavingAccount(2000);
        $account->withdraw(500);
        $this->assertEquals(1499.2, $account->getValue());
    }

    public function testWithdrawValueOverLimit()
    {
        $account = new SavingAccount(2000);
        $this->expectException(AccountException::class);
        $account->withdraw(1200);
    }

    public function testWithdrawValueExceedsBalance()
    {
        $account = new SavingAccount(10);
        $this->expectException(AccountException::class);
        $account->withdraw(100);
    }

    public function testDeposit()
    {
        $account = new SavingAccount(2000);
        $account->deposit(500);
        $this->assertEquals(2500, $account->getValue());
    }

    public function testTransfer()
    {
        $srcAccount = new SavingAccount(2000);
        $destAccount = new SavingAccount(1000);
        
        $srcAccount->transfer($destAccount, 500);

        $this->assertEquals(1500, $this->account->getValue());
        $this->assertEquals(1500, $destAccount->getValue());
    }

    public function testTransferValueExceedsBalance()
    {
        $srcAccount = new SavingAccount(10);
        $destAccount = new SavingAccount(1000);

        $this->expectException(AccountException::class);
        $srcAccount->transfer($destAccount, 500);
    }
}