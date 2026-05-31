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

    public $search = '';

    public $sortDir='desc';
    public $sortBy='date';

    public function with() {
        $query = Expense::orderBy($this->sortBy, $this->sortDir);
        if ($this->search) {
            $query->where('title', 'like', '%'.$this->search. '%');
        }
        return ['expenses'=>$query->get(), 'total'=> $query->sum('amount'), 'categories'=>Category::all()];
    }

    public function addExpense() {

        $validated = $this->validate();
        Expense::create($validated);
        $this->reset();
    }

    public function sort( string $field) {
        if ($this->sortBy === $field){
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDir = 'asc';
        }
    }

    public function delete(Expense $expense){
        $expense->delete($expense->id);
    }
};