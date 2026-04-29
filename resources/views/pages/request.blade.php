@extends('main')

@section('content')

<div class="tab-pane fade show active" id="main-pane-calendar" role="tabpanel" aria-labelledby="main-tab-calendar">

    @include('components.steps')

    <!-- Step Content -->
    <div class="tab-content" id="stepperTabsContent">
        @include('sections.request.employee')
        @include('sections.request.options')
        @include('sections.request.branches')
        @include('sections.request.details')
        @include('sections.request.review')
    </div>
</div>
<script>
    const missingFields = @json($missingFields);
    document.addEventListener("DOMContentLoaded", () => {

        if (missingFields.length > 0) {
            missingFields.forEach(field => {

                showAlert(
                    "Dato vacío del promotor",
                    `El campo ${field} está vacío`
                );
            });
        }
    });
</script>
@include("components.filters")
@include("modals.add_item")

@vite(['resources/js/options.js', 'resources/js/navigate.js', 'resources/js/services.js', 'resources/js/file.js', 'resources/js/employee.js', 'resources/js/promotor.js', 'resources/js/review.js'])
@endsection