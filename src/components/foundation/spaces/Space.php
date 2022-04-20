<?php
namespace strout\components\founadtion\spaces;

use extas\components\Item;
use extas\components\THasId;
use extas\interfaces\extensions\IExtension;
use strout\interfaces\foundation\contracts\IContract;
use strout\interfaces\foundation\spaces\ISpace;
use extas\interfaces\extensions\IExtensionRepository;

/**
 * @method IExtensionRepository extensions()
 * @method int calculatePayment(IContract $contract, int $operation)
 * @method bool send(IContract $contract, IContract $contract, int $payment)
 * @method IContract getSpaceContract()
 */
class Space extends Item implements ISpace
{
    use THasId;

    public function register(IContract $contract): int
    {
        foreach ($this->getPluginsByStage(static::STAGE__CONTRACT_REGISTRATION) as $plugin) {
            $plugin($contract);
        }

        $payment = $this->calculatePayment($contract, IContract::OPERATION__REGISTRATION);

        $this->send($contract, $this->getSpaceContract(), $payment);

        return $payment;
    }

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
