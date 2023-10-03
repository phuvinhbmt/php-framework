<?php
require_once './app/entities/TransactionCodeValidator.php';

class BankTransaction
{
    private $date;
    private $transactionCode;
    private $customerNo;
    private $reference;
    private $amount;
    private $valid; // Yes if transaction code is valid, No if transacation code is invalid
    private $type; // credit (positive amount) or debit (negative amount)

    public function __construct(
        int $date, string $transactionCode, int $custerNo, string $reference,
    float $amount)
    {
        $this->date            = $date;
        $this->transactionCode = $transactionCode;
        $this->customerNo      = $custerNo;
        $this->reference       = $reference;
        $this->amount          = $amount;
        $this->valid           = (TransactionCodeValidator::verifyKey($this->transactionCode))
                ? "Yes" : "No";
        $this->type            = ($this->amount <= 0) ? "debit" : "credit";
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getFormatDate(): string // get date in a time format
    {
        $timeFormat = 'd/n/Y g:i A';
        return date($timeFormat, $this->date);
    }

    public function getTransactionCode(): string
    {
        return $this->transactionCode;
    }

    public function getCustomerNo(): int
    {
        return $this->customerNo;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getFormattedAmount(): string // similar function to money_format(): print the amount in a money format
    {
        if ($this->amount < 0) 
            return "-$".-$this->amount / 100; //format for negative amount
        return "$".$this->amount / 100; // format for positive amount
    }

    public function getValid(): string
    {
        return $this->valid;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setTransactionCode($transactionCode)
    {
        $this->transactionCode = $transactionCode;
    }

    public function setCustomerNo($customerNo)
    {
        $this->customerNo = $customerNo;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setValid($valid)
    {
        $this->valid = $valid;
    }

    function __toString(): string
    {
        return sprintf("%s %s %d %s %f", $this->date, $this->transactionCode,
            $this->customerNo, $this->reference, $this->amount);
    }
}