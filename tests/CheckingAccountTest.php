<?php

namespace Moovin\Job\Backend\Tests;

use Moovin\Job\Backend\CheckingAccount;
use Moovin\Job\Backend\AccountException;

class CheckingAccountTest extends \PHPUnit_Framework_TestCase
{
    public function testWithdaw()
    {
        $account = new CheckingAccount(2000);
        $account->withdraw(500);
        $this->assertEquals(1497.5, $account->getValue());
    }

    public function testWithdrawValueOverLimit()
    {
        $account = new CheckingAccount(2000);
        $this->expectException(AccountException::class);
        $account->withdraw(1200);
    }

    public function testWithdrawValueExceedsBalance()
    {
        $account = new CheckingAccount(10);
        $this->expectException(AccountException::class);
        $account->withdraw(100);
    }

    public function testDeposit()
    {
        $account = new CheckingAccount(2000);
        $account->deposit(500);
        $this->assertEquals(2500, $account->getValue());
    }

    public function testTransfer()
    {
        $srcAccount = new CheckingAccount(2000);
        $destAccount = new CheckingAccount(1000);
        
        $srcAccount->transfer($destAccount, 500);

        $this->assertEquals(1500, $srcAccount->getValue());
        $this->assertEquals(1500, $destAccount->getValue());
    }

    public function testTransferValueExceedsBalance()
    {
        $srcAccount = new CheckingAccount(10);
        $destAccount = new CheckingAccount(1000);

        $this->expectException(AccountException::class);
        $srcAccount->transfer($destAccount, 500);
    }
}