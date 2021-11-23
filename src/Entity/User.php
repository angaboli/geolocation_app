<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Annotations\Annotation\Enum;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    const SEXE =[
        0 => 'Homme',
        1 => 'Femme'
    ];

    const SECTEUR = [
        0 => 'Agriculture',
        1 => 'Architecture - Paysage - Urbanisme',
        2 => 'Armée -Securité',
        3 => 'Art - Artisanat - Culture',
        4 => 'Assurance -Banque',
        5 => 'Audiovisuel - Information - Communication',
        6 => 'Construction durable - Bâtiment et Traveaux Publics' ,
        7 => 'Droit - Economie - Gestion' ,
        8 => 'Enseignement - Recherche',
        9 => 'Energies - Environnement',
        10 => 'Gestion Administrative- Transport - Logistique',
        11 => 'Hôtellerie - Restauration - Tourisme' ,
        12 => 'Industries',
        13 => 'Informatique - Internet',
        14 => 'Relation client (Accueil, Commerce, Vente)' ,
        15 => 'Sante - Social - Sport'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     *
     * @ORM\Column(type="integer")
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;


    /**
     * A non-persisted field that's used to create the encoded password.
     *
     * @var string
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     *
     * @ORM\Column( type="string")
     */
    private $dateDeNaissance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $metier;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
         $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getGenre(): ?int
    {
        return $this->genre;
    }

    public function setGenre(int $sexe): self
    {
        $this->genre = $sexe;

        return $this;
    }

    public function getSexe(): string
    {
        return self::SEXE[$this->genre];
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }



    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        // forces the object to look "dirty" to Doctrine. Avoids
        // Doctrine *not* saving this entity, if only plainPassword changes
        $this->password = null;
    }

    public function getDateDeNaissance(): ?string
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(string $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    public function getMetier(): ?int
    {
        return $this->metier;
    }

    public function setMetier(int $metier): self
    {
        $this->metier = $metier;

        return $this;
    }

    public function getSecteur(): string
    {
        return self::SECTEUR[$this->metier];
    }

    public function getGenderChoices()
    {
        $choices = User::SEXE;
        $output = [];
        foreach ($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }

    public function getMetierChoices()
    {
        $choices = User::SECTEUR;
        $output = [];
        foreach ($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }
}
