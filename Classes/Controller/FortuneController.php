<?php
namespace SICOR\SicFortune\Controller;

use Psr\Http\Message\ResponseInterface;
use SICOR\SicFortune\Domain\Model\Fortune;
use SICOR\SicFortune\Domain\Repository\FortuneRepository;
use SICOR\SicFortune\Service\FortuneFileService;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class FortuneController extends ActionController
{
    private const BUNDLED_FORTUNE_FILE = 'EXT:sic_fortune/Resources/Private/Fortunes/de_quotes';

    public function __construct(
        private readonly FortuneRepository $fortuneRepository,
        private readonly FortuneFileService $fortuneFileService,
        private readonly FileRepository $fileRepository,
    ) {
    }

    public function showAction(): ResponseInterface
    {
        $source = $this->settings['source'] ?? 'db';
        $mode = $this->settings['mode'] ?? 'random';
        $contentData = $this->request->getAttribute('currentContentObject')?->data ?? [];
        $contentUid = (int)($contentData['uid'] ?? 0);

        if ($source === 'file') {
            // Custom path overrides the dropdown selection; both fall back to bundled file
            $file = ($this->settings['customFile'] ?? '') ?: ($this->settings['file'] ?? '') ?: self::BUNDLED_FORTUNE_FILE;
            $fortune = $mode === 'daily'
                ? $this->fortuneFileService->getDailyFortune($file)
                : $this->fortuneFileService->getRandomFortune($file);
        } else {
            // Storage PID is set via tt_content.pages (Datensatzsammlung) – Extbase picks it up automatically
            $fortune = $mode === 'daily'
                ? $this->getDailyFortune()
                : $this->fortuneRepository->findRandom();

            // Empty DB → use bundled fortune file as zero-setup default
            if ($fortune === null) {
                $fortune = $this->fortuneFileService->getRandomFortune(self::BUNDLED_FORTUNE_FILE);
            }
        }

        $this->view->assign('fortune', $fortune);
        $this->view->assign('settings', $this->settings);
        $this->view->assign('data', $contentData);
        $this->view->assign('backgroundImage', $this->resolveBackgroundImage($mode, $contentUid));

        return $this->htmlResponse();
    }

    private function resolveBackgroundImage(string $mode, int $contentUid): ?FileReference
    {
        if ($contentUid === 0) {
            return null;
        }
        $images = $this->fileRepository->findByRelation('tt_content', 'image', $contentUid);
        if (empty($images)) {
            return null;
        }
        $index = $mode === 'daily'
            ? abs(crc32(date('Y-m-d') . $contentUid)) % count($images)
            : random_int(0, count($images) - 1);
        return $images[$index];
    }

    private function getDailyFortune(): ?Fortune
    {
        $today = date('Y-m-d');
        $fortune = $this->fortuneRepository->findForToday($today);

        if ($fortune === null) {
            $fortune = $this->fortuneRepository->findFreeQuote();
            if ($fortune !== null) {
                $fortune->setShowon($today);
                $this->fortuneRepository->update($fortune);
            } else {
                // All quotes assigned – fall back to fully random to avoid empty output
                $fortune = $this->fortuneRepository->findRandom();
            }
        }

        return $fortune;
    }
}
