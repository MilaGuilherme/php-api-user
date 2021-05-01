<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="phone")
 */
class Phone
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Choice(
     *     choices = {"11","12","13","14","15","16","17","18","19","21","22","24","27","28","31","32","33","34","35","37","38","41","42","43","44","45","46","47","48","49","51","53","54","55","61","62","63","64","65","66","67","68","69","71","73","74","75","77","79","81","82","83","84","85","86","87","88","89","91","92","93","94","95","96","97","98","99"},
     *     message = "Informe um DDD válido"
     * )
     */
    private int $ddd;

    /**
     * @ORM\Column(type="string", length=9)
     * @Assert\NotBlank(message="O número de telefone é obrigatório")
     * @Assert\Regex(
     *     pattern     = "/^(\d{4})[-](\d{4})$"
     * )
     */
    private string $phoneNumber;

    public function __construct()
    {
        
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDDD(): int
    {
        return $this->ddd;
    }

    public function setDDD(int $ddd): void
    {
        $this->ddd = $ddd;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }
}
