@extends('app')

@section('content')

@include('layouts.header', ['title' => $title])

<div id="member-index">
    <section class="container
            uis-margin-medium-top
            uis-margin-medium-bottom
            uis-animate
            uis-animate-fade-in">

        <div class="uis-form-controls">
            <label for="search" class="uis-form-label">SEARCH BY MEMBER NAME</label>
            <input type="text" name="search" id="search" v-model="searchText" v-on:keyup.enter="getMembers"
                class="uis-input" placeholder="e.g Cruz, Juan Dela">
        </div>

        <div class="uis-margin-medium">
            <button class="uis-button uis-button-primary js-open-modal" data-type="create" uis-modal=""
                v-on:click="showMemberModal">
                + New Member
            </button>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
            <div class="mt-3">
                <nav>
                    <ul class="pagination">
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
            </div>
            <div class="uis-card uis-card-default uis-card-body">
                <table class="uis-table uis-table-divider uis-table-responsive uis-table-link uis-table-small">
                    <h3 class="uis-card-title">
                        Members
                    </h3>
                    <tr>
                        <th>Member Name</th>
                        <th>Address</th>
                        <th>Branch</th>
                        <th>Actions</th>
                    </tr>
                    <tbody>
                        <tr v-for="member in members">
                            <td>@{{ member.full_name}}</td>
                            <td>@{{ member.address }}</td>
                            <td>@{{ member.branch }}</td>
                            <td>
                                <a class="uis-button-* mr-2 js-open-modal" @click.prevent="editMember(member)">Edit</a>
                                {{-- <a class=" uis-button-* mr-2 js-open-modal"
                                    @click.prevent="deleteMember(member)">Delete</a> --}}
                            </td>

                        </tr>

                    </tbody>
                </table>
            </div>

        </div>


        @include('administration.members.modal.form')
    </section>
</div>
@endsection

@section('additional-script')
<script type="text/javascript" src="/js/util.js"></script>
<script type="text/javascript" src="/js/modal.js"></script>
<script type="text/javascript" src="/js/member.js"></script>
@endsection