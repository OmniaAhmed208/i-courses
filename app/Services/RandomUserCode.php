<?php


namespace App\Services;


use Illuminate\Support\Facades\DB;

class RandomUserCode
{
    private array $set = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
    private array $final_list = [];
    private array $students_list = [];

    public function __construct()
    {
        $this->students_list = $this->get_all_students_codes();
        $this->final_list = $this->generate_probabilities(3);
        $this->filter_final_list_to_be_unique();
    }

    private function get_all_students_codes()
    {
        $resualts = DB::select('SELECT `code` FROM `users` WHERE `code` IS NOT NULL');
        $codes = [];
        if (count($resualts) > 0) {
            foreach ($resualts as $resualt) {
                array_push($codes, $resualt->code);
            }
            return $codes;
        }
        return [];
    }

    private function generate_probabilities($size, $combinations = array())
    {

        if (empty($combinations)) {
            $combinations = $this->set;
        }
        if ($size == 1) {
            return $combinations;
        }
        $new_combinations = array();

        foreach ($combinations as $combination) {
            foreach ($this->set as $char) {
                $new_combinations[] = $combination . $char;
            }
        }
        return $this->generate_probabilities($size - 1, $new_combinations);
    }

    private function filter_final_list_to_be_unique()
    {
        foreach ($this->students_list as $code) {
            $index = array_search($code, $this->final_list);
            unset($this->final_list[$index]);
        }
    }

    public function generate_unique_code()
    {
        $index = array_rand($this->final_list, 1);
        $code = $this->final_list[$index];
        unset($this->final_list[$index]);
        return $code;
    }

}
