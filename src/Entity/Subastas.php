<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Subastas
 *
 * @ORM\Table(name="subastas", indexes={@ORM\Index(name="token_admin", columns={"token_admin"}), @ORM\Index(name="usuario", columns={"id_usuario"}), @ORM\Index(name="id_residencia", columns={"id_residencia"})})
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_subasta", type="date", nullable=false)
     */
    private $fechaSubasta;

    /**
     * @var int
     *
     * @ORM\Column(name="duracion", type="integer", nullable=false, options={"default"="3"})
     */
    private $duracion = '3';

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
    private $finalizada = '0';

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
     * @var \Residencias
     *
     * @ORM\ManyToOne(targetEntity="Residencias", inversedBy="subastas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_residencia", referencedColumnName="id_residencia")
     * })
     */
    private $idResidencia;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios", inversedBy="subastas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;

    /**
     * @ORM\OneToMany(targetEntity="Pujas", mappedBy="idSubasta")
     */
    private $pujas;

    public function __construct()
    {
        $this->pujas = new ArrayCollection();
    }

    public function getIdSubasta(): ?int
    {
        return $this->idSubasta;
    }

    public function getFechaSubasta(): ?\DateTimeInterface
    {
        return $this->fechaSubasta;
    }

    public function setFechaSubasta(\DateTimeInterface $fechaSubasta): self
    {
        $this->fechaSubasta = $fechaSubasta;

        return $this;
    }

    public function getDuracion(): ?int
    {
        return $this->duracion;
    }

    public function setDuracion(int $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
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
    
    
        /**
         * @return Collection|Pujas[]
         */
        public function getPujas(): Collection
        {
            return $this->pujas;
        }
    
        public function addPuja(Pujas $puja): self
        {
            if (!$this->pujas->contains($puja)) {
                $this->pujas[] = $puja;
                $puja->setIdSubasta($this);
            }
    
            return $this;
        }
    
        public function removePuja(Pujas $puja): self
        {
            if ($this->pujas->contains($puja)) {
                $this->pujas->removeElement($puja);
                // set the owning side to null (unless already changed)
                if ($puja->getIdSubasta() === $this) {
                    $puja->setIdSubasta(null);
                }
            }
    
            return $this;
        }
        
    /**
     * @Assert\Callback
     * 
     * Se asegura que para la fecha de reserva, no haya sido reservada la propiedad
     */
    
    public function validarFechaReserva(ExecutionContextInterface $context, $payload){
        foreach ($this->idResidencia->getReservas() as $reserva) {
            if ($this->fechaInicio >= $reserva->getFechaInicio() && $this->fechaInicio <= $reserva->getFechaFin()) {
                $context->buildViolation('Esa fecha ya fue reservada')
                    -> atPath('fechaInicio')
                    ->addViolation();
            }
        }
    
    }
    
    /**
     * @Assert\Callback
     * 
     * Se asegura que no haya otra subasta para la misma fecha de reserva
     */
    
    public function validarFechaSubastas(ExecutionContextInterface $context, $payload){
        $duracion = '+ 6 days'; //duracion arbitraria de 1 semana (fecha de inicio + 6 dias) para la semana de reserva
        $fecha_fin = date('Y-m-d',strtotime(($this->fechaInicio->format('Y-m-d')) . $duracion));
    
        if ($this->idResidencia->existeSubastaEntreFechas($this->fechaInicio,$fecha_fin,$duracion)) {
            $context->buildViolation('Ya existe una subasta para esa fecha')
                -> atPath('fechaInicio')
                ->addViolation();
        }
    
    }

}
