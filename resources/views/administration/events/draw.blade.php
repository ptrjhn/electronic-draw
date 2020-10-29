@extends('app')


@section('content')
<header class="uis-header">

  <div class="uis-container
            uis-header-container uis-text-center">
    <img src=" {{ asset('static/logo/Logo.png') }}" alt="Company Logo" class="uis-text-left" style="height: 100px">
    <h1 class="uis-header-title">
      {{ $event->name}}
    </h1>
    <h2 data-id="" style="color: #fff" class="uis-text-subheader">
      {{ $prize->particulars }} -
      {{ $prize->branch }} Branch
    </h2>
  </div>
</header>
<section class="uis-container-fluid 
          uis-margin-medium-top
            uis-margin-medium-bottom
            uis-animate
            uis-animate-fade-in" style="margin-top: 20px !important">
  <div class="uis-container">
    <div class="uis-text-center">
      <div class="winner-content">
        <input type="hidden" id="event-id" value="{{ $event->id }}">
        <input type="hidden" id="prize-id" value="{{ $prize->id }}">
        <input type="hidden" id="branch" value="{{ $prize->branch }}">
        <input type="hidden" id="prize" value="{{ $prize->particulars }}">
        <input type="hidden" id="prize-type" value="{{ $prize->prize_type}}">
      </div>
    </div>
    <div class="row mt-1">
      <div class="col">
        <div class="roulette_container uis-card uis-card-default uis-card-body">
          <div class="roulette" id="roulette1" style="display:none;">
            <img src="{{URL::asset('/img/0.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/1.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/2.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/3.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/4.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/5.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/6.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/7.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/8.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/9.jpg')}}" width="300px" height="300px" />

          </div>
        </div>
      </div>
      <div class="col">
        <div class="roulette_container uis-card uis-card-default uis-card-body">
          <div class="roulette" id="roulette2" style="display:none;">
            <img src="{{URL::asset('/img/0.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/1.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/2.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/3.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/4.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/5.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/6.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/7.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/8.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/9.jpg')}}" width="300px" height="300px" />
          </div>
        </div>


      </div>
      <div class="col">
        <div class="roulette_container uis-card uis-card-default uis-card-body">
          <div class="roulette" id="roulette3" style="display:none;">
            <img src="{{URL::asset('/img/0.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/1.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/2.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/3.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/4.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/5.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/6.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/7.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/8.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/9.jpg')}}" width="300px" height="300px" />
          </div>
        </div>

      </div>
      <div class="col">
        <div class="roulette_container uis-card uis-card-default uis-card-body">
          <div class="roulette" id="roulette4" style="display:none;">
            <img src="{{URL::asset('/img/0.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/1.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/2.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/3.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/4.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/5.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/6.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/7.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/8.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/9.jpg')}}" width="300px" height="300px" />
          </div>
        </div>
      </div>
      <div class="col">
        <div class="roulette_container uis-card uis-card-default uis-card-body">
          <div class="roulette" id="roulette5" style="display:none;">
            <img src="{{URL::asset('/img/0.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/1.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/2.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/3.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/4.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/5.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/6.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/7.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/8.jpg')}}" width="300px" height="300px" />
            <img src="{{URL::asset('/img/9.jpg')}}" width="300px" height="300px" />

          </div>
        </div>
      </div>
    </div>
    <div class="uis-text-center mt-4">
      <div class="winner-content">
        <button class="btn btn-success btn-roll btn-lg start" id="start-roll">START
          ROLL</button>

      </div>
    </div>
  </div>
  <h1 class="uis-text-center winner-name" style="font-size: 5.5em; font-weight: 700"></h1>
  <h5 style="font-size: 2.2rem; font-weight: 700" class="uis-text-center winner-address"></h5>
  @include('administration.events.modal.winner')
</section>
</div>
@endsection



@section('additional-script')
<script src="{{ asset('js/confetti.js') }}"></script>
<script src="{{ asset('js/confetti.min.js') }}"></script>
<script type="text/javascript" src="/js/util.js"></script>
<script type="text/javascript" src="/js/modal.js"></script>
<script type="text/javascript" src="/js/member.js"></script>
<script src="{{ asset('js/roulette.js') }}"></script>
<script src="{{ asset('js/rouletteApp.js') }}"></script>
@endsection