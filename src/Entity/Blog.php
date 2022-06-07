<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
class Blog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 25000)]
    private $content;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'blogs')]
    #[ORM\JoinColumn(nullable: false)]
    private $author;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $articleImageSmall;

    #[ORM\Column(type: 'string', length: 255)]
    private $articleImageBig;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString() {
        return $this->author;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getArticleImageSmall(): ?string
    {
        return $this->articleImageSmall;
    }

    public function getArticleImageSmallUrl(): ?string
    {
        if (!$this->avatar) {
            return null;
        }

        if (strpos($this->articleImageSmall, '/') !== false)
        {
            return $this->articleImageSmall;
        }

        return sprintf('/uploads/blogImages/%s', $this->articleImageSmall);
    }

    public function setArticleImageSmall(?string $articleImageSmall): self
    {
        $this->articleImageSmall = $articleImageSmall;

        return $this;
    }

    public function getArticleImageBig(): ?string
    {
        return $this->articleImageBig;
    }

    public function setArticleImageBig(string $articleImageBig): self
    {
        $this->articleImageBig = $articleImageBig;

        return $this;
    }

    public function getArticleImageBigUrl(): ?string
    {
        if (!$this->articleImageBig) {
            return null;
        }

        if (strpos($this->articleImageBig, '/') !== false)
        {
            return $this->articleImageBig;
        }

        return sprintf('/uploads/blogImages/%s', $this->articleImageBig);
    }
}
