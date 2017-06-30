<?php

namespace NbGraphics\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use  NbGraphics\CoreBundle\Entity\Ticket;

/**
 * Basket
 *
 * @ORM\Table(name="basket")
 * @ORM\Entity(repositoryClass="NbGraphics\CoreBundle\Repository\BasketRepository")
 */
class Basket
{
    /**
     * @ORM\OneToMany(targetEntity="NbGraphics\CoreBundle\Entity\Ticket", mappedBy="basket", cascade={"persist"})
     */
    private $tickets;
    
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
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="total", type="decimal", precision=5, scale=2)
     */
    private $total;
    
    
    /**
     * Basket constructor.
     */
    public function __construct()
    {
        $this->tickets = new ArrayCollection();
        $this->setStatus('en cours');
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
     * @return Basket
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
     * @return Basket
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
     * Set email
     *
     * @param string $email
     *
     * @return Basket
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Basket
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set total
     *
     * @param string $total
     *
     * @return Basket
     */
    public function setTotal($total)
    {
        
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set tickets
     *
     * @param string $tickets
     *
     * @return Basket
     */
    public function setTickets($tickets)
    {
        $this->tickets = $tickets;

        return $this;
    }

    /**
     * Get tickets
     *
     * @return string
     */
    public function getTickets()
    {
        return $this->tickets;
    }
    
    /**
     * Add a new ticket in basket
     * @param \NbGraphics\CoreBundle\Entity\Ticket $ticket
     */
    public function addTicket(Ticket $ticket)
    {
        $this->tickets->add($ticket);
    }
    
    /**
     * Remove a ticket from basket
     * @param \NbGraphics\CoreBundle\Entity\Ticket $ticket
     */
    public function removeTicket(Ticket $ticket)
    {
        $this->tickets->remove($ticket);
    }
    
    /**
     * Allow to construct the array of tickets in basket
     * @param $tickets
     */
    public function createTickets($tickets)
    {
        
        foreach ($tickets as $ticket)
        {
            $ticket->setBasket($this);
            $this->addTicket($ticket);
        }
    }
}
