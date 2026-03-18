@extends('tablar::page')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        unilantas
                    
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                  <span class="d-none d-sm-inline">
                   
                    <a href="{{ route('chats.index') }}" target="_blank" class="btn btn-primary">
                     </a>
                  </span>
                        
                            
                           
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
