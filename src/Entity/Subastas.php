<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subastas
 *
 * @ORM\Table(name="subastas", indexes={@ORM\Index(name="usuario", columns={"email"}), @ORM\Index(name="token_admin", columns={"token_admin"}), @ORM\Index(name="id_residencia", columns={"id_residencia"})})
 * @ORM\Entity(repositoryClass="App\Repository\SubastasRepository")
 */
class Subastas
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_subasta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSubasta;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_actual", type="float", precision=10, scale=0, nullable=false)
     */
    private $precioActual;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=false)
     */
    private $fechaFin;

    /**
     * @var bool
     *
     * @ORM\Column(name="finalizada", type="boolean", nullable=false)
     */
    private $finalizada;

    /**
     * @var \Administradores
     *
     * @ORM\ManyToOne(targetEntity="Administradores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="token_admin", referencedColumnName="token")
     * })
     */
    private $tokenAdmin;

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
     * @var \Residencias
     *
     * @ORM\ManyToOne(targetEntity="Residencias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_residencia", referencedColumnName="id_residencia")
     * })
     */
    private $idResidencia;

    public function getIdSubasta(): ?int
    {
        return $this->idSubasta;
    }

    public function getPrecioActual(): ?float
    {
        return $this->precioActual;
    }

    public function setPrecioActual(float $precioActual): self
    {
        $this->precioActual = $precioActual;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(\DateTimeInterface $fechaFin): self
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    public function getFinalizada(): ?bool
    {
        return $this->finalizada;
    }

    public function setFinalizada(bool $finalizada): self
    {
        $this->finalizada = $finalizada;

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

    public function getEmail(): ?Usuarios
    {
        return $this->email;
    }

    public function setEmail(?Usuarios $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getIdResidencia(): ?Residencias
    {
        return $this->idResidencia;
    }

    public function setIdResidencia(?Residencias $idResidencia): self
    {
        $this->idResidencia = $idResidencia;

        return $this;
    }


}
