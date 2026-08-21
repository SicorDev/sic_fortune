<?php
namespace SICOR\SicFortune\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class FortuneFileService
{
    public function getRandomFortune(string $filePath): ?array
    {
        $entries = $this->loadEntries($filePath);
        if ($entries === null) {
            return null;
        }

        return $this->parseEntry(trim($entries[random_int(0, count($entries) - 1)]));
    }

    public function getDailyFortune(string $filePath): ?array
    {
        $entries = $this->loadEntries($filePath);
        if ($entries === null) {
            return null;
        }

        // Deterministic: same file + same date → same index, no DB or cache needed
        $index = abs(crc32(date('Y-m-d') . $filePath)) % count($entries);

        return $this->parseEntry(trim($entries[$index]));
    }

    private function loadEntries(string $filePath): ?array
    {
        $resolvedPath = GeneralUtility::getFileAbsFileName($filePath);
        if ($resolvedPath === '' || !is_readable($resolvedPath)) {
            return null;
        }

        $content = file_get_contents($resolvedPath);
        if ($content === false || $content === '') {
            return null;
        }

        $entries = preg_split('/\n%\n/', $content, -1, PREG_SPLIT_NO_EMPTY);

        return empty($entries) ? null : $entries;
    }

    private function parseEntry(string $entry): array
    {
        if (preg_match('/^(.*?)\n--\s*(.+)$/s', $entry, $matches)) {
            return [
                'text' => trim($matches[1]),
                'author' => trim($matches[2]),
                'lang' => 'xx',
            ];
        }

        return [
            'text' => $entry,
            'author' => '',
            'lang' => 'xx',
        ];
    }
}
