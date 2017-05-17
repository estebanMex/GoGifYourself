<?php

namespace GGY\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="GGY\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="GGY\DataBundle\Entity\Category", inversedBy="users")
     * @ORM\JoinTable(name="users_categories")
     */
    private $categories;

    /**
     * Add category
     *
     * @param \GGY\DataBundle\Entity\Category $category
     *
     * @return User
     */
    public function addCategory(\GGY\DataBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \GGY\DataBundle\Entity\Category $category
     */
    public function removeCategory(\GGY\DataBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
