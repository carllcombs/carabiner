<?php

namespace Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="\Repositories\UserRepository")
 */
class User
{
	/**
	 * @ORM\Id()
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=32)
	 */
	private $name;


	/**
     * Gets the value of id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Sets the value of name.
     *
     * @param string $name the name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}

// <?php

// namespace Entity;

// use Doctrine\ORM\Mapping as ORM;

// /**
//  * User
//  *
//  * @ORM\Table(name="users")
//  * @ORM\Entity(repositoryClass="\Repository\UserRepository")
//  */

// class User
// {
//     /**
//      * @ORM\Column(name="alt_id", type="integer", options={"unsigned"=true})
//      * @ORM\Id()
//      */
//     private $altId;

//     /**
//      * @ORM\Column(name="referral_code", type="string", length=24, nullable=true)
//      */
//     private $referralCode;

//     /**
//      * @var integer
//      */
//     private $organisation;

//     /**
//      * @var string
//      */
//     private $timeZone;

//     /**
//      * @var string
//      */
//     private $email;

//     /**
//      * @var string
//      */
//     private $password;

//     /**
//      * @var string
//      */
//     private $firstName;

//     /**
//      * @var string
//      */
//     private $lastName;

//     /**
//      * @var \Entity\Role
//      * 
//      * @ORM\ManyToMany(targetEntity="\Entity\Role", inversedBy="users", cascade={"persist","remove"})
//      * @ORM\JoinTable(name="user_role",
//      *  joinColumns={@ORM\JoinColumn(name="user", referencedColumnName="alt_id", onDelete="CASCADE")},
//      *  inverseJoinColumns={@ORM\JoinColumn(name="role", referencedColumnName="id")}
//      * )
//      */
//     private $roles;

//     /**
//      * @var \Entity\Agreement
//      *
//      * @ORM\ManyToMany(targetEntity="\Entity\Agreement")
//      * @ORM\JoinTable(name="user_agreement",
//      *  joinColumns={@ORM\JoinColumn(name="user", referencedColumnName="alt_id")},
//      *  inverseJoinColumns={
//      *    @ORM\JoinColumn(name="agreement", referencedColumnName="id"),
//      *    @ORM\JoinColumn(name="version", referencedColumnName="version")
//      *  }
//      * )
//      */
//     private $agreement;

//     /**
//      * __toString
//      */
//     public function __toString()
//     {
//         return strval($this->altId);
//     }

//     /**
//      * Gets the value of altId.
//      *
//      * @return mixed
//      */
//     public function getAltId()
//     {
//         return $this->altId;
//     }
    
//     /**
//      * Sets the value of altId.
//      *
//      * @param mixed $altId the alt id
//      *
//      * @return self
//      */
//     public function setAltId($altId)
//     {
//         $this->altId = $altId;

//         return $this;
//     }

//     /**
//      * Gets the value of referralCode.
//      *
//      * @return mixed
//      */
//     public function getReferralCode()
//     {
//         return $this->referralCode;
//     }
    
//     /**
//      * Sets the value of referralCode.
//      *
//      * @param mixed $referralCode the referral code
//      *
//      * @return self
//      */
//     public function setReferralCode($referralCode)
//     {
//         $this->referralCode = $referralCode;

//         return $this;
//     }

//     /**
//      * Gets the value of organisation.
//      *
//      * @return integer
//      */
//     public function getOrganisation()
//     {
//         return $this->organisation;
//     }
    
//     /**
//      * Sets the value of organisation.
//      *
//      * @param integer $organisation the organisation
//      *
//      * @return self
//      */
//     public function setOrganisation($organisation)
//     {
//         $this->organisation = $organisation;

//         return $this;
//     }

//     /**
//      * Gets the value of timeZone.
//      *
//      * @return string
//      */
//     public function getTimeZone()
//     {
//         //return new \DateTimeZone($this->timeZone);
//         return $this->timeZone;
//     }
    
//     /**
//      * Sets the value of timeZone.
//      *
//      * @param string $timeZone the time zone
//      *
//      * @return self
//      */
//     public function setTimeZone($timeZone)
//     {
//         $this->timeZone = $timeZone;

//         return $this;
//     }

//     /**
//      * Gets the value of email.
//      *
//      * @return mixed
//      */
//     public function getEmail()
//     {
//         return $this->email;
//     }
    
//     /**
//      * Sets the value of email.
//      *
//      * @param mixed $email the email
//      *
//      * @return self
//      */
//     public function setEmail($email)
//     {
//         $this->email = $email;

//         return $this;
//     }

//     /**
//      * Gets the value of password.
//      *
//      * @return mixed
//      */
//     public function getPassword()
//     {
//         return $this->password;
//     }
    
//     /**
//      * Sets the value of password.
//      *
//      * @param mixed $password the password
//      *
//      * @return self
//      */
//     public function setPassword($password)
//     {
//         $this->password = $password;

//         return $this;
//     }

//     /**
//      * Gets the value of firstName.
//      *
//      * @return mixed
//      */
//     public function getFirstName()
//     {
//         return $this->firstName;
//     }
    
//     /**
//      * Sets the value of firstName.
//      *
//      * @param mixed $firstName the first name
//      *
//      * @return self
//      */
//     public function setFirstName($firstName)
//     {
//         $this->firstName = $firstName;

//         return $this;
//     }

//     /**
//      * Gets the value of lastName.
//      *
//      * @return mixed
//      */
//     public function getLastName()
//     {
//         return $this->lastName;
//     }
    
//     /**
//      * Sets the value of lastName.
//      *
//      * @param mixed $lastName the last name
//      *
//      * @return self
//      */
//     public function setLastName($lastName)
//     {
//         $this->lastName = $lastName;

//         return $this;
//     }

//     /**
//      * @inheritDoc
//      */
//     public function getRoles()
//     {
//         return $this->roles->toArray();
//     }

//     /**
//      * Add roles
//      *
//      * @param \Entity\Role $role
//      * @return User
//      */
//     public function addRole(\Entity\Role $role)
//     {
//         $this->roles[] = $role;
    
//         return $this;
//     }

//     /**
//      * Remove roles
//      *
//      * @param \Entity\Role $role
//      */
//     public function removeRole(\Entity\Role $role)
//     {
//         $this->roles->removeElement($role);
//     }

//     /**
//      * @inheritDoc
//      */
//     public function getAgreement()
//     {
//         return $this->agreement->toArray();
//     }

//     /**
//      * Clear all roles
//      */
//     public function clearRoles()
//     {
//         $this->roles = array();
//     }

//     /**
//      * Add agreement
//      *
//      * @param \Entity\Agreement $agreement
//      * @return User
//      */
//     public function addAgreement(\Entity\Agreement $agreement)
//     {
//         $this->agreement[] = $agreement;
    
//         return $this;
//     }

//     /**
//      * Remove agreement
//      *
//      * @param \Entity\Agreement $agreement
//      */
//     public function removeAgreement(\Entity\Agreement $agreement)
//     {
//         $this->agreement->removeElement($agreement);
//     }
// 
    
// }
