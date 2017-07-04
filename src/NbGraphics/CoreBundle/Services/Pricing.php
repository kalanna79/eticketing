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
        /**
         * Calcule le prix du billet selon le tarif et la durée
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
        
        public function HowOld($birthday, $visitdate)
        {
            $diff = date_diff($visitdate, $birthday);
            $age = $diff->format('%Y');
            return $age;
        }
    }