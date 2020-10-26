@extends('app')

@section('content')

@include('layouts.header', ['title' => $title])

<section class="container
        uis-margin-medium-top
        uis-margin-medium-bottom
        uis-animate
        uis-animate-fade-in">

    <form action="#" class="uis-form">
        <div class="uis-form-controls">
            <label for="search" class="uis-form-label">SEARCH BY EVENT</label>
            <input type="text" name="search" id="search" class="uis-input" placeholder="e.g October Raffle Draw 2020">
        </div>
    </form>

    <div class="uis-margin-medium">
        <button class="uis-button uis-button-primary js-open-modal" data-type="create" uis-modal="#event-form-modal">
            + New Event
        </button>
    </div>
    @foreach($events as $key => $event)
    @php
    $dates = explode('-', $key);
    $month = $dates[0];
    $year = $dates[1];
    $humanDate = \Carbon\Carbon::createFromDate($year, $month)->format('F Y');
    @endphp
    <div class="uis-margin-medium">
        <h3 class="uis-text-lead">{{$humanDate}}</h3>
        <ul class="uis-list uis-list-large">
            @foreach($event as $item)
            <li>
                <a class="uis-link
                                    uis-link-reset" href="{{ env('APP_URL') . 'events/' . $item->slug }}">
                    <div class="uis-card
                                        uis-card-default
                                        uis-card-body
                                        uis-card-hover">
                        <h3 class="uis-card-title
                                            uis-text-primary
                                            uis-margin-small">
                            {{$item->name}}
                        </h3>
                        <p class="uis-text-meta
                                            uis-text-default
                                            uis-margin-remove">
                            {{$item->location}}
                        </p>
                        <p class="uis-text-meta
                                            uis-margin-remove">
                            {{ (new \DateTime($item->event_date))->format('F d, Y') }}
                        </p>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endforeach

    @include('administration.events.modal.form')
</section>
@endsection

@section('additional-script')
<script type="text/javascript" src="/js/event.js"></script>
@endsection