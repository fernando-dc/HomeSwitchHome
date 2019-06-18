<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Tarjetas
 *
 * @ORM\Table(name="tarjetas", indexes={@ORM\Index(name="id_usuario", columns={"id_usuario"})})
 * @ORM\Entity(repositoryClass="App\Repository\TarjetasRepository")
 */
class Tarjetas
{
    /**
     * @var string
     *
     * @ORM\Column(name="numero_tarjeta", type="string", length=16, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @Assert\Length(16)
     */
    private $numeroTarjeta;

    /**
     * @var int
     *
     * @ORM\Column(name="codigo", type="integer", nullable=false)
     * @Assert\Length(4)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="vencimiento", type="string", length=4, nullable=false)
     */
    private $vencimiento;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;

    public function setNumeroTarjeta(string $numeroTarjeta): self
    {
        $this->numeroTarjeta = $numeroTarjeta;

        return $this;
    }

    public function getNumeroTarjeta(): ?string
    {
        return $this->numeroTarjeta;
    }

    public function getCodigo(): ?int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getVencimiento(): ?string
    {
        return $this->vencimiento;
    }

    public function setVencimiento(string $vencimiento): self
    {
        $this->vencimiento = $vencimiento;

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
     * @Assert\Callback
     * Checkea que el vencimiento no sea menor al mes y año actual
     */
    public function validarVencimiento(ExecutionContextInterface $context, $payload){
        $vencimiento = str_split($this->vencimiento);
        $month = $vencimiento[0]*10 + $vencimiento[1];
        $year = $vencimiento[2]*10 + $vencimiento[3];
        //Si el anio de vencimiento es menor al anio actual, la tarjeta ya esta vencida
        if($year < date('y')){
            $context->buildViolation('La tarjeta esta vencida')
            -> atPath('vencimiento')
            ->addViolation();
        } elseif ($year = date('y')) {
            //Pero si el anio es igual, esta vencida solo si el mes del vencimiento es menor al mes actual
            if ($month < date('m')) {
                $context->buildViolation('La tarjeta esta vencida')
                -> atPath('vencimiento')
                ->addViolation();
        
            }
        }
    }
}
