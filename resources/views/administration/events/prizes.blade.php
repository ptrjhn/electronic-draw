@extends('app')

@section('content')

@include('layouts.header', ['title' => $title . ' Prizes'])

<section class="container
        uis-margin-medium-top
        uis-margin-medium-bottom
        uis-animate
        uis-animate-fade-in">


    @foreach($prizes as $key => $prize)
    <ul class="uis-list uis-list-large">
        <div>
            <a class="uis-link uis-link-reset"
                href="{{ env('APP_URL') . 'events/' . $event->slug . '/draw/' . $prize->slug }}">
                <div class="uis-card
                                            uis-card-default
                                            uis-card-body
                                            uis-card-hover">
                    <h2 class="uis-card-title
                                                uis-text-primary
                                                uis-margin-small">
                        {{  $prize->quantity }} {{ $prize->particulars}} ({{ $prize->remaining }} Remaining)
                    </h2>
                    <p class="uis-text-meta uis-text-default uis-margin-remove">
                        {{$prize->prize_type}}
                    </p>
                    <p class="uis-text-meta uis-text-default uis-margin-remove">
                        {{$prize->branch}} Branch
                    </p>
                </div>
            </a>
        </div>
    </ul>
    @endforeach

    @include('administration.events.modal.form')
</section>
@endsection