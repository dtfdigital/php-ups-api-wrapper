<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class PaymentInformation
{
    /**
     * @var ShipmentCharge[]
     */
    private array $shipmentCharges = [];

    public function __construct()
    {
        // Optionally add a default ShipmentCharge, or leave empty
    }

    public function exists(): bool
    {
        // Check if any of the ShipmentCharges exist
        foreach ($this->shipmentCharges as $charge) {
            if ($charge->exists()) {
                return true;
            }
        }
        return false;
    }

    public function addShipmentCharge(ShipmentCharge $shipmentCharge): self
    {
        $this->shipmentCharges[] = $shipmentCharge;
        return $this;
    }

    /**
     * Replace all shipment charges at once (optional)
     */
    public function setShipmentCharges(array $shipmentCharges): self
    {
        $this->shipmentCharges = $shipmentCharges;
        return $this;
    }

    /**
     * @return ShipmentCharge[]
     */
    public function getShipmentCharges(): array
    {
        return $this->shipmentCharges;
    }

    public function toArray(): array
    {
        return [
            "ShipmentCharge" => array_map(
                fn(ShipmentCharge $charge) => $charge->toArray(),
                $this->shipmentCharges
            )
        ];
    }
}
