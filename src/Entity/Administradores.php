<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Administradores
 *
 * @ORM\Table(name="administradores", indexes={@ORM\Index(name="id_usuario", columns={"id_usuario"})})
 * @ORM\Entity(repositoryClass="App\Repository\AdministradoresRepository")
 */
class Administradores implements UserInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $token;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(int $token): self
    {
        $this->token = $token;

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

    
    public function getSalt()
    {
        // podrías necesitar un verdadero salt dependiendo del encoder
        // ver la sección salt debajo
        return null;
    }

    public function getPassword()
    {
        //return $this->password;
    }

    public function getRoles()
    {
        return array('ROLE_ADMIN');
    }
    public function eraseCredentials()
    {
    }
    public function getUsername()
    {
       // return $this->username;
    }
    
}
