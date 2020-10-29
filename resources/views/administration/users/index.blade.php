@extends('app')

@section('content')

@include('layouts.header', ['title' => $title])

<section class="container
    uis-margin-medium-top
    uis-margin-medium-bottom
    uis-animate
    uis-animate-fade-in">
    <div class="uis-margin-medium">
        <button class="uis-button uis-button-primary" data-type="create" v-on:click="showModal" uis-modal="#form-modal">
            + New user
        </button>
    </div>

    <div class="uis-margin-medium">
        <ul class="uis-list uis-list-large" id="js-users-container">
            <li v-for="user in users">
                <a class="uis-link
                                            uis-link-reset" data-type="edit" data-id="user.id">
                    <div class="uis-card
                                                uis-card-default
                                                uis-card-body
                                                uis-card-hover">
                        <h3 class="uis-card-title
                                                uis-text-primary
                                                uis-margin-small">
                            @{{user.first_name }} @{{ user.last_name }}
                        </h3>
                        <p class="uis-text-meta
                                                    uis-text-default
                                                    uis-margin-remove">
                            @{{ user.username }}
                        </p>
                    </div>
                </a>
            </li>

        </ul>
    </div>

    @include('administration.users.modal.form')
</section>
@endsection

@section('additional-script')
<script type="text/javascript" src="/js/util.js"></script>
<script type="text/javascript" src="/js/modal.js"></script>
<script type="text/javascript" src="/js/user.js"></script>
@endsection