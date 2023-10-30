@extends('layouts.base')
@section('content')
    <section class="content row ">
        {{--        statut --}}
        <div class="col-12 row justify-content-center mb-3">
            <div class="col-sm-4 col-md-2">
                <div class="color-palette-set">
                    <div class="bg-primary color-palette"><h4 class="text-center text-gray-dark">Inscription</h4></div>
                    <div class="bg-success disabled color-palette"><span>Passed</span></div>
                </div>
            </div>
            <div class="col-sm-4 col-md-2">
                <div class="color-palette-set">
                    <div class="bg-primary color-palette"><h4 class="text-center text-gray-dark">Confirmation</h4></div>
                    @if($user->etape >= \App\Enums\Etapes::VERIFIE)
                        <div class="bg-success disabled color-palette"><span>Passed</span></div>
                    @else
                        <div class="bg-secondary disabled color-palette"><span>Pending</span></div>
                    @endif
                </div>
            </div>
            <div class="col-sm-4 col-md-2">
                <div class="color-palette-set">
                    <div class="bg-primary color-palette"><h4 class="text-center text-gray-dark">KYC</h4></div>
                    @if($user->etape >= \App\Enums\Etapes::KYC)
                        <div class="bg-success disabled color-palette"><span>Passed</span></div>
                    @else
                    <div class="bg-secondary disabled color-palette"><span>Pending</span></div>
                    @endif
                </div>
            </div>
            <div class="col-sm-4 col-md-2">
                <div class="color-palette-set">
                    <div class="bg-primary color-palette"><h4 class="text-center text-gray-dark">Payement</h4></div>
                    @if($user->etape >= \App\Enums\Etapes::PACK)
                        <div class="bg-success disabled color-palette"><span>Passed</span></div>
                    @else
                        <div class="bg-secondary disabled color-palette"><span>Pending</span></div>
                    @endif
                </div>
            </div>
            <div class="col-sm-4 col-md-2">
                <div class="color-palette-set">
                    <div class="bg-primary color-palette"><h4 class="text-center text-gray-dark">Signature</h4></div>
                    @if($user->etape >= \App\Enums\Etapes::SIGNED)
                        <div class="bg-success disabled color-palette"><span>Passed</span></div>
                    @else
                        <div class="bg-secondary disabled color-palette"><span>Pending</span></div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary text-gray-dark">
                <div class="inner">
                    <h3>
                        {{$user->portefeuille->solde}}
                    </h3>
                    <p>Balance</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money">USD</i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary text-gray-dark">
                <div class="inner">
                    <h3>
                        {{$user->portefeuille->titres}}
                    </h3>
                    <p>Number of pack</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100 small-box" src="https://placehold.it/900x390/3c8dbc/ffffff&amp;text=Info edenis" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 small-box" src="https://placehold.it/900x390/f39c12/ffffff&amp;text=Info edenis" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-left"></i>
                    </span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <!-- /.card -->

    </section>
@endsection
