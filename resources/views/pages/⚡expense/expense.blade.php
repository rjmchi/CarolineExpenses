
<div>

    <div>
        <form wire:submit="addExpense" method="POST" class="border border-teal-600 p-3 rounded shadow ">
            <p class="mb-2">New Expense</p>
            <div class="flex gap-3 ">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 w-full ">
                    <flux:input type="date" wire:model='date'/>
                    <flux:select wire:model="category_id" placeholder="Choose category...">
                        @foreach ($categories as $category)
                            <flux:select.option value="{{ $category->id }}" >{{$category->name}}</flux:select.option>    
                        @endforeach                        
                    </flux:select>                      
                    <flux:input wire:model='title' placeholder="title" />
                    <span class="flex items-center">$ <flux:input wire:model='amount' placeholder="0.00" /></span>
                    <flux:error name="date" />                  
                    <flux:error name="category" />                  
                    <flux:error name="title" />
                    <flux:error name="amount" />
                </div>
                <flux:button type=submit icon="plus" variant="primary" size="sm"> Add</flux:button>
            </div>
        </form>        
    </div>

    <flux:table>
    <flux:table.columns>
        <flux:table.column sortable :sorted="$sortBy==='date'" direction="$sortDir" wire:click="sort('date')">Date</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy==='category_id'" direction="$sortDir" wire:click="sort('category_id')">Category</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy==='title'" direction="$sortDir" wire:click="sort('title')">Title</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy==='amount'" direction="$sortDir" wire:click="sort('amount')">Amount</flux:table.column>
        <flux:table.column />
    </flux:table.columns>

    <flux:table.rows>
        @foreach ($expenses as $expense )
        <flux:table.row wire:key='{{ $expense->id }}' class="odd:bg-teal-50">
            <flux:table.cell>{{\Carbon\Carbon::parse($expense->date)->format('m/d/y')}}</flux:table.cell>
            <flux:table.cell>{{$expense->category->name}}</flux:table.cell>
            <flux:table.cell>{{$expense->title}}</flux:table.cell>
            <flux:table.cell variant="strong">{{ '$' . number_format($expense->amount, 2);}}</flux:table.cell>
            <flux:table.cell ><flux:button variant="danger" icon="trash" size="sm"  wire:click='delete({{ $expense->id }})'/></flux:table.cell>
        </flux:table.row>

    @endforeach

        <flux:table.row>
            <flux:table.cell>Total:</flux:table.cell>
            <flux:table.cell></flux:table.cell>
            <flux:table.cell></flux:table.cell>
            <flux:table.cell variant="strong">{{ '$' . number_format($total, 2);}}</flux:table.cell>
        </flux:table.row>

    </flux:table.rows>
</flux:table>

</div>