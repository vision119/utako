<?php

namespace App\Entity\System;

use App\Repository\System\FileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: FileRepository::class)]
#[ORM\Table(name: 'system_file')]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $directory = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $format = null;

    public function __construct(){
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
        $this->active = 0;
    }

    public function __toString(){
        return $this->filename;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDirectory(): ?string
    {
        return $this->directory;
    }

    public function setDirectory(string $directory): static
    {
        $this->directory = $directory;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): static
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): static
    {
        $this->updated = $updated;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): static
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Uploads the file.
     * @param UploadedFile $file
     * 
     * @return string
     */
    public function upload(UploadedFile $file) {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = md5($originalFilename . '-' . uniqid() . '.' . $file->guessExtension()).'.'.$file->getClientOriginalExtension();
        try {
            $file->move($this->getDirectory(), $fileName);
        } catch (Exception $e) {
            // ... handle exception if something happens during file upload
        }
        return $fileName;
    }
     
    /**
     * Returns the web path of the file.
     * 
     * @return string
     */
    public function getWebPath() {
        return $this->directory . '/' . $this->filename;
    }
}
