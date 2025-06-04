<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business;

use Pyz\Zed\Antelope\Business\Antelope\Deleter\AntelopeDeleter;
use Pyz\Zed\Antelope\Business\Antelope\Deleter\AntelopeDeleterInterface;
use Pyz\Zed\Antelope\Business\Antelope\Reader\AntelopeReader;
use Pyz\Zed\Antelope\Business\Antelope\Updater\AntelopeUpdater;
use Pyz\Zed\Antelope\Business\Antelope\Updater\AntelopeUpdaterInterface;
use Pyz\Zed\Antelope\Business\Antelope\Writer\AntelopeWriter;
use Pyz\Zed\Antelope\Business\AntelopeLocation\Deleter\AntelopeLocationDeleter;
use Pyz\Zed\Antelope\Business\AntelopeLocation\Reader\AntelopeLocationReader;
use Pyz\Zed\Antelope\Business\AntelopeLocation\Updater\AntelopeLocationUpdater;
use Pyz\Zed\Antelope\Business\AntelopeLocation\Writer\AntelopeLocationWriter;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Antelope\Business\AntelopeRepositoryInterface getRepository()
 */
class AntelopeBusinessFactory extends AbstractBusinessFactory
{
    public function createAntelopeWriter(): AntelopeWriter
    {
        return new AntelopeWriter($this->getEntityManager());
    }

    public function createAntelopeLocationWriter(): AntelopeLocationWriter
    {
        return new AntelopeLocationWriter($this->getEntityManager());
    }

    public function createAntelopeReader(): AntelopeReader
    {
        return new AntelopeReader($this->getRepository());
    }

    public function createAntelopeLocationReader(): AntelopeLocationReader
    {
        return new AntelopeLocationReader($this->getRepository());
    }

    public function createAntelopeLocationDeleter(): AntelopeLocationDeleter
    {
        return new AntelopeLocationDeleter($this->getEntityManager());
    }

    public function createAntelopeLocationUpdater(): AntelopeLocationUpdater
    {
        return new AntelopeLocationUpdater($this->getEntityManager());
    }
}
