@extends('app')

@section('content')
<main class="uis-spinner-wrapper">
    <section class="uis-container
                uis-container-large">
        <div class="uis-text-center">
            <img src="{{ asset('static/logo/logo.png') }}" style="height: 100px" alt="GMI Horizontal Logo Inverse">
        </div>

        <div class="uis-container-fluid">
            <div class="row">
                <div class="span3">
                    <div class="roulette_container">
                        <div class="roulette" id="roulette1" style="display:none;">
                            <img src="{{URL::asset('/img/0.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/1.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/2.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/3.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/4.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/5.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/6.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/7.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/8.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/9.jpg')}}" width="200px" height="100px" />

                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div class="roulette_container">
                        <div class="roulette" id="roulette2" style="display:none;">
                            <img src="{{URL::asset('/img/0.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/1.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/2.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/3.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/4.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/5.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/6.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/7.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/8.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/9.jpg')}}" width="200px" height="100px" />
                        </div>
                    </div>


                </div>
                <div class="span3">
                    <div class="roulette_container">
                        <div class="roulette" id="roulette3" style="display:none;">
                            <img src="{{URL::asset('/img/0.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/1.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/2.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/3.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/4.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/5.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/6.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/7.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/8.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/9.jpg')}}" width="200px" height="100px" />
                        </div>
                    </div>

                </div>
                <div class="span3">
                    <div class="roulette_container">
                        <div class="roulette" id="roulette4" style="display:none;">
                            <img src="{{URL::asset('/img/0.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/1.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/2.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/3.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/4.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/5.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/6.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/7.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/8.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/9.jpg')}}" width="200px" height="100px" />
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div class="roulette_container">
                        <div class="roulette" id="roulette1" style="display:none;">
                            <img src="{{URL::asset('/img/0.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/1.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/2.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/3.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/4.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/5.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/6.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/7.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/8.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/9.jpg')}}" width="200px" height="100px" />

                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div class="roulette_container">
                        <div class="roulette" id="roulette2" style="display:none;">
                            <img src="{{URL::asset('/img/0.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/1.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/2.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/3.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/4.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/5.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/6.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/7.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/8.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/9.jpg')}}" width="200px" height="100px" />
                        </div>
                    </div>


                </div>
                <div class="span3">
                    <div class="roulette_container">
                        <div class="roulette" id="roulette3" style="display:none;">
                            <img src="{{URL::asset('/img/0.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/1.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/2.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/3.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/4.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/5.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/6.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/7.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/8.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/9.jpg')}}" width="200px" height="100px" />
                        </div>
                    </div>

                </div>
                <div class="span3">
                    <div class="roulette_container">
                        <div class="roulette" id="roulette4" style="display:none;">
                            <img src="{{URL::asset('/img/0.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/1.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/2.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/3.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/4.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/5.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/6.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/7.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/8.jpg')}}" width="200px" height="100px" />
                            <img src="{{URL::asset('/img/9.jpg')}}" width="200px" height="100px" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uis-text-center">
            <button id="draw" class="uis-button
                        uis-button-primary
                        uis-button-large">
                DRAW!
            </button>

        </div>
    </section>

    @include('administration.events.modal.winner')
</main>
@endsection


@section('additional-script')
<script src="{{ asset('js/confetti.js') }}"></script>
<script src="{{ asset('js/confetti.min.js') }}"></script>
<script type="text/javascript" src="/js/util.js"></script>
<script type="text/javascript" src="/js/modal.js"></script>
{{-- <script type="text/javascript" src="/js/prize.js"></script> --}}
<script type="text/javascript" src="/js/member.js"></script>

<script src="{{ asset('js/roulette.js') }}"></script>
<script src="{{ asset('js/rouletteApp.js') }}"></script>
{{-- <script type="text/javascript" src="/js/eventDetails.js"></script> --}}
@endsection