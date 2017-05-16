<?php

namespace GGY\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Tag
 *
 * @ORM\Table(name="tag",uniqueConstraints={@ORM\UniqueConstraint(name="tag_title_unique",columns={"title"})})
 * @ORM\Entity(repositoryClass="GGY\DataBundle\Repository\TagRepository")
 * @UniqueEntity(fields="title", message="A tag with that name already exists")
 */
class Tag
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
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min=3, minMessage="Tag title must at least be 3 characters long")
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
     * @ORM\ManyToMany(targetEntity="GGY\DataBundle\Entity\Gif", mappedBy="tags")
     */
    private $gifs;


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
     * @return Tag
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
     * @return Tag
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
     * @return Tag
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
     * @return Tag
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
