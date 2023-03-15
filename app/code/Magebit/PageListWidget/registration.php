<?php

/**
 * Magebit_PageListWidget
 *
 * @category     Magebit
 * @package      Magebit_PageListWidget
 * @author       Artjoms Fomins <info@magebit.com>
 * @copyright    Copyright (c) 2023 Magebit, Ltd.(https://www.magebit.com/)
 */

declare(strict_types=1);

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Magebit_PageListWidget',
    __DIR__
);
