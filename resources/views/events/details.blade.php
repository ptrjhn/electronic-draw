@extends('app')

@section('content')
<header class="uis-header">
  <div class="uis-container
  uis-header-container uis-text-center">
    <img src=" {{ asset('static/logo/Logo.png') }}" alt="Company Logo" style="height: 100px">
  </div>
</header>
<div>
  <input type="hidden" id="new-prize" data-id="{{$event->id}}" />
  <section class="uis-event-container" style="margin-top: -50px;">
    <div class="uis-card
                uis-card-default
                uis-card-large
                uis-width-1-1
                uis-margin-top uis-margin-bottom">
      @if($event->is_active)
      <div class="uis-card-body">
        <h3 class="uis-card-title
                        uis-text-primary
                        uis-margin-remove">
          {{$event->name}}
        </h3>
        <p class="uis-text-meta
                            uis-text-default
                            uis-margin-xsmall">
          {{$event->location}}
        </p>
        <p class="uis-text-meta
                        uis-text-default
                        uis-margin-xsmall">
          {{(new \DateTime($event->event_date))->format('F d, Y')}}
        </p>


        <fieldset class="uis-fieldset mt-5">
          <div class="uis-margin">
            <input id="full-name" type="text" class="uis-input" v-model="searchText" v-on:keyup.enter="getParticipants"
              name="full_name" placeholder="Enter Name" required autofocus>
            <small class="uis-text-danger form-error"></small>
          </div>
        </fieldset>
        <div class="uis-text-center">
          <button class="uis-button uis-button-primary registration-button" type="submit"
            v-on:click="getParticipants">Search</button>
        </div>

        <table class="uis-table uis-table-divider uis-table-responsive uis-table-link uis-table-small">
          <h3 class="uis-card-title">
            Participants/Tickets
          </h3>
          <tr>
            <th>Ticket No</th>
            <th>Partipant Name</th>
            <th>Branch</th>
          </tr>
          <tbody>
            <tr v-for="participant in participants">
              <td>@{{ participant.ticket_no }}</td>
              <td>@{{ participant.full_name }}</td>
              <td>@{{ participant.branch }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      @else

      {{-- When event is done --}}
      <div class="uis-card-body uis-text-center">
        <img class="uis-margin-top" src="{{ asset('static/svg/registration-done.svg') }}"
          alt="Illustration raffle registration done">

        <div class="uis-margin-medium-top">
          <h3 class="uis-card-title
                            uis-text-primary
                            uis-margin-remove">
            Too late 😟
          </h3>

          <p>The <span class="uis-text-primary">{{$event->name}}</span> event raffle registration is already
            done.</p>
        </div>
      </div>
      @endif

    </div>
  </section>
</div>
@endsection

@section('additional-script')
<script type="text/javascript" src="/js/eventDetails.js"></script>
@endsection