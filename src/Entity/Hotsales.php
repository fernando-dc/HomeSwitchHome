<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotsales
 *
 * @ORM\Table(name="hotsales", indexes={@ORM\Index(name="token_admin", columns={"token_admin"})})
 * @ORM\Entity(repositoryClass="App\Repository\HotsalesRepository")
 */
class Hotsales
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_hotsale", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHotsale;

    /**
     * @var float
     *
     * @ORM\Column(name="descuento", type="float", precision=10, scale=0, nullable=false)
     */
    private $descuento;

    /**
     * @var \Administradores
     *
     * @ORM\ManyToOne(targetEntity="Administradores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="token_admin", referencedColumnName="token")
     * })
     */
    private $tokenAdmin;

    public function getIdHotsale(): ?int
    {
        return $this->idHotsale;
    }

    public function getDescuento(): ?float
    {
        return $this->descuento;
    }

    public function setDescuento(float $descuento): self
    {
        $this->descuento = $descuento;

        return $this;
    }

    public function getTokenAdmin(): ?Administradores
    {
        return $this->tokenAdmin;
    }

    public function setTokenAdmin(?Administradores $tokenAdmin): self
    {
        $this->tokenAdmin = $tokenAdmin;

        return $this;
    }


}
