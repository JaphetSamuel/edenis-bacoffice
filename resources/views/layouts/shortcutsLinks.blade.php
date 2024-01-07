<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('dash')}}" class="nav-link text-gray-dark text-bold border-info">Dashboard</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('kyc.form')}}" class="nav-link text-gray-dark text-bold border-info">KYC</a>
    </li>

    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('packs.create')}}" class="nav-link text-gray-dark text-bold border-info">Buy Pack</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('kyc.contrat')}}" class="nav-link text-gray-dark text-bold border-info">Become shareholder</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a style="cursor: copy"
            onClick="navigator.clipboard.writeText(`{{ route('register', ['code' => auth()->user()->parrain_code]) }}`);;alert('copied')"
           class="nav-link text-gray-dark text-bold border-info">{{__("Get my affiliate link")}}</a>
    </li>
</ul>
