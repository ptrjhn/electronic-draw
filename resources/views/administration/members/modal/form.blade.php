<div class="uis-modal" id="member-form-modal">
  <div class="uis-modal-dialog">
    <div class="uis-modal-body">
      <h2 class="uis-modal-title"><span id="js-type"></span> Member</h2>

      <div class="uis-margin-medium-top">

        <form class="uis-form-stacked" id="member-form" enctype="multipart/form-data" v-on:submit.prevent="submit">

          <div class="uis-margin">
            <label class="uis-form-label">
              Member Name *
            </label>
            <input type="text" class="uis-input" v-model="formData.full_name" name="name"
              placeholder="Enter Client Name">

            <small v-if="formErrors['full_name']" class="uis-text-danger form-error">
              @{{ formErrors['full_name'][0] }}
            </small>
          </div>

          <div class="uis-margin">
            <label class="uis-form-label">
              Branch *
            </label>
            <select class="uis-select" v-model="formData.branch">
              <option disabled value="">Please select branch</option>
              <option value="Naguilian">Nagulian</option>
              <option value="Roxas">Roxas</option>
              <option value="Alicia">Alicia</option>
              <option value="Solano">Solano</option>
              <option value="Cabarroguis">Cabarroguis</option>
              <option value="Tuguegarao City">Tuguegarao City</option>
            </select>

            <small v-if="formErrors['branch']" class="uis-text-danger form-error">
              @{{ formErrors['branch'][0] }}
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