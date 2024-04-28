<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\Inventory;

class ReservationForm extends Component
{
    public $date;
    public $time;
    public $inventoryItems;
    public $packages;
    public $pax;
    public $packageName;
    public $menus;
    public $menuPrice;
    public $totalCost;
    public $amountToPay;
    public $inclusionType;
    public $additionalItems = [];
    public $addOns = [];

    protected $listeners = [
        'dateSelected' => 'setDate',
        'timeSelected' => 'setTime',
    ];

    public function setDate($date)
    {
        $this->date = Carbon::parse($date)->format('F j, Y');
    }

    public function setTime($event)
    {
        $this->time = $event['time'];
    }

    public function addItem($id, $quantity)
    {
        $item = Inventory::find($id);

        // If the item doesn't exist or the quantity is less than or equal to 0, return
        if (!$item || $quantity <= 0) {
            return;
        }

        // Check if the item already exists in the additionalItems array
        $existingItemIndex = null;
        foreach ($this->additionalItems as $index => $existingItem) {
            if ($existingItem['item']->id == $id) {
                $existingItemIndex = $index;
                break;
            }
        }

        // If the item already exists, update its quantity, otherwise add a new item
        if ($existingItemIndex !== null) {
            $this->additionalItems[$existingItemIndex]['quantity']++;
        } else {
            $this->additionalItems[] = [
                'item' => $item,
                'quantity' => $quantity
            ];
        }

        $this->calculateCost();
    }

    public function updateQuantity($id, $quantity)
    {
        // Update the quantity of the item in the additionalItems array
        foreach ($this->additionalItems as $key => $item) {
            if ($item['item']->id == $id) {
                // If quantity becomes zero, remove the item from the array
                if ($quantity == 0) {
                    unset($this->additionalItems[$key]);
                } else {
                    $this->additionalItems[$key]['quantity'] = $quantity;
                }
                break;
            }
        }

        $this->calculateCost();
    }

    public function addOption($option)
    {
        if (in_array($option, array_column($this->addOns, 'option'))) {
            // If the option is already in the array, remove it
            $this->addOns = array_values(array_filter($this->addOns, function ($item) use ($option) {
                return $item['option'] !== $option;
            }));
        } else {
            $this->addOns[] = [
                'option' => $option,
                'price' => $option === "Emcee" ? 4000 : 15000
            ];
        }

        $this->calculateCost();
    }

    public function selectedPackage($id)
    {
        // displays the menus depending on the selected package
        $this->menus = Menu::where('package_id', $id)->get();

        // sets the package name for image and pdf viewing
        switch($id){
            case 1:
            case 6:
                $this->packageName = 'sapphire';
                break;
            case 2:
            case 7:
                $this->packageName = 'silver';
                break;
            case 3:
            case 8:
                $this->packageName = 'tiffany';
                break;
            case 4:
            case 9:
                $this->packageName = 'ruby';
                break;
            case 5:
            case 10:
                $this->packageName = 'gold';
                break;
            case 11: $this->packageName = 'ordinary';
                break;
            case 12: $this->packageName = 'special';
                break;
            default: $this->packageName = '';
        }

        // sets the inclusion text depending on what is the selected package
        if($id <= 5)
            $this->inclusionType = 'wedding ' . $this->packageName;
        else if($id <= 10 && $id >= 6)
            $this->inclusionType = 'debut ' . $this->packageName;
        else
            $this->inclusionType = $this->packageName;

            
    }

    public function selectedMenu($price)
    {
        $this->menuPrice = $price;
        $this->calculateCost();
    }

    public function setPax()
    {
        $this->calculateCost();
    }

    public function calculateCost()
    {
        // Calculate the cost based on menu price and number of pax
        $totalCost = $this->menuPrice * $this->pax;

        // Calculate the amount of applicable tax
        $tax = $totalCost * 0.12;

        // Add the prices of additional items
        foreach ($this->additionalItems as $item) {
            $totalCost += $item['item']->price * $item['quantity'];
        }

        // Add the prices of additional options
        foreach($this->addOns as $option){
            $totalCost += $option['price'];
        }

        $this->totalCost = $totalCost + $tax;
    }

    public function calculateAmountToPay($percent)
    {
        switch($percent)
        {
            case 20: $percentage = 0.2;
                break;
            case 60: $percentage = 0.6;
                break;
            case 90: $percentage = 0.9;
                break;
            case 100: $percentage = 1;
                break;
            default: $percentage = 1;
        }

        $this->amountToPay = $this->totalCost * $percentage;
    }

    public function mount($packages)
    {
        $this->packages = $packages;
    }

    public function render()
    {
        return view('livewire.reservation-form', [
            'menu' => $this->menus,
        ]);
    }
}
