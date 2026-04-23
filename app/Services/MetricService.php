<?php
namespace App\Services;

class MetricService{
    public function calculate(string $key, array $data){
        return match($key){
            'bmi' => $this->calculateBMI($data),
            'wtr' => $this->estimateWTR($data),
            //'vo2' => $this->estimateVO2($data),
            default => throw new \Exception("Unknown metric: {$key}")
        };
    }

    //body mass indiex
    private function calculateBMI(array $data){
        $weight = $data['weight'] ?? null;
        $height = $data['height'] ?? null;

        if(!$weight || !$height){
            return throw new \Exception("Missing data for BMI");
        }

        //height in m
        $heightM = $height/100;

        return round($weight/($heightM * $heightM), 2);
    }

    //waist-stature ratio
    private function estimateWTR(array $data){
        $waist = $data['waist'] ?? null;
        $height = $data['height'] ?? null;

        if(!$waist || !$height){
            return throw new \Exception("Missing data for WTR");
        }

        return round($waist/$height, 2);
    }

    //max oxygen volume (6 min run)
    //public function estimateVO2(array $data){
    //
    //}
}
