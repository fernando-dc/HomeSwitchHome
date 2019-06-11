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
     * @var string
     *
     * @ORM\Column(name="texto", type="string", length=100, nullable=false)
     */
    private $texto;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;

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


}
