<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Administradores
 *
 * @ORM\Table(name="administradores")
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

    public function getToken(): ?string
    {
        return $this->token;
    }
    public function setToken(int $token): self
    {
        $this->token = $token;

        return $this;
    }


}
