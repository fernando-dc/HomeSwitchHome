<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Tarjetas
 *
 * @ORM\Table(name="tarjetas", indexes={@ORM\Index(name="id_usuario", columns={"id_usuario"})})
 * @ORM\Entity(repositoryClass="App\Repository\TarjetasRepository")
 * @UniqueEntity(
 *          fields={"numeroTarjeta"},
 *          message="tarjeta.numero.duplicado",
 *          errorPath="numeroTarjeta",
 * 
 * )
 * @Assert\GroupSequence({"Tarjetas", "Callbacks"})
 */
class Tarjetas
{
    /**
     * @var string
     *
     * @ORM\Column(name="numero_tarjeta", type="string", length=16, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @Assert\Length(16, exactMessage="tarjeta.digitos")
     */
    private $numeroTarjeta;

    /**
     * @var int
     *
     * @ORM\Column(name="codigo", type="integer", nullable=false)
     * @Assert\Length(4, exactMessage="tarjeta.codigo.digitos")
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="vencimiento", type="string", length=4, nullable=false)
     * @Assert\Length(4, exactMessage="tarjeta.vencimiento.digitos")
     */
    private $vencimiento;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     * 
     * Este assert permite que se validen los datos de usuario en el formulario de registro/edicion
     * @Assert\Valid()
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
     * @Assert\Callback(groups={"Callbacks"})
     * Checkea que el vencimiento no sea menor al mes y año actual
     */
    public function validarVencimiento(ExecutionContextInterface $context, $payload){
        $vencimiento = str_split($this->vencimiento);
        $month = $vencimiento[0]*10 + $vencimiento[1];
        $year = $vencimiento[2]*10 + $vencimiento[3];

        //Si el anio de vencimiento es menor al anio actual, la tarjeta ya esta vencida
        if(!($month < 1 || $month > 12)){
            if($year < date('y')){
                $context->buildViolation('La tarjeta esta vencida')
                -> atPath('vencimiento')
                ->addViolation();
            } elseif ($year == date('y')) {
                //Pero si el anio es igual, esta vencida solo si el mes del vencimiento es menor al mes actual
                if ($month < date('m')) {
                    $context->buildViolation('La tarjeta esta vencida')
                    -> atPath('vencimiento')
                    ->addViolation();
            
                }
            }
        } else {
            $context->buildViolation('El mes de vencimiento es invalido')
                    -> atPath('vencimiento')
                    ->addViolation();
        }
        
    }
}
