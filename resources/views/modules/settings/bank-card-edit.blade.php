@extends('layouts.base')

@push('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@section('content')
    <section class="content justify-content-center row">
        <div class="card card-primary col-lg-6 col-12 offset-1">
            <div class="card-header">
                <h3 class="card-title text-gray-dark">{{__('Register Card')}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{route('bank-card.create')}}" id="card-form">
                @csrf
                <div class="card-body">
                    <div class="payment-errors"></div>

                    <div class="form-group">
                        <label for="fullname"> Name on your card</label>
                        <input value="Anouma test" type="text" name="fullname" id="fullname" class="form-control col-12">
                    </div>

                    <div class="mb-3 w-lg-50">
                        <label class="form-label" for="cc-mask">Card Number</label>
                        <input value="4242 4242 4242 4242" type="text" class="form-control" id="cc-mask"   inputmode="numeric"
                               placeholder="xxxx-xxxx-xxxx-xxxx" required>
                    </div>
                    <div class="mb-3 w-lg-50">
                        <label class="form-label" for="cvv" >CVV Code <i class="fe fe-help-circle ms-1"
                                                                         data-bs-toggle="tooltip" data-placement="top" title=""
                                                                         data-original-title="A 3 - digit number, typically printed on the back of a card."></i></label>
                        <input value="234" type="text" class="form-control" name="cvv" id="cvv"
                               placeholder="xxx" inputmode="numeric" required maxlength="3">
                    </div>

                    <div class="form-group col-6 col-lg-4">
                        <label for="expiry"> Expiry date</label>
                        <input type="month" name="expiry" id="expiry" class="form-control col-12" required>
                    </div>
                </div>
                <div>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class=>
                                @foreach($errors->all() as $error)
                                    <li class="text-white">{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary text-gray-dark">Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        Stripe.setPublishableKey('pk_test_51K6NizJLGuTPl0hAXRFWyHBXIJ1gsX1JnpgDz6nhhZy3TTOUyeFr9zL7tdcDuDN7VZnyD1unnBOMOnS5yApd8kuf00qIsGhGJC');

        var $form = $('#card-form'); // On récupère le formulaire
        $form.submit(function (e) {
            e.preventDefault();
            $form.find('button').prop('disabled', true); // On désactive le bouton submit
            Stripe.card.createToken({
                number: $('#cc-mask').val(),
                cvc: $('#cvc').val(),
                exp_month:12,// $('.card-expiry-month').val(),
                exp_year: 24//$('.card-expiry-year').val()
            }, function (status, response) {
                if (response.error) { // Ah une erreur !
                    // On affiche les erreurs
                    $form.find('.payment-errors').text(response.error.message);
                    $form.find('button').prop('disabled', false); // On réactive le bouton
                } else { // Le token a bien été créé
                    var token = response.id; // On récupère le token
                    // On crée un champs cachée qui contiendra notre token
                    $form.append($('<input type="hidden" name="stripeToken" />').val(token));

                    console.log(response);
                   $form.get(0).submit(); // On soumet le formulaire
                }
            });
        });
    </script>
@endpush
