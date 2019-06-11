<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Suscripciones
 *
 * @ORM\Table(name="suscripciones")
 * @ORM\Entity(repositoryClass="App\Repository\SuscripcionesRepository")
 */
class Suscripciones
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=70, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nombre;

    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float", precision=10, scale=0, nullable=false)
     */
    private $precio;

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }


}
