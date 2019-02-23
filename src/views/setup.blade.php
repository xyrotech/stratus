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
            <div class="col-md-10 col-md-offset-1">
                <div class="card panel-primary rocket">
                    <div class="card-header">
                        Setup
                    </div>

                    <div class="card-body">
                        1. Check
                        2. Check
                    </div>
                    <div class="card-footer">

                        Next Button
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

