<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Hotsales
 *
 * @ORM\Table(name="hotsales", uniqueConstraints={@ORM\UniqueConstraint(name="id_semana", columns={"id_semana"})})
 * @ORM\Entity(repositoryClass="App\Repository\HotsalesRepository")
 */
class Hotsales
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_hotsale", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHotsale;

    /**
     * @var \SemanasReserva
     *
     * @ORM\ManyToOne(targetEntity="SemanasReserva")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_semana", referencedColumnName="id_semana")
     * })
     */
    private $idSemana;

    public function getIdHotsale(): ?int
    {
        return $this->idHotsale;
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

        /**
     * @Assert\Callback
     * 
     * Se asegura que para la fecha de hotsale, no haya sido reservada la propiedad
     */
    
    public function validarFechaReserva(ExecutionContextInterface $context, $payload){
        foreach ($this->getIdSemana()->getidResidencia()->getReservas() as $reserva) {
            if ($this->getIdSemana()->getFechaInicio() >= $reserva->getFechaInicio() && $this->getIdSemana()->getfechaInicio() <= $reserva->getFechaFin()) {
                $context->buildViolation('Esa fecha ya fue reservada')
                    -> atPath('fechaInicio')
                    ->addViolation();
            }
        }
    
    }
    
    /**
     * @Assert\Callback
     * 
     * Se asegura que no haya una subasta para la misma fecha de hotsale
     */
    
    public function validarFechaSubastas(ExecutionContextInterface $context, $payload){
        $duracion = '+ 6 days'; //duracion arbitraria de 1 semana (fecha de inicio + 6 dias) para la semana de reserva
        $fecha_fin = date('Y-m-d',strtotime(($this->getIdSemana()->getfechaInicio()->format('Y-m-d')) . $duracion));
    
        if ($this->getidSemana()->getidResidencia()->existeSubastaEntreFechas($this->getIdSemana()->getfechaInicio(),$fecha_fin,$duracion)) {
            $context->buildViolation('Existe una subasta para esa fecha')
                -> atPath('fechaInicio')
                ->addViolation();
        }
    
    }

}
