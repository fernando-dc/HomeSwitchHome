<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Direcciones
 *
 * @ORM\Table(name="direcciones")
 * @ORM\Entity(repositoryClass="App\Repository\DireccionesRepository")
 */
class Direcciones
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_direccion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDireccion;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_postal", type="integer", nullable=false)
     */
    private $codigoPostal;

    /**
     * @var string
     *
     * @ORM\Column(name="calle", type="string", length=40, nullable=false)
     */
    private $calle;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=40, nullable=false)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="provincia", type="string", length=40, nullable=false)
     */
    private $provincia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="piso", type="string", length=20, nullable=true)
     */
    private $piso;

    /**
     * @var string|null
     *
     * @ORM\Column(name="depto", type="string", length=20, nullable=true)
     */
    private $depto;

    public function getIdDireccion(): ?int
    {
        return $this->idDireccion;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getCodigoPostal(): ?int
    {
        return $this->codigoPostal;
    }

    public function setCodigoPostal(int $codigoPostal): self
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    public function getCalle(): ?string
    {
        return $this->calle;
    }

    public function setCalle(string $calle): self
    {
        $this->calle = $calle;

        return $this;
    }

    public function getCiudad(): ?string
    {
        return $this->ciudad;
    }

    public function setCiudad(string $ciudad): self
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    public function getProvincia(): ?string
    {
        return $this->provincia;
    }

    public function setProvincia(string $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    public function getPiso(): ?string
    {
        return $this->piso;
    }

    public function setPiso(?string $piso): self
    {
        $this->piso = $piso;

        return $this;
    }

    public function getDepto(): ?string
    {
        return $this->depto;
    }

    public function setDepto(?string $depto): self
    {
        $this->depto = $depto;

        return $this;
    }
    public function __toString(): ?string
   {
   
    return 'calle : ' . $this->calle . ',' . $this->numero;
   } 


}
