<?php
    
    /**
     * Created by PhpStorm.
     * User: natacha
     * Date: 29/06/2017
     * Time: 12:39
     */
    
    namespace NbGraphics\CoreBundle\Services;
    
    class Pricing
    {
    
        /** Calculate the final price of a ticket according to the duration
         * @param $price
         * @param $duration
         * @return float|int
         */
        public function OneTicketPrice($price, $duration)
        {
            if ($duration == '2')
            {
                $price = $price / 2;
                return $price;
            }
            else
            {
                return $price;
            }
        }
    
        /** calculate the price of of a ticket according to age
         * @param      $age
         * @param null $reduction
         * @return int
         */
        public function Tarif($age, $reduction = null)
        {
            switch ($age)
            {
                case $age < 4:
                    $price = 0;
                    break;
                case $age >= 4 && $age < 12:
                    $price = 8;
                    break;
                case $age >= 60:
                    $price = 12;
                    break;
                case $reduction:
                    $price = 10;
                    break;
                default:
                    $price = 16;
                    break;
            }
            return $price;
        }
    
        /** Calculate the age
         * @param $birthday
         * @param $visitdate
         * @return string
         */
        public function HowOld($birthday, $visitdate)
        {
            $diff = date_diff($visitdate, $birthday);
            $age = $diff->format('%Y');
            return $age;
        }
    }