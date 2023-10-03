<?php

class CSVParser
{
    protected $fileHandler;

    public function __construct()
    {
        // Open file
        $tempFileName = $_FILES["file"]["tmp_name"]; // the temporary location of uploaded file on web server
        $this->fileHandler  = fopen($tempFileName, 'r') or die("unable to open file"); // open csv file
    }

    public function parseCSV(bool $hasHeader = true) // function to read each line in csv file and parse attributes
    {
        $lines = array();
        if ($hasHeader) { //read the header row (1st line in csv file)
            $header = fgetcsv($this->fileHandler, ",");
        }

        //Read all rows after header row
        while ($data = fgetcsv($this->fileHandler, ",")) {
            //parse column into attributes if line is not blank
            if (($data) != array(null)) {
                $date      = strtotime($data[0]); // convert string to date
                $tranCode  = $data[1];
                $custNo    = (int) $data[2]; // convert string to int
                $reference = $data[3];
                $amount    = (float) $data[4]; // convert string to double

            //store attributes into array
                $lines[] = array(
                  "date" => $date,
                  "tranCode" => $tranCode,
                  "custNo" => $custNo,
                  "reference" => $reference,
                  "amount" => $amount,
                );
            } else {
                break;
            }
        }
        return $lines; // return a 2d array
    }
}