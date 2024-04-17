<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;
use Carbon\Carbon;

class ReservationForm extends Component
{
    public $date;
    public $time;
    public $showingGcash = false;
    public $showingMaya = false;
    public $packages;
    public $pax;
    public $packageName;
    public $menus;
    public $menuPrice;
    public $totalCost;
    public $amountToPay;

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

    public function showGcash()
    {
        $this->showingGcash = !$this->showingGcash;
        $this->showingMaya = false;
    }
    
    public function showMaya()
    {
        $this->showingMaya = !$this->showingMaya;
        $this->showingGcash = false;
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
        $totalCost = $this->menuPrice * $this->pax;
        $tax = $totalCost * 0.12;
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
