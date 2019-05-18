<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Administradores
 *
 * @ORM\Table(name="administradores", indexes={@ORM\Index(name="email", columns={"email"})})
 * @ORM\Entity(repositoryClass="App\Repository\AdministradoresRepository")
 */
class Administradores
{
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $token;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="email", referencedColumnName="email")
     * })
     */
    private $email;

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(int $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getEmail(): ?Usuarios
    {
        return $this->email;
    }

    public function setEmail(?Usuarios $email): self
    {
        $this->email = $email;

        return $this;
    }


}
