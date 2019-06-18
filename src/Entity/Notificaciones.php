<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notificaciones
 *
 * @ORM\Table(name="notificaciones", indexes={@ORM\Index(name="id_usuario", columns={"id_usuario"})})
 * @ORM\Entity(repositoryClass="App\Repository\NotificacionesRepository")
 */
class Notificaciones
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_notificacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNotificacion;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;

    /**
     * @var \Residencias
     *
     * @ORM\ManyToOne(targetEntity="Residencias", inversedBy="subastas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_residencia", referencedColumnName="id_residencia")
     * })
     */
    private $idResidencia;

    /**
     * @var \Subastas
     *
     * @ORM\ManyToOne(targetEntity="Subastas", inversedBy="pujas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_subasta", referencedColumnName="id_subasta")
     * })
     */
    private $idSubasta;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="string", length=100, nullable=false)
     */
    private $texto;

    

    public function getIdNotificacion(): ?int
    {
        return $this->idNotificacion;
    }

    public function getTexto(): ?string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): self
    {
        $this->texto = $texto;

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
    public function getIdResidencia(): ?Residencias
    {
        return $this->idResidencia;
    }

    public function setIdResidencia(?Residencias $idResidencia): self
    {
        $this->idResidencia = $idResidencia;

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
    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }


}
