<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Residencias
 *
 * @ORM\Table(name="residencias", indexes={@ORM\Index(name="id_direccion", columns={"id_direccion"})})
 * @ORM\Entity(repositoryClass="App\Repository\ResidenciasRepository")
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
    protected $idDireccion;

    /**
     * @ORM\OneToMany(targetEntity="SemanasReserva", mappedBy="idResidencia")
     */
    private $reservas;

    /**
     * @ORM\OneToMany(targetEntity="Subastas", mappedBy="idResidencia")
     */
    private $subastas;


    public function __construct()
    {
        $this->reservas = new ArrayCollection();
        $this->subastas = new ArrayCollection();
    }
    /**
     * 
     * @Assert\Type(type="integer")
     */
    public function getCodigoPostal(): ?int
    {
        return $this->idDireccion->getCodigoPostal();
    }
    public function setCodigoPostal(int $codigoPostal): self
    {
        $this->idDireccion->setCodigoPostal($codigoPostal);
        return $this;
    }

    public function getNumero(): ?int
    {  
        return $this->idDireccion->getNumero();
        
    }

    public function setNumero(int $numero =null): self
    {
        $this->idDireccion->setNumero($numero);
        return $this;
        
    }

    public function getCalle(): ?string
    {
        return $this->idDireccion->getCalle();
    }
    public function setCalle(string $calle): self
    {
        $this->idDireccion->setCalle($calle);
        return $this;
    }
    public function getCiudad(): ?string 
    {
        return $this->idDireccion->getCiudad();
    }
    public function setCiudad(string $ciudad): self
    {
        $this->idDireccion->setCiudad($ciudad);
        return $this;
    }
    public function getProvincia(): ?string 
    {
        return $this->idDireccion->getProvincia();
    }
    public function setProvincia(string $provincia): self
    {
        $this->idDireccion->setProvincia($provincia);
        return $this;
    }
    public function getPiso(): ?string 
    {
        return $this->idDireccion->getPiso();
    }
    public function setPiso(int $piso): self
    {
        $this->idDireccion->setPiso($piso);
        return $this;
    }
    public function getDepto(): ?string 
    {
        return $this->idDireccion->getDepto();
    }
    public function setDepto(string $depto): self
    {
        $this->idDireccion->setDepto($depto);
        return $this;
    }


    public function existeSubastaEntreFechas($fecha_inicio, $fecha_fin, $duracion):bool
    {
        foreach ($this->subastas as $subasta) {
            $fecha_fin_subasta = date('Y-m-d',strtotime(($subasta->getFechaInicio()->format('Y-m-d')) . $duracion));
            if($fecha_inicio >= $subasta->getFechaInicio() && $fecha_fin <= $fecha_fin_subasta){
                return true;
            }
        }
        
        return false;
    }

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

    /**
     * @return Collection|SemanasReserva[]
     */
    public function getReservas(): Collection
    {
        return $this->reservas;
    }

    public function addReserva(SemanasReserva $reserva): self
    {
        if (!$this->reservas->contains($reserva)) {
            $this->reservas[] = $reserva;
            $reserva->setIdResidencia($this);
        }

        return $this;
    }

    public function removeReserva(SemanasReserva $reserva): self
    {
        if ($this->reservas->contains($reserva)) {
            $this->reservas->removeElement($reserva);
            // set the owning side to null (unless already changed)
            if ($reserva->getIdResidencia() === $this) {
                $reserva->setIdResidencia(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Subastas[]
     */
    public function getSubastas(): Collection
    {
        return $this->subastas;
    }

    public function addSubasta(Subastas $subasta): self
    {
        if (!$this->subastas->contains($subasta)) {
            $this->subastas[] = $subasta;
            $subasta->setIdResidencia($this);
        }

        return $this;
    }

    public function removeSubasta(Subastas $subasta): self
    {
        if ($this->subastas->contains($subasta)) {
            $this->subastas->removeElement($subasta);
            // set the owning side to null (unless already changed)
            if ($subasta->getIdResidencia() === $this) {
                $subasta->setIdResidencia(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return '('. $this->idResidencia . ') ' . 'Residencia de tipo: ' . $this->tipo . '; habitaciones: ' . $this->habitaciones;
    }

}
