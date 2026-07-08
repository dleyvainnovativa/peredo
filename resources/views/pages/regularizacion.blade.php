@extends('main')

@section('content')

<div class="tab-pane fade show active" id="main-pane-calendar" role="tabpanel" aria-labelledby="main-tab-calendar">

    @include('components.steps_regularizacion')

    <!-- Step Content -->
    <div class="tab-content" id="stepperTabsContent">
        @include('sections.request.regularizacion.employee')
        @include('sections.request.regularizacion.review')
    </div>
</div>
@include("components.filters")
@include("modals.add_item")

@vite(['resources/js/navigate.js', 'resources/js/file.js', 'resources/js/employee.js', 'resources/js/review.js'])
@endsection