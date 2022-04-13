<?php
namespace strout\components\founadtion\v1\spaces;

use extas\components\Item;
use extas\interfaces\extensions\IExtension;
use strout\interfaces\foundation\v1\contracts\IContract;
use strout\interfaces\foundation\v1\spaces\ISpace;
use extas\interfaces\extensions\IExtensionRepository;

/**
 * @method IExtensionRepository extensions
 */
class Space extends Item implements ISpace
{
    public function register(IContract $contract): int
    {
        $this->extensions()->create([
            IExtension::FIELD__CLASS => '',
            IExtension::FIELD__INTERFACE => '',
            IExtension::FIELD__SUBJECT => 'strout.contract.' . $contract->getName(),
            IExtension::FIELD__PARAMETERS => []
        ]);

        $payment = $this->calculatePayment($contract, 'register');

        $this->send($contract, $this, $payment);

        return $payment;
    }

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
