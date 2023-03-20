<?php

declare(strict_types=1);

namespace Learning\DataPatch\Setup\Patch\Data;

use Magento\Cms\Api\Data\PageInterface;
use Magento\Cms\Api\Data\PageInterfaceFactory;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class CreateCMSTestPage implements
    DataPatchInterface,
    PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $moduleDataSetup;

    /**
     * @var PageRepositoryInterface
     */
    private PageRepositoryInterface $pageRepo;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PageRepositoryInterface $pageRepository
     * @param PageInterfaceFactory $pageInterfaceFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PageRepositoryInterface $pageRepository,
        PageInterfaceFactory $pageInterfaceFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->pageRepository = $pageRepository;
        $this->pageInterfaceFactory = $pageInterfaceFactory;
    }

    /**
     * @inheritdoc
     */
    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        try {
            /** @var PageInterface $page */
            $page = $this->pageInterfaceFactory->create();
            $page->setContent('test content')->setIdentifier('test')->setTitle('test tile');
            $this->pageRepository->save($page);
        } catch (LocalizedException $e) {
            echo $e->getMessage();
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies(): array
    {
        return  [];
    }

    /**
     * @inheritdoc
     */
    public function revert(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }
}
