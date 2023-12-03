@extends('layouts.base')

@section('content')
    <section>
        <div class="card mx-4">
            <div class="card-header">
                <h3 class="card-title">{{__("Network")}}</h3>

                <div class="card-tools">
                    sponsorised: {{$filleuls->count()}}
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Is Active ?</th>
                        <th>Join Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($filleuls as $filleul)
                        <tr>
                            <td>{{$filleul->name.' '.$filleul->lastname}}</td>
                            <td>{{$filleul->isActive}}</td>
                            <td>{{$filleul->created_at}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
@endsection
