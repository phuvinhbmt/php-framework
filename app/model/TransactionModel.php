<?php
require_once './app/entities/BankTransaction.php';

class TransactionModel extends CSVParser
{
    private $bankTransactionArray = array();

    public function getTransactions()
    {
        return $this->bankTransactionArray;
    }

    public function sortTransactions()
    {
        usort($this->bankTransactionArray,
            function(BankTransaction $tran1, BankTransaction $tran2) {
            return $tran1->getDate() - $tran2->getDate();
        });
    }

    public function addTransaction($date, $tranCode, $custNo, $reference,
                                   $amount)
    {
        $this->bankTransactionArray[] = new BankTransaction($date, $tranCode,
            $custNo, $reference, $amount);
    }
}