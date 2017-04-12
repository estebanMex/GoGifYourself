<?php

namespace GGY\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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
}
