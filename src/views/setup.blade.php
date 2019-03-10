@extends('stratus::main')

@section('content')
    <style>
        .dropzone .dz-preview{
            display: block;
        }
        .dropzone .dz-preview .dz-details{
            position:relative;
            padding: 0px 0px 2em;
        }
        .dropzone .dz-preview .dz-progress{
            left:inherit;
            top:inherit;
            height:2px;
            width:100%;
            margin-left:inherit;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card bg-light text-left">

                    <div class="card-body ">
                        <h4 class="card-title">Stratus Setup</h4>
                        <hr class="bg-primary">

                        @if(isset($errors))
                            <p>
                                <h6 class="card-subtitle mb-2 text-muted">Verify the following before continuing:</h6>
                            </p>
                            @foreach($errors as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            <div class="text-right">
                                <a href="/stratus" class="btn btn-primary ">Check Again</a>
                            </div>
                        @else
                            <p>
                                <h6 class="card-subtitle mb-2 text-muted">The following will be performed:</h6>
                            </p>

                            <p style="margin-left:2em">1. Stratus' tables migrated to database.</p>
                            <p style="margin-left:2em">2. Administrator account creation.</p>

                            <div class="text-right">
                                <a href="/stratus" class="btn btn-primary ">Run Install</a>
                            </div>
                        @endif


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

