<?php

declare(strict_types=1);

namespace Learning\DataPatch\Setup\Patch\Data;

use Magento\Cms\Api\Data\BlockInterface;
use Magento\Cms\Api\Data\BlockInterfaceFactory;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class CreateCMSTestBlock implements
    DataPatchInterface,
    PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $moduleDataSetup;

    private BlockInterfaceFactory $blockInterfaceFactory;
    private BlockRepositoryInterface $blockRepository;

    /**
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param BlockInterfaceFactory $blockInterfaceFactory
     * @param BlockRepositoryInterface $blockRepository
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        BlockInterfaceFactory $blockInterfaceFactory,
        BlockRepositoryInterface $blockRepository
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blockInterfaceFactory = $blockInterfaceFactory;
        $this->blockRepository = $blockRepository;
    }

    /**
     * @inheritdoc
     */
    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        try {
            /** @var BlockInterface $block */
            $block = $this->blockInterfaceFactory->create();
            $block->setTitle('test');
            $block->setContent('content');
            $block->setIdentifier('test');
            $this->blockRepository->save($block);
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
