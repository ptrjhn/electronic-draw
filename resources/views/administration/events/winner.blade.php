@extends('app')

@section('content')

@include('layouts.header', ['title' => $title])

<div id="winner-index">
  <section class="container
            uis-margin-medium-top
            uis-margin-medium-bottom
            uis-animate
            uis-animate-fade-in">

    <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
      <div class="uis-card uis-card-default uis-card-body">
        <table class="uis-table uis-table-divider uis-table-responsive uis-table-link uis-table-small">
          <h3 class="uis-card-title">
            {{ $title }} Winners
          </h3>
          <tr>
            <th>Name</th>
            <th>Ticket No</th>
            <th>Prize</th>
            <th>Prize Type</th>
            <th>Branch</th>
            <th>Date Time</th>
          </tr>
          <tbody>
            @foreach ($winners as $winner)
            <tr>
              <td>{{ $winner->participant_name}}</td>
              <td>{{ $winner->ticket_no}}</td>
              <td>{{ $winner->prize }}</td>
              <td>{{ $winner->prize_type}}</td>
              <td>{{ $winner->branch}}</td>
              <td>{{ (new \DateTime($winner->created_at))->format('F d, Y h:i a')}}</td>
            </tr>
            @endforeach
            @if (count($winners) == 0)
            <tr class="uis-text-center">
              <td colspan="6">No Winners yet</td>
            </tr>
            @endif
          </tbody>

        </table>
      </div>

    </div>


    @include('administration.members.modal.form')
  </section>
</div>
@endsection

@section('additional-script')
<script type="text/javascript" src="/js/member.js"></script>
@endsection