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
     * @ORM\OneToMany(targetEntity="GGY\DataBundle\Entity\Gif", mappedBy="user")
     */
    private $gifs;

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

    /**
     * Add gif
     *
     * @param \GGY\DataBundle\Entity\Gif $gif
     *
     * @return User
     */
    public function addGif(\GGY\DataBundle\Entity\Gif $gif)
    {
        $this->gifs[] = $gif;

        return $this;
    }

    /**
     * Remove gif
     *
     * @param \GGY\DataBundle\Entity\Gif $gif
     */
    public function removeGif(\GGY\DataBundle\Entity\Gif $gif)
    {
        $this->gifs->removeElement($gif);
    }

    /**
     * Get gifs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGifs()
    {
        return $this->gifs;
    }
}
