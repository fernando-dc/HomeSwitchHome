<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})}, indexes={@ORM\Index(name="suscripcion", columns={"suscripcion"})})
 * @ORM\Entity(repositoryClass="App\Repository\UsuariosRepository")
 */
class Usuarios implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_usuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40, nullable=false)
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_registro", type="date", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var \Suscripciones
     *
     * @ORM\ManyToOne(targetEntity="Suscripciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="suscripcion", referencedColumnName="nombre")
     * })
     */
    private $suscripcion;

    /**
     * @ORM\OneToMany(targetEntity="Subastas", mappedBy="idUsuario")
     */
    private $subastas;

    /**
     * @ORM\OneToMany(targetEntity="SemanasReserva", mappedBy="idUsuario")
     */
    private $reservas;

    public function __construct()
    {
        $this->subastas = new ArrayCollection();
        $this->reservas = new ArrayCollection();
    }

    public function getIdUsuario(): ?int
    {
        return $this->idUsuario;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
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

    public function getFechaRegistro(): ?\DateTimeInterface
    {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro(?\DateTimeInterface $fechaRegistro): self
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    public function getSuscripcion(): ?Suscripciones
    {
        return $this->suscripcion;
    }

    public function setSuscripcion(?Suscripciones $suscripcion): self
    {
        $this->suscripcion = $suscripcion;

        return $this;
    }

    public function restarCredito(){
        $this->creditos -= 1 ;
        return $this->creditos;
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
            array_push($subastas, $subasta);
            //$this->subastas[] = $subasta;
            $subasta->setIdUsuario($this);
        }

        return $this;
    }

    public function removeSubasta(Subastas $subasta): self
    {
        if ($this->subastas->contains($subasta)) {
            $this->subastas->removeElement($subasta);
            // set the owning side to null (unless already changed)
            if ($subasta->getIdUsuario() === $this) {
                $subasta->setIdUsuario(null);
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
            array_push($reservas, $reserva);
            //$this->reservas[] = $reserva;
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





    public function getSalt()
    {
        // podrías necesitar un verdadero salt dependiendo del encoder
        // ver la sección salt debajo
        return null;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }
    public function eraseCredentials()
    {
    }
    public function getUsername()
    {
       // return $this->username;
    }


    public function getNumeroTarjeta(){

    }
}
