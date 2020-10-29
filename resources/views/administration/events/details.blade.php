@extends('app')

@section('content')

@include('layouts.header', ['title' => $title])
<div id="event-details">
  <section class="container-fluid
        uis-margin-medium-top
        uis-margin-medium-bottom
        uis-animate
        uis-animate-fade-in">

    <div class="uis-container">
      <div class="row">

        <div class="col-md-7 col-xs-12 mb-3">
          <div class="uis-card uis-card-default uis-card-body">
            @if (Auth::user()->user_type == "admin")
            <a v-if="participants.length >= 0 && prizes.length >= 0"
              class="uis-link uis-link-reset uis-margin-xsmall-right"
              href="{{ env('APP_URL') . 'events/' . $event->slug . '/prizes'}}" target="_blank">
              <button class="uis-button uis-event-button event-button">
                <span class="uis-event-button-icon">🎰</span>
                <span>Draw</span>
              </button>
            </a>
            @endif
            <a class="uis-link uis-link-reset uis-margin-xsmall-right"
              href="{{ env('APP_URL') . 'events/' . $event->slug . '/winners'}}" target="_blank">
              <button class="uis-button uis-event-button">
                <span class="uis-event-button-icon">🏆</span>
                <span>Winners</span>
              </button>
            </a>

            <a class="uis-link uis-link-reset uis-margin-xsmall-right"
              href="{{ env('APP_URL') . 'events/' . $event->slug .'/ticket-inquiry' }}" target="_blank">
              <button class="uis-button uis-event-button">
                <span class="uis-event-button-icon">📰</span>
                <span>Ticket Inquiry</span>
              </button>
            </a>

            {{-- <button class="uis-button
                                    uis-event-button
                                    uis-margin-xsmall-right
                                    uis-margin-xsmall-top
                                    event-open-modal" data-type="edit" data-id="{{$event->id}}">
            <span class="uis-event-button-icon">📝</span>
            <span>Edit</span> --}}

            <button v-on:click="showPartipicantModal" class="uis-button
                                    uis-event-button
                                    event-button
                                    uis-margin-xsmall-top
                                    uis-margin-xsmall-right
                                    event-open-modal" data-type="edit" id="event-button" data-id="{{$event->id}}">
              <span class="uis-event-button-icon">📝</span>
              <span>New Participant</span>
            </button>

            @if (Auth::user()->user_type == "admin")
            <button v-on:click="showPrizeModal" class="uis-button event-button
                                                                uis-event-button
                                                                uis-margin-xsmall-top
                                                                uis-margin-xsmall-right
                                                               " data-type="edit" data-id="{{$event->id}}">
              <span class="uis-event-button-icon">📝</span>
              <span>New Prize</span>
            </button>
            @endif

            {{-- <button class="uis-button mt-2 uis-event-button event-open-status-modal" uis-modal="#close-event"
                data-id="{{$event->id}}" data-active="{{$event->is_active}}" data-name="{{$event->name}}">
            <span class="uis-event-button-icon">🚩</span>
            <span>{{$event->is_active ? 'Close' : 'Open'}}</span>
            </button> --}}


            <div class="uis-form-controls uis-margin-top">
              <label for="search" class="uis-form-label">SEARCH BY TICKET NO OR PARTICIPANT NAME</label>
              <input type="text" name="search" id="search" v-model="searchText" v-on:keyup.enter="getParticipants"
                class="uis-input" placeholder="e.g Cruz, Juan Dela">
            </div>

          </div>
        </div>
        <div class="col-lg-5 col-md-4 col-sm-12">
          <div class="uis-card uis-card-default uis-card-body" style="height: 250px;">
            <ul class="uis-list uis-list-large uis-padding-remove-left ">
              <li>
                <p class="uis-text-primary
                                        uis-margin-remove">
                  Status
                </p>
                <p class="uis-margin-remove">
                  {{ $event->is_active ? 'Open' : 'Close' }}
                </p>
              </li>

              <li>
                <p class="uis-text-primary
                                        uis-margin-remove">
                  Location
                </p>
                <p class="uis-margin-remove">
                  {{ $event->location }}
                </p>
              </li>

              <li>
                <p class="uis-text-primary uis-margin-remove">
                  Event Date
                </p>
                <p class="uis-margin-remove">
                  {{ (new \DateTime($event->event_date))->format('F d, Y') }}
                </p>
              </li>

            </ul>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-7 col-md-7 col-sm-12 mb-3">
          <div class="uis-card uis-card-default uis-card-body">
            <nav class="uis-text-center">
              <ul class="pagination mt-2 mb-4">
                <li v-if="pagination.current_page > 1">
                  <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                    <span aria-hidden="true">«</span>
                  </a>
                </li>
                <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                  <a href="#" @click.prevent="changePage(page)">
                    @{{ page }}
                  </a>
                </li>
                <li v-if="pagination.current_page < pagination.last_page">
                  <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                    <span aria-hidden="true">»</span>
                  </a>
                </li>
              </ul>
            </nav>
            <table class="uis-table uis-table-divider uis-table-responsive uis-table-link uis-table-small">
              <h3 class="uis-card-title">
                Participants/Tickets (@{{ pagination.total }})
              </h3>
              <tr>
                <th>Ticket No</th>
                <th>Partipant Name</th>
                <th>Address</th>
                <th>Branch</th>
                <th>Actions</th>
              </tr>
              <tbody>
                <tr v-for="participant in participants">
                  <td>@{{ participant.ticket_no }}</td>
                  <td>@{{ participant.full_name }}</td>
                  <td>@{{ participant.address }}</td>
                  <td>@{{ participant.branch }}</td>
                  <td>
                    <a class=" uis-button-* mr-2 js-open-modal" v-on:click="deleteParticipant(participant)">Delete</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-12" id="event-prize">
          <div class="uis-card uis-card-default uis-card-body">
            <table class="uis-table uis-table-divider uis-table-responsive uis-table-small">
              <h3 class="uis-card-title">
                Prizes
              </h3>
              <tr>
                <th>Particulars</th>
                <th>Quantity</th>
                <th>Remaining</th>
                <th>Type</th>
                <th>Branch</th>
                <th>Actions</th>
              </tr>
              <tbody>
                <tr v-for="prize in prizes">
                  <td>@{{ prize.particulars }}</td>
                  <td>@{{ prize.quantity}}</td>
                  <td>@{{ prize.quantity - prize.claimed_count }}</td>
                  <td>@{{ prize.prize_type}}</td>
                  <td>@{{ prize.branch}}</td>
                  <td>
                    <a class="uis-button-* mr-2 js-open-modal" @click.prevent="editPrize(prize)">Edit</a>
                    {{-- <a class=" uis-button-* mr-2 js-open-modal" @click.prevent="deletePrize(prize)">Delete</a> --}}
                  </td>

                </tr>

              </tbody>
            </table>
          </div>
          @include('administration.events.modal.prize')
        </div>
      </div>
    </div>


    @include('administration.events.modal.form')
    @include('administration.events.modal.close')
    @include('administration.events.modal.participant')
  </section>
</div>
@endsection

@section('additional-script')
<script type="text/javascript" src="/js/util.js"></script>
<script type="text/javascript" src="/js/modal.js"></script>
{{-- <script type="text/javascript" src="/js/prize.js"></script>
<script type="text/javascript" src="/js/member.js"></script> --}}
<script type="text/javascript" src="/js/eventDetails.js"></script>
@endsection