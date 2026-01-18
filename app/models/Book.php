<?php
namespace app\models;

use DateTime, JsonSerializable;

class Book implements JsonSerializable {
    private int $id;
    private string $title;
    private string $author;
    private int $pages;
    private DateTime $publicationDate;
    private float $price;

    public function __construct($arr) {
        $this->initializeProperties($arr);
    }

    public function initializeProperties($arr): void {
        if ($arr) {
            foreach($arr as $key => $value) {
                switch ($key) {
                    case 'id':
                        $this->id = (int) $value;
                        break;
                    case 'title':
                        $this->title = $value;
                        break;
                    case 'author':
                        $this->author = $value;
                        break;
                    case 'pages':
                        $this->pages = (int) $value;
                        break;
                    case 'publication_date':
                        $this->publicationDate = new DateTime($value);
                        break;
                    case 'price':
                        $this->price = (float) $value;
                        break;
                    default:
                        break;
                }
            }
        }
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getAuthor(): string {
        return $this->author;
    }

    public function setAuthor(string $author): void {
        $this->author = $author;
    }

    public function getPages(): int {
        return $this->pages;
    }

    public function setPages(int $pages): void {
        $this->pages = $pages;
    }

    public function getPublicationDate(): DateTime {
        return $this->publicationDate;
    }

    public function setPublicationDate(DateTime $publicationDate): void {
        $this->publicationDate = $publicationDate;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function setPrice(float $price): void {
        $this->price = $price;
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'pages' => $this->pages,
            'publication_date' => $this->publicationDate,
            'price' => $this->price
            ];
    }

    public function __tostring(): string {
        return "[Title: {$this->title}, Author: {$this->author}, Pages: {$this->pages}, 
        Publication Date: {$this->publicationDate->format("d-m-Y")}, Price: {$this->price}]";
    }
}