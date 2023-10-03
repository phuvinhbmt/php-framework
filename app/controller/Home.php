<?php

class Home extends Controller
{

    function upload()
    {
        $this->view("uploadView", []);
        if (isset($_FILES["file"])) {
            $this->model = $this->model("TransactionModel");
            $lines = $this->model->parseCSV(true);
            foreach($lines as $row) {
                $this->model->addTransaction($row["date"], $row["tranCode"], $row["custNo"], $row["reference"], $row["amount"]);
                $this->model->sortTransactions();
            }
            $this->view("showResultView", [
                "transactions" => $this->model->getTransactions(),
            ]);
        }
    }

    function display()
    {
        $transaction = $this->model("TransactionModel");
        $this->view("uploadView",
            [
            "transactions" => $transaction->getTransactions()
        ]);
    }
}