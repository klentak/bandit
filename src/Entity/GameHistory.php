<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameHistoryRepository")
 */
class GameHistory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json_array")
     */
    private $numbers;
    /**
     * @ORM\Column(type="boolean")
     */
    private $result;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="gameHistories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $reward;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResult(): ?bool
    {
        return $this->result;
    }

    public function setResult(bool $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getNumbers()
    {
        return $this->numbers;
    }

    public function setNumbers($numbers): self
    {
        $this->numbers = $numbers;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

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

    public function getReward(): ?int
    {
        return $this->reward;
    }

    public function setReward(int $reward): self
    {
        $this->reward = $reward;

        return $this;
    }
}
