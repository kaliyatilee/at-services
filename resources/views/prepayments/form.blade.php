<form id="add_client_form" method='POST' action="{{ isset($prepaidTransaction) ? route('prepaid.transaction.update', $prepaidTransaction->id) : route('prepaid.transaction.store') }}"'>
@csrf

@if(isset($prepaidTransaction))
    @method('PATCH')
@endif

<div class="row">
    <div class="mb-3 col-md-6">
        <label class="form-label">Name</label>
        <input type="text"
               name="name"
               class="form-control border border-2 p-2 @error('name') is-invalid @enderror"
               value="{{ old('name', $prepaidTransaction->name ?? '') }}"
               required>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Phone</label>
        <input
            class="form-control border border-2 p-2 @error('phone') is-invalid @enderror"
            type="tel"
            pattern="2637[0-9]{8}"
            title="Must start with 2637 and follow format: 2637*********"
            placeholder="Format: 2637*********"
            name="phone"
            value="{{ old('phone', $prepaidTransaction->phone ?? '') }}"
            oninput="this.setCustomValidity('')"
            oninvalid="this.setCustomValidity('Invalid phone number. Must start with 2637 and follow format: 2637*********')"
            required/>
        @error('phone')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Description</label>
        <input
            class="form-control border border-2 p-2 @error('description') is-invalid @enderror"
            type="text"
            name="description"
            value="{{ old('description', $prepaidTransaction->description ?? '') }}"
            required />
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Notes</label>
        <input
            class="form-control border border-2 p-2 @error('notes') is-invalid @enderror"
            type="text"
            name="notes"
            value="{{ old('notes', $prepaidTransaction->notes ?? '') }}"
            required />
        @error('notes')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-6">
        <label class="form-label">Currency</label>
        <select class="form-control border border-2 p-2 @error('currency_id') is-invalid @enderror" id="currency_id" name="currency_id" required>
            <option value="">Select..</option>
            @foreach($currencies as $currency)
                <option value="{{$currency->id}}" {{ old('currency_id', $prepaidTransaction->currency_id ?? '') == $currency->id ? 'selected' : '' }}>{{$currency->name}}</option>
            @endforeach
        </select>
        @error('currency_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Rate</label>
        <input
            class="form-control border border-2 p-2 @error('rate') is-invalid @enderror"
            type="number"
            step="0.01"
            min="0.01"
            max="99999"
            name="rate"
            value="{{ old('rate', $prepaidTransaction->rate ?? '') }}"
            required />
        @error('rate')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-6">
        <label class="form-label">Amount</label>
        <input
            class="form-control border border-2 p-2 @error('amount') is-invalid @enderror"
            type="number"
            step="0.01"
            min="0.01"
            max="99999"
            name="amount"
            value="{{ old('amount', $prepaidTransaction->amount ?? '') }}"
            required />
        @error('amount')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Transaction Date</label>
        <input
            class="form-control border border-2 p-2 @error('transaction_date') is-invalid @enderror"
            type="date"
            max="{{date('Y-m-d')}}"
            name="transaction_date"
            value="{{ old('transaction_date', $prepaidTransaction->transaction_date ?? '') }}"
            required />
        @error('transaction_date')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<button type="submit" class="btn bg-gradient-dark">Submit</button>
<div class='' id="success_error_message"></div>
</form>
