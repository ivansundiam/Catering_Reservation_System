<?php

namespace App\Livewire\Report;

use App\Models\Inventory;
use App\Models\ItemReport;
use Livewire\Component;
use App\Models\Package;
use App\Models\Reservation;
use carbon\Carbon;

class PrintInventory extends Component
{
    public $showing = false;
    public $inventory;
    public $selectedCategory = 'all';
    public $selectedDate = 'monthly';
    public $selectedMonth;
    public $selectedYear;
    public $noItems = false;

    public function show()
    {
        $this->showing = !$this->showing;
    }

    public function mount()
    {
        $this->selectedMonth = date('n');
        $this->selectedYear = date('Y');    
    }


    public function render()
    {
        $query = ItemReport::with(['inventory']);        

        // Apply package filter if selected
        if ($this->selectedCategory !== 'all') {
            $query->whereHas('inventory', function ($query) {
                $query->where('category', $this->selectedCategory);
            });
        }

        // Apply date filter if selected
        if ($this->selectedDate) {
            $currentDate = now();
            switch ($this->selectedDate) {
                case 'month':
                    // Filter inventory for the current month
                    $query->whereYear('created_at', $currentDate->year)
                        ->whereMonth('created_at', $currentDate->month);
                    break;
                case 'year':
                    // Filter inventory for the current year
                    $query->whereYear('created_at', $currentDate->year);
                    break;
                default:
                    // No date filter
                    break;
            }
        }

        // Apply month filter if selected
        if ($this->selectedMonth && $this->selectedDate == "monthly") {
            $query->whereMonth('created_at', $this->selectedMonth);
        }

        // Apply year filter if selected
        if ($this->selectedYear) {
            $query->whereYear('created_at', $this->selectedYear);
        }

        $inventoryItems = $query->get();
        $groupedInventory = $inventoryItems->groupBy('inventory_id');

        // Map over the grouped inventory items to merge them
        $mergedInventory = $groupedInventory->map(function ($items) {
            $mergedItem = $items->first();

            // Sum up the quantities of all items
            $mergedQuantity = $items->sum('quantity_rented');

            // Update the quantity of the merged item
            $mergedItem->quantity_rented = $mergedQuantity;

            return $mergedItem;
        });

        // Convert the merged inventory back to a collection
        $mergedInventory = $mergedInventory->values();

        // Assign the merged inventory to $this->inventory
        $this->inventory = $mergedInventory;
        $totalEarnings = $this->inventory->sum(function ($itemReport) {
            $inventory = $itemReport->inventory;
            $earningsForItem = $inventory->price * $itemReport->quantity_rented;
        
            return $earningsForItem;
        });

        // Retrieve the most chosen package and its count for the selected month
        $mostRentedItemMonth = ItemReport::selectRaw('inventory_id, sum(quantity_rented) as item_count')
            ->whereMonth('created_at', $this->selectedMonth)
            ->whereYear('created_at', $this->selectedYear)
            ->groupBy('inventory_id')
            ->orderByDesc('item_count')
            ->first();

        // Retrieve the most chosen package and its count for the selected year
        $mostRentedItemYear = ItemReport::selectRaw('inventory_id, sum(quantity_rented) as item_count')
            ->whereYear('created_at', $this->selectedYear)
            ->groupBy('inventory_id')
            ->orderByDesc('item_count')
            ->first();
        
        // Get the month with the most ItemReport
        $mostMonthWithRent = ItemReport::selectRaw('YEAR(created_at) year, MONTH(created_at) month, sum(quantity_rented) as item_count')
            ->groupBy('year', 'month')
            ->orderByDesc('item_count')
            ->first();

    
        // Get the count of inventory
        $inventoryCount = (float) $this->inventory->sum('quantity_rented');

        // Get the minimum and maximum dates from the inventory
        $minDate = $this->inventory->min('created_at');
        $maxDate = $this->inventory->max('created_at');
        $minYear = Carbon::parse($minDate)->format('Y');
        $maxYear = Carbon::parse($maxDate)->format('Y');

        // Create an array of years from the minimum to maximum year
        $years = range($minYear, $maxYear);

        // disables submit button if there is no inventory
        $inventoryCount < 1 
            ? $this->noItems = true
            : $this->noItems = false;

        

        // to be passed in the pdf
        $reportDetails = [
            'inventory' => $this->inventory,
            'date' => $this->selectedDate,
            'month' => $this->selectedMonth,
            'year' => $this->selectedYear,
            'mostRentedItemMonth' => $mostRentedItemMonth,
            'mostRentedItemYear' => $mostRentedItemYear,
            'mostMonthWithRent' => $mostMonthWithRent,
            'inventoryCount' => $inventoryCount,
            'totalEarnings' => $totalEarnings,
        ];

        return view('livewire.report.print-inventory', [
            'inventory' => $this->inventory,
            'years' => $years,
            'mostRentedItemMonth' => $mostRentedItemMonth,
            'mostRentedItemYear' => $mostRentedItemYear,
            'mostMonthWithRent' => $mostMonthWithRent,
            'inventoryCount' => $inventoryCount,
            'inventoryCount' => $inventoryCount,
            'totalEarnings' => $totalEarnings,
            'reportDetails' => $reportDetails,
        ]);
    }
}
