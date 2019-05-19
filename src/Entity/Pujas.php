<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pujas
 *
 * @ORM\Table(name="pujas", indexes={@ORM\Index(name="email", columns={"email"}), @ORM\Index(name="id_subasta", columns={"id_subasta"})})
 * @ORM\Entity(repositoryClass="App\Repository\PujasRepository")
 */
class Pujas
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_puja", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPuja;

    /**
     * @var float
     *
     * @ORM\Column(name="monto", type="float", precision=10, scale=0, nullable=false)
     */
    private $monto;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="email", referencedColumnName="email")
     * })
     */
    private $email;

    /**
     * @var \Subastas
     *
     * @ORM\ManyToOne(targetEntity="Subastas", inversedBy="pujas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_subasta", referencedColumnName="id_subasta")
     * })
     */
    private $idSubasta;

    public function getIdPuja(): ?int
    {
        return $this->idPuja;
    }

    public function getMonto(): ?float
    {
        return $this->monto;
    }

    public function setMonto(float $monto): self
    {
        $this->monto = $monto;

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

    public function getIdSubasta(): ?Subastas
    {
        return $this->idSubasta;
    }

    public function setIdSubasta(?Subastas $idSubasta): self
    {
        $this->idSubasta = $idSubasta;

        return $this;
    }


}
