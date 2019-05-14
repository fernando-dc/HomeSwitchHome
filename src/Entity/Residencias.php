<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Residencias
 *
 * @ORM\Table(name="residencias", indexes={@ORM\Index(name="id_direccion", columns={"id_direccion"})})
 * @ORM\Entity
 */
class Residencias
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_residencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idResidencia;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=20, nullable=false)
     */
    private $tipo;

    /**
     * @var int
     *
     * @ORM\Column(name="habitaciones", type="integer", nullable=false)
     */
    private $habitaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=1000, nullable=false)
     */
    private $descripcion;

    /**
     * @var \Direcciones
     *
     * @ORM\ManyToOne(targetEntity="Direcciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_direccion", referencedColumnName="id_direccion")
     * })
     */
    private $idDireccion;

    /**
     * @ORM\OneToMany(targetEntity="SemanasReserva", mappedBy="idResidencia")
     */
    private $reservas;

    public function getIdResidencia(): ?int
    {
        return $this->idResidencia;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getHabitaciones(): ?int
    {
        return $this->habitaciones;
    }

    public function setHabitaciones(int $habitaciones): self
    {
        $this->habitaciones = $habitaciones;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getIdDireccion(): ?Direcciones
    {
        return $this->idDireccion;
    }

    public function setIdDireccion(?Direcciones $idDireccion): self
    {
        $this->idDireccion = $idDireccion;

        return $this;
    }


}
