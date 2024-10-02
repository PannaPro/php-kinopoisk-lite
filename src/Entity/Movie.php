<?php

namespace App\Entity;

class Movie
{
    public function __construct(
        private int $id,
        private ?string $name,
        private ?string $description,
        private ?string $director,
        private ?int $duration,
        private ?array $category,
        private ?string $image = null,
    )
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getDirector(): ?string
    {
        return $this->director;
    }

    /**
     * @param string|null $director
     */
    public function setDirector(?string $director): void
    {
        $this->director = $director;
    }

    /**
     * @return string|null
     */
    public function getDuration(): ?string
    {
        return $this->duration;
    }

    /**
     * @param string|null $duration
     */
    public function setDuration(?string $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return array|null
     */
    public function getCategory(): ?array
    {
        return $this->category;
    }

    /**
     * @param int|null $category
     */
    public function setCategory(?int $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param int|null $image
     */
    public function setImage(?int $image): void
    {
        $this->image = $image;
    }
}