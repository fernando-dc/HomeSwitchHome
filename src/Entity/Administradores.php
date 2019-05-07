<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Administradores
 *
 * @ORM\Table(name="administradores")
 * @ORM\Entity
 */
class Administradores
{
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $token;

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
        
        return $this;
    }


}
