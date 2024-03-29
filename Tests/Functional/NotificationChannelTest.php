<?php

namespace Swisscom\CommunicationDispatcher\Tests\Functional;

/*
 * This file is part of the Swisscom.CommunicationDispatcher package.
 */

use Neos\Flow\Persistence\Doctrine\PersistenceManager;
use Neos\Flow\Tests\FunctionalTestCase;
use Neos\Party\Domain\Model\Person;
use Neos\Party\Domain\Model\PersonName;
use Neos\Party\Domain\Repository\PartyRepository;
use Swisscom\CommunicationDispatcher\Channel\NotificationChannel;
use Swisscom\CommunicationDispatcher\Domain\Model\Dto\Recipient;

class NotificationChannelTest extends FunctionalTestCase
{

    /**
     * @var NotificationChannel
     */
    protected $notificationChannel;

    /**
     * @var PartyRepository
     */
    protected $partyRepository;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->notificationChannel = $this->objectManager->get(NotificationChannel::class);
        $this->persistenceManager = $this->objectManager->get(PersistenceManager::class);
        $this->partyRepository = $this->objectManager->get(PartyRepository::class);
    }

    /**
     * @test
     */
    public function dispatcherRendersText()
    {
        $personName = new PersonName('Foo', 'Bar');
        $person = new Person();
        $person->setName($personName);
        $this->partyRepository->add($person);
        $recipient = new Recipient($person);
        $this->notificationChannel->send($recipient, 'Subject', 'Text');

        $this->assertEquals(true, $this->persistenceManager->hasUnpersistedChanges());

        $this->persistenceManager->clearState();
    }
}
