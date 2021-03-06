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
    
        private $tarif;
        private $age;
        
        public function __construct($tarif, $age)
        {
            $this->tarif = $tarif;
            $this->age = $age;
        }
    
        /** Calculate the final price of a ticket according to the duration
         * @param $price
         * @param $duration
         * @return float|int
         */
        public function oneTicketPrice($price, $duration)
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
        public function tarif($age, $reduction = null)
        {
            switch ($age)
            {
                case $age < $this->age['baby']:
                    $price = $this->tarif['baby'];
                    break;
                case $age >= $this->age['baby'] && $age < $this->age['child']:
                    $price = $this->tarif['child'];
                    break;
                case $age >= $this->age['senior']:
                    $price = $this->tarif['senior'];
                    break;
                case $reduction:
                    $price = $this->tarif['reduced'];
                    break;
                default:
                    $price = $this->tarif['normal'];
                    break;
            }
            return $price;
        }
    
        /** Calculate the age
         * @param $birthday
         * @param $visitdate
         * @return string
         */
        public function howOld($birthday, $visitdate)
        {
            $diff = date_diff($visitdate, $birthday);
            $age = $diff->format('%Y');
            return $age;
        }
    }
