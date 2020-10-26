<div class="uis-modal" id="event-form-modal">
    <div class="uis-modal-dialog">
        <div class="uis-modal-body">
            <h2 class="uis-modal-title"><span id="js-type"></span> Event</h2>

            <div class="uis-margin-medium-top">

                <form class="uis-form-stacked" id="event-form" v-on:submit.prevent="submit">

                    <div class="uis-margin">
                        <label class="uis-form-label">
                            Event Name
                        </label>
                        <input type="text" class="uis-input" v-model="formData.name" name="name">

                        <small v-if="formErrors['name']" class="uis-text-danger form-error">
                            @{{ formErrors['name'][0] }}
                        </small>
                    </div>

                    <div class="uis-margin">
                        <label class="uis-form-label">
                            Location
                        </label>
                        <input type="text" class="uis-input" v-model="formData.location" name="name">

                        <small v-if="formErrors['location']" class="uis-text-danger form-error">
                            @{{ formErrors['location'][0] }}
                        </small>
                    </div>

                    <div class="uis-margin">
                        <label class="uis-form-label">
                            Event Date
                        </label>
                        <input type="date" class="uis-input" v-model="formData.event_date" name="name">

                        <small v-if="formErrors['event_date']" class="uis-text-danger form-error">
                            @{{ formErrors['event_date'][0] }}
                        </small>
                    </div>

                    <div id="js-message" class="uis-text-center uis-margin-top"></div>

                    <div class="uis-text-right">
                        <button type="submit" id="js-submit" class="uis-button uis-button-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>