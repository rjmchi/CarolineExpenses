<?php

use App\Models\Expense;
use App\Models\Category;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Validate('required|date')]
    public Carbon $date;
    #[Validate('required')]
    public string $title='';
    #[Validate('required | gt:0 | lt:1000000')]
    public float $amount=0;
    #[Validate('required')]
    public int $category_id=1;

    public function with() {
        return ['expenses'=>Expense::orderBy('date', 'desc')->get(), 'total'=> Expense::sum('amount'), 'categories'=>Category::all()];
    }

    public function addExpense() {

        $validated = $this->validate();
        Expense::create($validated);
        $this->reset();
    }
};