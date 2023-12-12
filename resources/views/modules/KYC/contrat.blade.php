@extends('layouts.base')

@push('styles')
    <script src="https://unpkg.com/signature_pad"></script>
@endpush
@push('css')
    <style>
        .contrat {
            height: 80vh;
            overflow: scroll;
            background-color: #fffffc !important;
            padding:8px;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <!-- Texte d'une ligne -->
                <div class="contrat">
                    @include('modules.KYC.contrat-text')
                </div>

                <!-- Zone de signature -->
                <h2 class="text-primary">Signature</h2>
                <div class="card">
                    <div class="card-body">
                        <canvas id="signatureCanvas" width="600" height="200" class="bg-white"></canvas>
                    </div>
                </div>

                <!-- Bouton de sauvegarde de la signature -->
                <button class="btn btn-primary mt-3 text-gray-dark" onclick="saveSignature()">Send</button>

                <!-- Bouton pour effacer la signature -->
                <button class="btn btn-danger mt-3 ml-2 text-gray-dark" onclick="clearSignature()">Erase SIgnature</button>
                <form action="#" method="post" id="forms">
                    @csrf
                    <input type="hidden" name="signature" id="signature">
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Récupérer le canvas
        var canvas = document.getElementById('signatureCanvas');

        // Initialiser signature_pad
        var signaturePad = new SignaturePad(canvas);

        // Fonction pour sauvegarder la signature
        function saveSignature() {
            if (signaturePad.isEmpty()) {
                alert('Veuillez signer avant de sauvegarder.');
            } else {
                // Obtenir l'image sous forme de données URL
                var signatureDataURL = signaturePad.toDataURL();

                var forms = document.getElementById('forms');
                var signature = document.getElementById('signature');

                signature.value = signatureDataURL;
                console.log(signature.value);
                forms.submit();


                // Réinitialiser la zone de signature après sauvegarde
                signaturePad.clear();
            }
        }

        // Fonction pour effacer la signature
        function clearSignature() {
            signaturePad.clear();
        }
    </script>
@endpush
