<?php

namespace Rithis\HeroHRBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert,
    Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vacancies")
 */
class Vacancy
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    protected $id;

    /**
     * @ORM\Column(length=140)
     * @Assert\NotBlank
     * @Assert\Length(min=2, max=140)
     */
    protected $title;

    /**
     * @ORM\Column(length=140, unique=true)
     * @Gedmo\Slug(fields={"title"})
     */
    protected $slug;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }
}
