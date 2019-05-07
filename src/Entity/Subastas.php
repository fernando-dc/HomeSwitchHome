<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subastas
 *
 * @ORM\Table(name="subastas", indexes={@ORM\Index(name="token_admin", columns={"token_admin"}), @ORM\Index(name="id_semana", columns={"id_semana"}), @ORM\Index(name="usuario", columns={"email"})})
 * @ORM\Entity
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
     * @var \SemanasReserva
     *
     * @ORM\ManyToOne(targetEntity="SemanasReserva")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_semana", referencedColumnName="id_semana")
     * })
     */
    private $idSemana;

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

    public function getIdSemana(): ?SemanasReserva
    {
        return $this->idSemana;
    }

    public function setIdSemana(?SemanasReserva $idSemana): self
    {
        $this->idSemana = $idSemana;

        return $this;
    }


}
