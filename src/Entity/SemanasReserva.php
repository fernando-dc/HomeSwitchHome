<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SemanasReserva
 *
 * @ORM\Table(name="semanas_reserva", indexes={@ORM\Index(name="usuario", columns={"email"}), @ORM\Index(name="residencia", columns={"id_residencia"}), @ORM\Index(name="id_hotsale", columns={"id_hotsale"})})
 * @ORM\Entity
 */
class SemanasReserva
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_semana", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSemana;

    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float", precision=10, scale=0, nullable=false)
     */
    private $precio;

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
     * @var \Residencias
     *
     * @ORM\ManyToOne(targetEntity="Residencias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_residencia", referencedColumnName="id_residencia")
     * })
     */
    private $idResidencia;

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
     * @var \Hotsales
     *
     * @ORM\ManyToOne(targetEntity="Hotsales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_hotsale", referencedColumnName="id_hotsale")
     * })
     */
    private $idHotsale;

    public function getIdSemana(): ?int
    {
        return $this->idSemana;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

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

    public function getIdResidencia(): ?Residencias
    {
        return $this->idResidencia;
    }

    public function setIdResidencia(?Residencias $idResidencia): self
    {
        $this->idResidencia = $idResidencia;

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

    public function getIdHotsale(): ?Hotsales
    {
        return $this->idHotsale;
    }

    public function setIdHotsale(?Hotsales $idHotsale): self
    {
        $this->idHotsale = $idHotsale;

        return $this;
    }


}
