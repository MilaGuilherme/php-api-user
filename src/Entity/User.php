<?php

namespace App\Entity;

use App\Entity\Address;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
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
     * @Assert\NotBlank(message="O primeiro nome é obrigatório")
     * @Assert\Length(
     *     min=1,
     *     max=100,
     *     minMessage="O primeiro nome deve ter no mínimo 1 caractere"
     * )
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="O sobrenome é obrigatório")
     * @Assert\Length(
     *     min=1,
     *     max=100,
     *     minMessage="O sobrenome deve ter no mínimo 1 caractere"
     * )
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\NotBlank(message="O e-mail é obrigatório")
     * @Assert\Email(
     *     message = "O email '{{ value }}' não é válido."
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
        $this->createdAt = new \DateTime();
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
