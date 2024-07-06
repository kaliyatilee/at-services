@props(['activePage'])

<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('dashboard') }} ">
            <img src="{{ asset('assets') }}/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-2 font-weight-bold text-white">{{ env("APP_NAME") }}</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            {{--REPORTS START--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Reports</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'report_dstv' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('report_dstv') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">DSTV</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'report_insurance' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('report_insurance') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Insurance</span>
                </a>
            </li>
            {{-- REPORTS END --}}
            {{-- BROCAST MESSAGE --}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">BROADCAST MESSAGE</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'broadcast' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('broadcast') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Message</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'report_loan' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('user') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Loan</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'report_loan' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('user') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Loan</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'report_ecocash' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('user') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Ecocash</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'report_rtgs' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('user') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">RTGs</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'report_eggs' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('user') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Eggs</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'report_permanent_disc' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('user') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Permanent Disc</span>
                </a>
            </li> -->
            {{--            REPORTS END--}}
            {{--            USERS START--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Users</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'user' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('user') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'user/add' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('client_add') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Add User</span>
                </a>
            </li>
            {{--            USERS END--}}
            {{--            CLIENTS START--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Clients</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'client' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('client') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Clients</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'client/add' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('client_add') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Add Client</span>
                </a>
            </li>
            {{--            CLIENTS END--}}

{{--            DSTV START--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">DSTV</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dstv' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('dstv') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Subscriptions</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dstv/package' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('dstv_package') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Packages</span>
                </a>
            </li>
{{--            DSTV END--}}
            {{--            LOAN START--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">LOAN</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'loan' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('loan_disbursed') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Disbursed</span>
                </a>
            </li>
            {{--            LOAN END--}}
            {{--            NOTES START--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">NOTES</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'notes' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('notes') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Notes</span>
                </a>
            </li>
            {{--            NOTES END--}}
            {{--            Insurance START--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Insurance</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'insurance' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('insurance') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Insurance</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'insurance_broker' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('insurance_broker') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Insurance Brokers</span>
                </a>
            </li>
            {{--            Insurance END--}}

            {{--            CURRENCY START--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Currency</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'currency' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('currency') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Currency</span>
                </a>
            </li>
            {{--            CURRENCY END--}}

            {{--            CURRENCY START--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Vehicle Class</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'vehicle_class' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('vehicle_class') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Vehicle Class</span>
                </a>
            </li>
            {{--            CURRENCY END--}}

            {{--            Ecocash START--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Ecocash</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'ecocash_transaction_type' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('ecocash_transaction_type') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Transaction Type</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'ecocash' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('ecocash') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Transactions</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'ecocash_agent_line' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('ecocash_agent_line') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Agent Line</span>
                </a>
            </li>
            {{--            Ecocash END--}}

            {{--            Company Registration START--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Company Registration</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'company_registration_supplier' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('company_registration_supplier') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Company Registration Suppliers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'company_registration' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('company_registration') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Company Registration</span>
                </a>
            </li>
            {{--            Company Registration END--}}

            {{--            RTGs START--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">RTGs</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'rtgs' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('rtgs') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Transactions</span>
                </a>
            </li>
            {{--            RTGs END--}}

            {{--            Permanent Disc START--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Permanent Disc</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'permanent_disc' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('permanent_disc') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Permanent Disc</span>
                </a>
            </li>
            {{--            Permanent Disc END--}}

            {{--            Eggs START--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Eggs</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'eggs' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('eggs') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Eggs</span>
                </a>
            </li>
            {{--            Eggs END--}}

        </ul>
    </div>
</aside>
