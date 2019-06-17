<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fotos
 *
 * @ORM\Table(name="fotos", indexes={@ORM\Index(name="id_residencia", columns={"id_residencia"})})
 * @ORM\Entity(repositoryClass="App\Repository\FotosRepository")
 */
class Fotos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_foto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFoto;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=700, nullable=false)
     */
    private $ruta;

    /**
     * @var \Residencias
     *
     * @ORM\ManyToOne(targetEntity="Residencias", inversedBy="fotos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_residencia", referencedColumnName="id_residencia")
     * })
     */
    private $idResidencia;

    public function getIdFoto(): ?int
    {
        return $this->idFoto;
    }

    public function getRuta(): ?string
    {
        return $this->ruta;
    }

    public function setRuta(string $ruta): self
    {
        $this->ruta = $ruta;

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
