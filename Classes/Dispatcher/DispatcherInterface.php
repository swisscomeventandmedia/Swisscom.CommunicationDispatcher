<?php

namespace Swisscom\CommunicationDispatcher\Dispatcher;

/*
 * This file is part of the Swisscom.CommunicationDispatcher package.
 */

use Swisscom\CommunicationDispatcher\Channel\ChannelInterface;
use Swisscom\CommunicationDispatcher\Domain\Model\Dto\Recipient;

interface DispatcherInterface
{

    /**
     * @param ChannelInterface $channelInterface
     * @return void
     */
    public function setChannelInterface(ChannelInterface $channelInterface);

    /**
     * @param Recipient $recipient
     * @param string $subject
     * @param string $text
     * @param array $params
     * @param array $options
     * @return void
     */
    public function dispatch(Recipient $recipient, string $subject, string $text, array $params = [], array $options = []);
}
