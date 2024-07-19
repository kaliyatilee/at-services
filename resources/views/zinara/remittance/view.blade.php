<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="remittance"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="View Remittance Record"></x-navbars.navs.auth>
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="text-center mt-4">
                    <button id="downloadExcelBtn" class="btn bg-gradient-dark">Download as Excel</button>
                </div>
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <div class="card card-frame">
                                    <div class="card-body">
                                        <p>Name</p>
                                        <hr>
                                        {{ $remittance->vehicle_transaction_name }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="card card-frame">
                                    <div class="card-body">
                                        <p>Expected Amount (USD)</p>
                                        <hr>
                                        <span id="expectedAmountUsdValue">{{ number_format($remittance->expected_amount_usd, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="card card-frame">
                                    <div class="card-body">
                                        <p>Expected Amount (ZIG)</p>
                                        <hr>
                                        <span id="expectedAmountZigValue">{{ number_format($remittance->expected_amount_zig, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-12">
                                <div class="card card-frame">
                                    <div class="card-body">
                                        <hr>
                                        @if(!empty($remittance->date_of_remittance))
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th colspan="6" class="text-center font-weight-bold">Remittance History</th>
                                                </tr>
                                                <tr>
                                                    <th>Date of Remittance</th>
                                                    <th>Method of Remittance</th>
                                                    <th>Amount Remitted (ZIG)</th>
                                                    <th>Amount Remitted (USD)</th>
                                                    <th>Account Balance (ZIG)</th>
                                                    <th>Account Balance (USD)</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($remittance->date_of_remittance as $index => $date)
                                                    <tr>
                                                        <td style="padding-left: 5px;">{{ $date ?? 'N/A' }}</td>
                                                        <td>{{ $remittance->method_of_remittance[$index] ?? 'N/A' }}</td>
                                                        <td id="amountRemittedZigValue{{$index}}">{{ number_format($remittance->amount_remitted_zig[$index] ?? 0, 2) }} ZIG</td>
                                                        <td id="amountRemittedUsdValue{{$index}}">{{ number_format($remittance->amount_remitted_usd[$index] ?? 0, 2) }} USD</td>
                                                        <td id="accountBalanceZigValue{{$index}}">{{ number_format($remittance->account_balance_zig[$index] ?? 0, 2) }} ZIG</td>
                                                        <td id="accountBalanceUsdValue{{$index}}">{{ number_format($remittance->account_balance_usd[$index] ?? 0, 2) }} USD</td>
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
        $('#downloadExcelBtn').click(function() {
            var mainData = [
                ['Name', 'Expected Amount (USD)', 'Expected Amount (ZIG)'],
                ['{{ $remittance->vehicle_transaction_name }}', '{{ number_format($remittance->expected_amount_usd, 2) }}', '{{ number_format($remittance->expected_amount_zig, 2) }}']
            ];

            var remittanceData = [];
            @if(!empty($remittance->date_of_remittance))
                remittanceData.push(['']);
                remittanceData.push(['Date of Remittance', 'Method of Remittance', 'Amount Remitted (ZIG)', 'Amount Remitted (USD)', 'Account Balance (ZIG)', 'Account Balance (USD)']);
                @foreach($remittance->date_of_remittance as $index => $date)
                    remittanceData.push([
                        '{{ $date ?? 'N/A' }}',
                        '{{ $remittance->method_of_remittance[$index] ?? 'N/A' }}',
                        '{{ number_format($remittance->amount_remitted_zig[$index] ?? 0, 2) }} ZIG',
                        '{{ number_format($remittance->amount_remitted_usd[$index] ?? 0, 2) }} USD',
                        '{{ number_format($remittance->account_balance_zig[$index] ?? 0, 2) }} ZIG',
                        '{{ number_format($remittance->account_balance_usd[$index] ?? 0, 2) }} USD'
                    ]);
                @endforeach
            @else
                remittanceData.push(['No remittance details available.']);
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
                { wch: 20 }
            ];

            ws['!cols'] = wscols;

            XLSX.utils.book_append_sheet(wb, ws, 'Remittance Data');

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

            downloadExcelFile(wbout, 'remittance_data.xlsx');
        });
    });
</script>
