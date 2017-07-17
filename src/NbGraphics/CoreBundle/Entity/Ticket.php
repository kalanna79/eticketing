<?php

namespace NbGraphics\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use NbGraphics\CoreBundle\Validator\Constraints\numberTicketsValid;
use NbGraphics\CoreBundle\Validator\Constraints\isDayValid;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="NbGraphics\CoreBundle\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @ORM\ManyToOne(targetEntity="Basket", inversedBy="tickets", cascade={"persist"})
     * @ORM\JoinColumn(name="basket_id", referencedColumnName="id")
     */
    private $basket;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Firstname", type="string", length=255)
     * @Assert\Length(min=3)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     * @Assert\Length(min=3)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Birthday", type="datetime")
     * @Assert\DateTime()
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="Country", type="string", length=255)
     * @Assert\Length(min=2)
     */
    private $country;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Visitdate", type="datetime")
     * @Assert\DateTime()
     * @numberTicketsValid()
     * @isDayValid()
     */
    private $visitdate;

    /**
     * @var int
     *
     * @ORM\Column(name="Duration", type="integer")
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="Price", type="decimal", precision=5, scale=2)
     */
    private $price;
    
    /**
     * @var boolean
     */
    private $reduction;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Code", type="string", length=25)
     * @Assert\Length(min=15)
     */
    private $code;
    
    /**
     * Ticket constructor.
     */

    public function __construct()
    {
        $this->visitdate = new \DateTime();
        $this->setCode($this->generateCode());
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Ticket
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Ticket
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Ticket
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Ticket
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set visitdate
     *
     * @param \DateTime $visitdate
     *
     * @return Ticket
     */
    public function setVisitdate($visitdate)
    {
        $this->visitdate = $visitdate;

        return $this;
    }

    /**
     * Get visitdate
     *
     * @return \DateTime
     */
    public function getVisitdate()
    {
        return $this->visitdate;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Ticket
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Ticket
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    
    /**
     * Set basket
     *
     * @param \NbGraphics\CoreBundle\Entity\Basket $basket
     *
     * @return Ticket
     */
    public function setBasket(\NbGraphics\CoreBundle\Entity\Basket $basket)
    {
        $this->basket = $basket;

        return $this;
    }

    /**
     * Get basket
     *
     * @return \NbGraphics\CoreBundle\Entity\Basket
     */
    public function getBasket()
    {
        return $this->basket;
    }
    
    public function setReduction($reduction)
    {
        $this->reduction = $reduction;
    }
    
    public function getReduction()
    {
        return $this->reduction;
    }
    
    /** set the random code
     * @param $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
    
    /** generate a random code
     * @return string
     */
    public function generateCode()
    {
        $code = "";
        $chaine = "abcdefghijklmnpqrstuvwxy1234567890";
        for($i=0; $i<15; $i++) {
            $code .= $chaine[rand()%strlen($chaine)];
        }
        return $code;
    }
    
    /**
     * @Assert\Callback
     */
    public function isDateValid(ExecutionContextInterface $context)
    {
        $today = new \DateTime();
        $visitday = $this->getVisitdate();
        $diff = date_diff($visitday, $today);
        
        if ($diff->days < 0)
        {
            $context->buildViolation('day')
                    ->atPath('visitdate')
                    ->addViolation();
        }
    }
    
    /**
     * @Assert\Callback
     *
     */
    
    public function isDurationValid(ExecutionContextInterface $context)
    {
        $day = new \DateTime();
        $day = $day->format('d-m-y');
        $hour = new \DateTime();
        $hour = $hour->format('H:i:s');
        $visitday = $this->getVisitdate()->format('d-m-y');
        
        if ($visitday == $day)
        {
            if ($hour >= '14:00:00' && $this->getDuration() == '1')
            {
                $context->buildViolation('duration')
                        ->atPath('duration')
                        ->addViolation();
            }
        }
    }
    
}
