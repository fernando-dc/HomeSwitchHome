<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="App\Repository\UsuariosRepository")
 */
class Usuarios
{
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=50, nullable=false)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=20, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=50, nullable=false)
     */
    private $dni;

    /**
     * @var int
     *
     * @ORM\Column(name="creditos", type="integer", nullable=false)
     */
    private $creditos = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="suscripcion", type="string", length=30, nullable=false, options={"default"="standard"})
     */
    private $suscripcion = 'standard';

    /**
     * @ORM\OneToMany(targetEntity="Subastas", mappedBy="email")
     */
    private $subastas;

    /**
     * @ORM\OneToMany(targetEntity="SemanasReserva", mappedBy="idResidencia")
     */
    private $reservas;

    public function __construct()
    {
        $this->subastas = new ArrayCollection();
        $this->reservas = new ArrayCollection();
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getCreditos(): ?int
    {
        return $this->creditos;
    }

    public function setCreditos(int $creditos): self
    {
        $this->creditos = $creditos;

        return $this;
    }

    public function getSuscripcion(): ?string
    {
        return $this->suscripcion;
    }

    public function setSuscripcion(string $suscripcion): self
    {
        $this->suscripcion = $suscripcion;

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
            $subasta->setEmail($this);
        }

        return $this;
    }

    public function removeSubasta(Subastas $subasta): self
    {
        if ($this->subastas->contains($subasta)) {
            $this->subastas->removeElement($subasta);
            // set the owning side to null (unless already changed)
            if ($subasta->getEmail() === $this) {
                $subasta->setEmail(null);
            }
        }

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

    public function restarCredito(){
        $this-> creditos -= 1 ;
        return $this->creditos;
    }
}
