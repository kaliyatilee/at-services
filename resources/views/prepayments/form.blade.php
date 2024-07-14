<form id="add_client_form" method='POST' action="{{ isset($prepaidTransaction) ? route('prepaid.transaction.update', $prepaidTransaction->id) : route('prepaid.transaction.store') }}"'>
@csrf

@if(isset($prepaidTransaction))
    @method('PATCH')
@endif

<div class="row">
    <div class="mb-3 col-md-6">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control border border-2 p-2 @error('name') is-invalid @enderror"
               value='{{ old('name') }}'>
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
            value="{{ old('phone') }}"
            oninput="this.setCustomValidity('')"
            oninvalid="this.setCustomValidity('Invalid phone number. Must start with 2637 and follow format: 2637*********')"
        />
        <div id="phone_success_error_message" class="text-danger text-xs"></div>
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Description</label>
        <input
            class="form-control border border-2 p-2 @error('description') is-invalid @enderror"
            type="text"
            name="description"
            value="{{ old('description') }}"
            required />
        <div id="phone_success_error_message" class="text-danger text-xs"></div>
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Notes</label>
        <input
            class="form-control border border-2 p-2 @error('notes') is-invalid @enderror"
            type="text"
            name="notes"
            value="{{ old('notes') }}"
            required />
    </div>
    <div class="mb-3 col-md-6">
        <label class="form-label">Currency</label>
        <input
            class="form-control border border-2 p-2 @error('currency') is-invalid @enderror"
            type="text"
            name="description"
            value="{{ old('description') }}"
            required />
        <div id="phone_success_error_message" class="text-danger text-xs"></div>
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Rate</label>
        <input
            class="form-control border border-2 p-2 @error('rate') is-invalid @enderror"
            type="text"
            name="notes"
            value="{{ old('notes') }}"
            required />
    </div>
    <div class="mb-3 col-md-6">
        <label class="form-label">Amount</label>
        <input
            class="form-control border border-2 p-2 @error('amount') is-invalid @enderror"
            type="text"
            name="description"
            value="{{ old('description') }}"
            required />
        <div id="phone_success_error_message" class="text-danger text-xs"></div>
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Transaction Date</label>
        <input
            class="form-control border border-2 p-2 @error('transaction_date') is-invalid @enderror"
            type="text"
            name="notes"
            value="{{ old('transaction_date') }}"
            required />
    </div>
</div>
<button type="submit" class="btn bg-gradient-dark">Submit</button>
<div class='' id="success_error_message"></div>
</form>
