<?php
class HomeController extends Controller
{
    function uploadCSV()
    {
        $this->view("uploadCSVView", []);
        $this->view->render();
        if (isset($_FILES["file"])) {
            $this->model = $this->model("BankTransactionModel");
            $rows = $this->model->parseCSV(true);
            foreach($rows as $row) {
                $this->model->addTransaction($row["date"], $row["tranCode"], $row["custNo"], $row["reference"], $row["amount"]);
                $this->model->sortTransactions();
            }
            $this->view("showResultView", [
                "transactions" => $this->model->getTransactions(),
            ]);
//            var_dump($this->model->getTransactions());
            $this->view->render();
        }
    }

}