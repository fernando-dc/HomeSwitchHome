<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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


}
