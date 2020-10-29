<div class="uis-modal" id="user-form-modal">
    <div class="uis-modal-dialog">
        <div class="uis-modal-body">
            <h2 class="uis-modal-title"><span id="js-type"></span> User</h2>

            <div class="uis-margin-top">
                <form class="'uis-form-stacked" id="user-form" enctype="multipart/form-data"
                    v-on:submit.prevent="submit">

                    <div class="uis-margin">
                        <label class="uis-form-label" for="firstname">
                            First name
                        </label>
                        <input id="firstname" type="text" v-model="formData.first_name" class="uis-input"
                            name="first_name" placeholder="ex: John">

                        <small class="uis-text-danger form-error"></small>
                    </div>

                    <div class="uis-margin">
                        <label class="uis-form-label" for="lastname">
                            Last name
                        </label>
                        <input id="lastname" type="text" v-model="formData.last_name" class="uis-input" name="last_name"
                            placeholder="ex: Doe">

                        <small class="uis-text-danger form-error"></small>
                    </div>

                    {{-- <div class="uis-margin">
                    <label class="uis-form-label" for="email-adderss">
                        Email addres
                    </label>
                    <input id="email-adderss" type="email" class="uis-input" name="email"
                        placeholder="ex: john.doe@example.com">

                    <small class="uis-text-danger form-error"></small>
                </div> --}}

                    <div class="uis-margin">
                        <label class="uis-form-label" for="username">
                            Username
                        </label>
                        <input id="username" v-model="formData.username" type="text" class="uis-input" name="username">

                        <small class="uis-text-danger form-error"></small>
                    </div>

                    <div id="js-message" class="uis-text-center uis-margin-top"></div>

                    <div class="uis-text-right">
                        <button type="submit" class="uis-button uis-button-primary" id="js-submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>