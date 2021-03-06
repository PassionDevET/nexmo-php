<?php
declare(strict_types=1);

namespace Nexmo\Voice;

use Nexmo\Voice\Endpoint\EndpointInterface;
use Nexmo\Voice\Endpoint\Phone;
use Nexmo\Voice\NCCO\NCCO;

class OutboundCall
{
    const MACHINE_CONTINUE = 'continue';
    const MACHINE_HANGUP = 'hangup';

    /**
     * @var Webhook
     */
    protected $answerWebhook;

    /**
     * @var Webhook
     */
    protected $eventWebhook;

    /**
     * @var Phone
     */
    protected $from;

    /**
     * Length of seconds before Nexmo hangs up after going into `in_progress` status
     * @var int
     */
    protected $lengthTimer;

    /**
     * What to do when Nexmo detects an answering machine.
     * @var ?string
     */
    protected $machineDetection;
    /**
     * @var NCCO
     */
    protected $ncco;

    /**
     * Length of time Nexmo will allow a phone number to ring before hanging up
     * @var int
     */
    protected $ringingTimer;

    /**
     * @var EndpointInterface
     */
    protected $to;

    public function __construct(EndpointInterface $to, Phone $from)
    {
        $this->to = $to;
        $this->from = $from;
    }

    public function getAnswerWebhook() : ?Webhook
    {
        return $this->answerWebhook;
    }

    public function getEventWebhook() : ?Webhook
    {
        return $this->eventWebhook;
    }

    public function getFrom() : Phone
    {
        return $this->from;
    }

    public function getLengthTimer() : ?int
    {
        return $this->lengthTimer;
    }

    public function getMachineDetection() : ?string
    {
        return $this->machineDetection;
    }

    public function getNCCO() : ?NCCO
    {
        return $this->ncco;
    }

    public function getRingingTimer() : ?int
    {
        return $this->ringingTimer;
    }

    public function getTo() : EndpointInterface
    {
        return $this->to;
    }

    public function setAnswerWebhook(Webhook $webhook) : self
    {
        $this->answerWebhook = $webhook;
        return $this;
    }

    public function setEventWebhook(Webhook $webhook) : self
    {
        $this->eventWebhook = $webhook;
        return $this;
    }

    public function setLengthTimer(int $timer) : self
    {
        $this->lengthTimer = $timer;
        return $this;
    }

    public function setMachineDetection(string $action) : self
    {
        if ($action === self::MACHINE_CONTINUE || $action === self::MACHINE_HANGUP) {
            $this->machineDetection = $action;
            return $this;
        }
        
        throw new \InvalidArgumentException('Unknown machine detection action');
    }

    public function setNCCO(NCCO $ncco) : self
    {
        $this->ncco = $ncco;
        return $this;
    }

    public function setRingingTimer(int $timer) : self
    {
        $this->ringingTimer = $timer;
        return $this;
    }
}
