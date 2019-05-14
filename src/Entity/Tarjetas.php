<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarjetas
 *
 * @ORM\Table(name="tarjetas", indexes={@ORM\Index(name="usuario", columns={"email"})})
 * @ORM\Entity(repositoryClass="App\Repository\TarjetasRepository")
 */
class Tarjetas
{
    /**
     * @var string
     *
     * @ORM\Column(name="numero_tarjeta", type="string", length=16, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numeroTarjeta;

    /**
     * @var int
     *
     * @ORM\Column(name="codigo", type="integer", nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="vencimiento", type="string", length=4, nullable=false)
     */
    private $vencimiento;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="email", referencedColumnName="email")
     * })
     */
    private $email;

    public function getNumeroTarjeta(): ?string
    {
        return $this->numeroTarjeta;
    }

    public function getCodigo(): ?int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getVencimiento(): ?string
    {
        return $this->vencimiento;
    }

    public function setVencimiento(string $vencimiento): self
    {
        $this->vencimiento = $vencimiento;

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
