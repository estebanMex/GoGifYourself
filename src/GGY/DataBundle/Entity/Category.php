<?php

namespace GGY\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Category
 *
 * @ORM\Table(name="category",uniqueConstraints={@ORM\UniqueConstraint(name="category_title_unique",columns={"title"})})
 * @ORM\Entity(repositoryClass="GGY\DataBundle\Repository\CategoryRepository")
 * @UniqueEntity(fields="title", message="A category with that name already exists")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min=3, minMessage="Category title must at least be 3 characters long")
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="tag_color", type="string", length=7)
     */
    private $tagColor;

    /**
     * @var string
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"title"},separator="-", updatable=true, unique=true)
     */
    private $slug;

    /**
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="GGY\DataBundle\Entity\Gif", mappedBy="categories")
     */
    private $gifs;

    /**
     * @ORM\ManyToMany(targetEntity="GGY\UserBundle\Entity\User", mappedBy="categories")
     */
    private $users;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set tagColor
     *
     * @param string $tagColor
     *
     * @return Category
     */
    public function setTagColor($tagColor)
    {
        $this->tagColor = $tagColor;

        return $this;
    }

    /**
     * Get tagColor
     *
     * @return string
     */
    public function getTagColor()
    {
        return $this->tagColor;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gifs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add gif
     *
     * @param \GGY\DataBundle\Entity\Gif $gif
     *
     * @return Category
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

    /**
     * Add user
     *
     * @param \GGY\UserBundle\Entity\User $user
     *
     * @return Category
     */
    public function addUser(\GGY\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \GGY\UserBundle\Entity\User $user
     */
    public function removeUser(\GGY\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
