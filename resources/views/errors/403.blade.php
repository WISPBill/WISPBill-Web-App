@extends('layouts.app')

@section('htmlheader_title')
    Server error
@endsection

@section('contentheader_title')
    403 Error Page
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

    <div class="error-page">
        <h2 class="headline text-red">403</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! {{ $exception->getMessage() }}</h3>
            <p>
                You are not authorized to perform this action
                you may <a href='{{ url('/home') }}'>return to dashboard</a>
            </p>
           
        </div>
    </div><!-- /.error-page -->
@endsection