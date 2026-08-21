<?php
namespace SICOR\SicFortune\Domain\Repository;

use SICOR\SicFortune\Domain\Model\Fortune;
use TYPO3\CMS\Extbase\Persistence\Repository;

class FortuneRepository extends Repository
{
    public function findForToday(string $date): ?Fortune
    {
        $query = $this->createQuery();
        $query->matching($query->equals('showon', $date));
        $query->setLimit(1);
        return $query->execute()->getFirst();
    }

    public function findFreeQuote(): ?Fortune
    {
        $query = $this->createQuery();
        $query->matching($query->equals('showon', ''));
        $total = $query->execute()->count();
        if ($total === 0) {
            return null;
        }
        $query->setOffset(random_int(0, $total - 1));
        $query->setLimit(1);
        return $query->execute()->getFirst();
    }

    public function findRandom(): ?Fortune
    {
        $query = $this->createQuery();
        $total = $query->execute()->count();
        if ($total === 0) {
            return null;
        }
        $query->setOffset(random_int(0, $total - 1));
        $query->setLimit(1);
        return $query->execute()->getFirst();
    }
}
