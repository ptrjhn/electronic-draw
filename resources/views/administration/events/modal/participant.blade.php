<div class="uis-modal" id="event-participants-modal">
  <div class="uis-modal-dialog">
    <div class="uis-modal-body">
      <h2 class="uis-modal-title"><span id="js-type"></span> Participant</h2>

      <div class="uis-margin-medium-top">

        <form class="uis-form-stacked" id="participant-form" v-on:submit.prevent="submitParticipant">

          <div class="uis-margin">
            <label class="uis-form-label">
              Member
            </label>
            <input type="text" class="uis-input" v-model="searchText" v-on:keyup="searchMembers">
            @{{ formErrors['member_id'][0] }}
            <ul class="uis-list uis-list-divider uis-link-muted" v-if="members.length" id="js-participants-container">
              <li href="#" v-for="member in members">
                <a href="#" v-on:click="setSelected(member)">@{{ member.full_name }}</a>
              </li>
            </ul>
          </div>
          <div class="uis-margin">
            <label class="uis-form-label">
              Ticket Count
            </label>
            <input type="text" class="uis-input" v-model="formData.ticket_count" placeholder="Number of Ticket"
              name="ticket_count">
            <small v-if="formErrors['ticket_count']" class="uis-text-danger form-error">
              @{{ formErrors['ticket_count'][0] }}
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