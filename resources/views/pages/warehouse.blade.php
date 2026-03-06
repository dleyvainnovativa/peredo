@extends('main')

@section('content')

<div class="tab-pane fade show active" id="main-pane-calendar" role="tabpanel" aria-labelledby="main-tab-calendar">

    @include('components.steps2')

    <!-- Step Content -->
    <div class="tab-content" id="stepperTabsContent">
        @include('sections.warehouse.info')
        @include('sections.warehouse.confirm')
    </div>
</div>
@vite(['resources/js/navigate.js', 'resources/js/manager.js', 'resources/js/file.js',])

@endsection