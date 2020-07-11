<?php

class NationalCode
{
    private $number_we_have;
    private $control_digit;

    function __construct ($number) {
        $number_array = str_split((string)$number);
        $this->number_we_have = $number_array[0] * 10
                              + $number_array[1] * 9 
                              + $number_array[2] * 8
                              + $number_array[7] * 3
                              + $number_array[8] * 2;
        $this->control_digit = $number_array[9];
    }

    private function sum_four_middle_digits($number) {
        if ($number < 10) {
            $number = '000'.$number;
        }
        elseif ($number < 100) {
            $number = '00'.$number;
        }
        elseif ($number < 1000) {
            $number = '0'.$number;
        }
        $number_array = str_split((string)$number);
        return ($number_array[0] * 7) + ($number_array[1] * 6) 
             + ($number_array[2] * 5) + ($number_array[3] * 4);
    }

    public function count_valid_numbers() {
        $count_valid_numbers = 0;
        for ($i = 0; $i < 10000; $i++) {
            $remainder = ($this->sum_four_middle_digits($i) + $this->number_we_have)%11;
            if (($remainder < 2 && $this->control_digit == $remainder) 
                || $this->control_digit == 11 - $remainder) {
                $count_valid_numbers++;
            }
        }
        return $count_valid_numbers;
    }
}


ini_set('max_execution_time', 3000);

$codes_file = fopen("national-codes.csv", "r");

while ( ($data_line = fgetcsv($codes_file)) !== FALSE) {
    
    $number = new NationalCode($data_line[0]);
    echo $number->count_valid_numbers()."<br>";

}
