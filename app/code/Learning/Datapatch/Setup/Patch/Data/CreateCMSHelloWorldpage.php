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

class CreateCMSHelloWorldpage implements
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

    const KEY_TITLE  =  'title';
    const KEY_BODY  =  'body';
    const KEY_ID  =  'id';

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
        $pages = [
            [self::KEY_ID => 'test2',self::KEY_TITLE => 'title2', self::KEY_BODY => 'body of title2'],
            [self::KEY_ID => 'test3',self::KEY_TITLE => 'title3', self::KEY_BODY => 'body of title3'],
            [self::KEY_ID => 'test4',self::KEY_TITLE => 'title4', self::KEY_BODY => 'body of title4'],
            [self::KEY_ID => 'test5',self::KEY_TITLE => 'title5', self::KEY_BODY => 'body of title5'],
        ];
        $this->moduleDataSetup->getConnection()->startSetup();

        try {
            foreach ($pages as $page) {
                /** @var PageInterface $page */
                $page = $this->pageInterfaceFactory->create();
                $page->setContent($page[self::KEY_BODY]);
                $page->setIdentifier($page[self::KEY_ID]);
                $page->setTitle($page[self::KEY_TITLE]);
                $this->pageRepository->save($page);
            }
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
