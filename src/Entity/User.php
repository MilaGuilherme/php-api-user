<?php

namespace App\Entity;

use App\Entity\Address;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 * @UniqueEntity("email",message="Este email ja esta cadastrado")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="O primeiro nome e obrigatorio")
     * @Assert\Length(
     *     min=1,
     *     max=100,
     *     minMessage="O primeiro nome deve ter no minimo 1 caractere"
     * )
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="O sobrenome e obrigatório")
     * @Assert\Length(
     *     min=1,
     *     max=100,
     *     minMessage="O sobrenome deve ter no minimo 1 caractere"
     * )
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="O e-mail é obrigatorio")
     * @Assert\Email(
     *     message = "O email '{{ value }}' não é valido."
     * )
     */
    private string $email;

    /**
     * @ORM\ManyToMany(targetEntity="Phone",cascade="persist")
     * @ORM\JoinColumn(name="phone_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $phones;

    /**
     * @ORM\OneToOne(targetEntity="Address", cascade={"all"})
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private Address $address;
  
    public function __construct()
    {
        $this->phones = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address): void
    {
        $this->address = $address;
    }

    public function getPhones()
    {
        return $this->phones;
    }

    public function addPhone($phones): void
    {
        $this->phones[] = $phones;
    }
}
