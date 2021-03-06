<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SemanasReserva
 *
 * @ORM\Table(name="semanas_reserva", indexes={@ORM\Index(name="residencia", columns={"id_residencia"}), @ORM\Index(name="id_usuario", columns={"id_usuario"})})
 * @ORM\Entity(repositoryClass="App\Repository\SemanasReservaRepository")
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
     * @ORM\ManyToOne(targetEntity="Residencias",inversedBy="reservas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_residencia", referencedColumnName="id_residencia")
     * })
     */
    private $idResidencia;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios", inversedBy="reservas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;

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

    public function getIdUsuario(): ?Usuarios
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?Usuarios $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }


}
