<?php

namespace ISSI;

/**
 * Class representing TransferMessage
 */
class TransferMessage
{

    /**
     * Заглавна част
     *
     * @property \ISSI\TransferMessage\HeaderAType $header
     */
    private $header = null;

    /**
     * Съдържание на съобщение
     *
     * @property \ISSI\TransferMessage\BodyAType $body
     */
    private $body = null;

    /**
     * Gets as header
     *
     * Заглавна част
     *
     * @return \ISSI\TransferMessage\HeaderAType
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Sets a new header
     *
     * Заглавна част
     *
     * @param \ISSI\TransferMessage\HeaderAType $header
     * @return self
     */
    public function setHeader(\ISSI\TransferMessage\HeaderAType $header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     * Gets as body
     *
     * Съдържание на съобщение
     *
     * @return \ISSI\TransferMessage\BodyAType
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Sets a new body
     *
     * Съдържание на съобщение
     *
     * @param \ISSI\TransferMessage\BodyAType $body
     * @return self
     */
    public function setBody(\ISSI\TransferMessage\BodyAType $body)
    {
        $this->body = $body;
        return $this;
    }


}

