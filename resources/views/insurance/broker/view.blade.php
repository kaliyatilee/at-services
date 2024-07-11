<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="insurance_broker"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="View Insurance Broker"></x-navbars.navs.auth>
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
            <div class="text-center mt-4">
                <button id="downloadExcelBtn" class="btn bg-gradient-dark">Download as Excel</button>
                <button id="currencyToggleBtn" class="btn bg-gradient-dark ml-2">Switch to Zig</button>
                <input type="number" id="exchangeRateInput" placeholder="Enter exchange rate" class="ml-2" value="0.75" style="padding: 4px 8px; border: 1px solid #ccc; border-radius: 4px; width: 120px;">
            </div>
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <div class="card card-frame">
                                    <div class="card-body">
                                        <p>Name</p>
                                        <hr>
                                        {{ $insurance_broker->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="card card-frame">
                                    <div class="card-body">
                                        <p>Commission</p>
                                        <hr>
                                        <span id="comissionValue">{{ number_format($insurance_broker->commission * 0.75, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="card card-frame">
                                    <div class="card-body">
                                        <p>Notes</p>
                                        <hr>
                                        {{ $insurance_broker->notes }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="card card-frame">
                                    <div class="card-body">
                                        <p>Added By</p>
                                        <hr>
                                        {{ $insurance_broker->createdBy()->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="card card-frame">
                                    <div class="card-body">
                                        <p>Created On</p>
                                        <hr>
                                        {{ $insurance_broker->created_at }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-12">
                                <div class="card card-frame">
                                    <div class="card-body">
                                        <hr>
                                        @if(!empty($insurance_broker->remittance))
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th colspan="4" class="text-center font-weight-bold">Remittance History</th>
                                                </tr>
                                                <tr>
                                                    <th>Date of Remittance</th>
                                                    <th>Method of Remittance</th>
                                                    <th>Remittance</th>
                                                    <th>Amount Remitted</th>
                                                    <th>Account Balance</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($insurance_broker->remittance as $index => $remittance)
                                                    <tr>
                                                        <td style="padding-left: 5px;">{{ $insurance_broker->date_of_remittance[$index] ?? 'N/A' }}</td>
                                                        <td>{{ $insurance_broker->method_of_remittance[$index] ?? 'N/A' }}</td>
                                                        <td id="remittanceValue{{$index}}">{{ number_format($insurance_broker->remittance[$index] * 0.75, 2) }} USD</td>
                                                        <td id="amountRemittedValue{{$index}}">{{ number_format($insurance_broker->amount_remitted[$index] * 0.75, 2) }} USD</td>
                                                        <td id="accountBalanceValue{{$index}}">{{ number_format($insurance_broker->account_balance[$index] * 0.75, 2) }} USD</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p>No remittance details available.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="card card-frame">
                                    <div class="card-body">
                                        <p>Total Remittance</p>
                                        <hr>
                                        <span id="totalRemittanceValue">{{ number_format($insurance_broker->total_remittance * 0.75, 2) }} USD</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.0/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>

<script>
    $(document).ready(function() {
        var currentCurrency = 'USD';
        var exchangeRate = parseFloat($('#exchangeRateInput').val());

        function convertCurrency(amount, toCurrency) {
            if (toCurrency === 'USD') {
                return (amount * exchangeRate).toFixed(2);
            } else {
                return (amount / exchangeRate).toFixed(2);
            }
        }

        function updateDisplayedValues() {
            var commission = parseFloat('{{ $insurance_broker->commission }}');
            var totalRemittance = parseFloat('{{ $insurance_broker->total_remittance }}');

            if (currentCurrency === 'USD') {
                $('#commissionValue').text(convertCurrency(commission, 'USD') + ' USD');
                $('#totalRemittanceValue').text(convertCurrency(totalRemittance, 'USD') + ' USD');
                @foreach($insurance_broker->remittance as $index => $remittance)
                    $('#amountRemittedValue{{$index}}').text(convertCurrency(parseFloat('{{ $insurance_broker->amount_remitted[$index] }}'), 'USD') + ' USD');
                    $('#accountBalanceValue{{$index}}').text(convertCurrency(parseFloat('{{ $insurance_broker->account_balance[$index] }}'), 'USD') + ' USD');
                    $('#remittanceValue{{$index}}').text(convertCurrency(parseFloat('{{ $insurance_broker->remittance[$index] }}'), 'USD') + ' USD');
                @endforeach
            } else {
                $('#commissionValue').text(commission + ' Zig');
                $('#totalRemittanceValue').text(totalRemittance + ' Zig');
                @foreach($insurance_broker->remittance as $index => $remittance)
                    $('#amountRemittedValue{{$index}}').text('{{ $insurance_broker->amount_remitted[$index] }}' + ' Zig');
                    $('#accountBalanceValue{{$index}}').text('{{ $insurance_broker->account_balance[$index] }}' + ' Zig');
                    $('#remittanceValue{{$index}}').text('{{ $insurance_broker->remittance[$index] }}' + ' Zig');
                @endforeach
            }
        }

        $('#currencyToggleBtn').click(function() {
            exchangeRate = parseFloat($('#exchangeRateInput').val()) || exchangeRate; // Use user-entered rate if available
            currentCurrency = currentCurrency === 'Zig' ? 'USD' : 'Zig';
            $(this).text(currentCurrency === 'USD' ? 'Switch to Zig' : 'Switch to USD');
            updateDisplayedValues();
        });

        $('#downloadExcelBtn').click(function() {
            var mainData = [
                ['Name', 'Commission', 'Notes', 'Added By', 'Created On', 'Total Remittance'],
                ['{{ $insurance_broker->name }}', convertCurrency(parseFloat('{{ $insurance_broker->commission }}'), currentCurrency) + ' ' + currentCurrency, '{{ $insurance_broker->notes }}', '{{ $insurance_broker->createdBy()->name }}', '{{ $insurance_broker->created_at }}', convertCurrency(parseFloat('{{ $insurance_broker->total_remittance }}'), currentCurrency) + ' ' + currentCurrency]
            ];

            var remittanceData = [];
            @if(!empty($insurance_broker->remittance))
                remittanceData.push(['', '', '', '', '']);
                remittanceData.push(['Date of Remittance', 'Method of Remittance', 'Remittance', 'Amount Remitted', 'Account Balance']);
                @foreach($insurance_broker->remittance as $index => $remittance)
                    remittanceData.push([
                        '{{ $insurance_broker->date_of_remittance[$index] ?? 'N/A' }}',
                        '{{ $insurance_broker->method_of_remittance[$index] ?? 'N/A' }}',
                        convertCurrency(parseFloat('{{ $insurance_broker->remittance[$index] }}'), currentCurrency) + ' ' + currentCurrency,
                        convertCurrency(parseFloat('{{ $insurance_broker->amount_remitted[$index] }}'), currentCurrency) + ' ' + currentCurrency,
                        convertCurrency(parseFloat('{{ $insurance_broker->account_balance[$index] }}'), currentCurrency) + ' ' + currentCurrency
                    ]);
                @endforeach
            @else
                remittanceData.push(['No remittance details available.', '', '', '', '']);
            @endif

            var data = mainData.concat(remittanceData);

            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet(data);

            var wscols = [
                { wch: 20 },
                { wch: 30 },
                { wch: 30 },
                { wch: 25 },
                { wch: 20 },
                { wch: 20 },
                { wch: 20 },
                { wch: 20 },
                { wch: 20 },
                { wch: 20 },
                { wch: 20 }
            ];

            ws['!cols'] = wscols;

            XLSX.utils.book_append_sheet(wb, ws, 'Insurance Broker Data');

            var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

            function downloadExcelFile(data, filename) {
                var blob = new Blob([s2ab(data)], { type: 'application/octet-stream' });
                saveAs(blob, filename);
            }

            function s2ab(s) {
                var buf = new ArrayBuffer(s.length);
                var view = new Uint8Array(buf);
                for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
                return buf;
            }

            downloadExcelFile(wbout, 'insurance_broker_data.xlsx');
        });

        updateDisplayedValues(); // Initial update to set default currency
    });
</script>
