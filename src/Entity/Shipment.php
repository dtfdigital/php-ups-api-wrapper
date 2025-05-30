<?php

namespace RahulGodiyal\PhpUpsApiWrapper\Entity;

class Shipment
{
    private string $description = "";
    private ReturnService $returnService;
    private Shipper $shipper;
    private ShipTo $shipTo;
    private ShipFrom $shipFrom;
    private PaymentInformation $paymentInformation;
    private Service $service;
    private Package $package;
    private array $additional = [];
    private array $packages = [];

    public function __construct()
    {
        $this->returnService = new ReturnService();
        $this->paymentInformation = new PaymentInformation();
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setReturnService(ReturnService $returnService): self
    {
        $this->returnService = $returnService;
        return $this;
    }

    public function getReturnService(): ReturnService
    {
        return $this->returnService;
    }

    public function setShipper(Shipper $shipper): self
    {
        $this->shipper = $shipper;
        return $this;
    }

    public function getShipper(): Shipper
    {
        return $this->shipper;
    }

    public function setShipTo(ShipTo $shipTo): self
    {
        $this->shipTo = $shipTo;
        return $this;
    }

    public function getShipTo(): ShipTo
    {
        return $this->shipTo;
    }

    public function setShipFrom(ShipFrom $shipFrom): self
    {
        $this->shipFrom = $shipFrom;
        return $this;
    }

    public function getShipFrom(): ShipFrom
    {
        return $this->shipFrom;
    }

    public function setPaymentInformation(PaymentInformation $paymentInformation): self
    {
        $this->paymentInformation = $paymentInformation;
        return $this;
    }

    public function getPaymentInformation(): PaymentInformation
    {
        return $this->paymentInformation;
    }

    public function setService(Service $service): self
    {
        $this->service = $service;
        return $this;
    }

    public function getService(): Service
    {
        return $this->service;
    }

    public function setPackage(Package $package): self
    {
        $this->package = $package;
        return $this;
    }
    /*  */
    public function setPackages(array $packages): self
    {
        $this->packages = $packages;
        return $this;
    }

    public function getPackage(): Package
    {
        return $this->package;
    }

    public function setAdditional(array $additional): self
    {
        $this->additional = $additional;
        return $this;
    }

    public function toArray(): array
    {
        $shipment = [
            "Shipper" => $this->shipper->toArray(),
            "ShipTo" => $this->shipTo->toArray(),
            "Service" => $this->service->toArray()/*,
           "Package" => $this->package->toArray()*/
        ];



        if(isset($this->package)) {
        $shipment["Package"] = $this->package->toArray();
        } elseif($this->packages) {
            foreach($this->packages as $_package) {
            $packages[] = $_package->toArray();
            }
            $shipment["Package"]=$packages;

        }
        


        

        if ($this->description) {
            $shipment['Description'] = $this->description;
        }

        if ($this->paymentInformation->exists()) {
            $shipment["PaymentInformation"] = $this->paymentInformation->toArray();
        }

        if ($this->shipFrom) {
            $shipment["ShipFrom"] = $this->shipFrom->toArray();
        }

        if ($this->returnService->exists()) {
            $shipment["ReturnService"] = $this->returnService->toArray();
        }

        if($this->additional > 0) {
            $shipment = array_merge($shipment,$this->additional);
        }
       

        return $shipment;
    }
}
