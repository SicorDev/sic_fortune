<?php
namespace SICOR\SicFortune\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Fortune extends AbstractEntity
{
    protected string $text = '';
    protected string $author = '';
    protected string $lang = '';
    protected string $showon = '';

    public function getText(): string
    {
        return $this->text;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function getShowon(): string
    {
        return $this->showon;
    }

    public function setShowon(string $showon): void
    {
        $this->showon = $showon;
    }
}
