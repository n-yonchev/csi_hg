<?php

namespace ISSI;

/**
 * Class representing DeliveryType
 *
 * Начин на получаване или изпращане
 * XSD Type: DeliveryType
 */
class DeliveryType
{

    /**
     * @property int $deliveryId
     */
    private $deliveryId = null;

    /**
     * @property string $deliveryName
     */
    private $deliveryName = null;

    /**
     * Gets as deliveryId
     *
     * @return int
     */
    public function getDeliveryId()
    {
        return $this->deliveryId;
    }

    /**
     * Sets a new deliveryId
     *
     * @param int $deliveryId
     * @return self
     */
    public function setDeliveryId($deliveryId)
    {
        $this->deliveryId = $deliveryId;
        return $this;
    }

    /**
     * Gets as deliveryName
     *
     * @return string
     */
    public function getDeliveryName()
    {
        return $this->deliveryName;
    }

    /**
     * Sets a new deliveryName
     *
     * @param string $deliveryName
     * @return self
     */
    public function setDeliveryName($deliveryName)
    {
        $this->deliveryName = $deliveryName;
        return $this;
    }


}

