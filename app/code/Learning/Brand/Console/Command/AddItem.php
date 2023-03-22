<?php
namespace Learning\Brand\Console\Command;

use Learning\Brand\Model\ItemFactory;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddItem extends Command
{
    const INPUT_KEY_NAME = 'brand_name';
    const INPUT_KEY_DESCRIPTION = 'description';

    private ItemFactory $itemFactory;

    public function __construct(ItemFactory $itemFactory)
    {
        $this->itemFactory = $itemFactory;
        parent::__construct('learning:item:add');
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('learning:item:add')->addArgument(self::INPUT_KEY_NAME, InputArgument::REQUIRED, 'Item name');
        $this->setDescription('add item through console');
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $item = $this->itemFactory->create();
        $item->setName($input->getArgument(self::INPUT_KEY_NAME));
        $item->setIsObjectNew(true);
        $item->save();

        return Cli::RETURN_SUCCESS;
    }
}
