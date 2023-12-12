@extends('layouts.base')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('kyc.form') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputFirstName">First Name</label>
                        <input name="nom" type="text" class="form-control" id="inputFirstName" placeholder="Enter your first name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputLastName">Last Name</label>
                        <input name="prenom" type="text" class="form-control" id="inputLastName" placeholder="Enter your last name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input name="adresse" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input name="ville" type="text" class="form-control" id="inputCity">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCountry">Country of Residence</label>
                        <select name="pays" id="inputCountry" class="form-control">
                            <option selected>Choose...</option>
                            <!-- Ajoutez ici une liste de pays -->
                            @foreach($pays as $pay)
                                <option value="{{$pay}}">{{$pay}}</option>
                            @endforeach()
                            <!-- ... -->
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputBirthPlace">Place of Birth</label>
                        <input name="lieu_naissance" type="text" class="form-control" id="inputBirthPlace">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputBirthDate">Date of Birth</label>
                        <input name="date_naissance" type="date" class="form-control" id="inputBirthDate">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNationality">Nationality</label>
                        <input name="nationalite" type="text" class="form-control" id="inputNationality">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputProfession">Profession</label>
                        <input name="profession" type="text" class="form-control" id="inputProfession">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputContact">Contact</label>
                        <input name="numero_telephone" type="text" class="form-control" id="inputContact">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputIDType">Type of ID</label>
                        <select name="type_piece" id="inputIDType" class="form-control">
                            <option selected>Choose...</option>
                            <option>Passport</option>
                            <option>National ID</option>
                            <option>Driver's License</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputpc">ID Serial</label>
                    <input name="numero_piece_identite" type="text" class="form-control" id="inputpc">
                </div>
                <div class="form-group">
                    <label for="inputIDFile">ID Document (Front & Back)</label>
                    <input name="piece_identite" type="file" class="form-control-file" id="inputIDFile" accept="image/*">
                    <small class="form-text text-muted">Upload a file with both front and back sides of your ID.</small>
                    <img id="idPreview" class="mt-2" style="max-width: 100%; max-height: 200px;">
                </div>

                <div class="form-group">
                    <label for="inputPhotoFile">Photo</label>
                    <input name="photo" type="file" class="form-control-file" id="inputPhotoFile" accept="image/*">
                    <small class="form-text text-muted">Upload a passport-sized photo.</small>
                    <img id="photoPreview" class="mt-2" style="max-width: 100%; max-height: 200px;">
                </div>
                <button type="submit" class="btn btn-primary text-gray-dark">Submit</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
