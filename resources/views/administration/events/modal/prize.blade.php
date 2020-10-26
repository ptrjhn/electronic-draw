<div class="uis-modal" id="event-prize-modal">
  <div class="uis-modal-dialog">
    <div class="uis-modal-body">
      <h2 class="uis-modal-title"><span id="js-type"></span> Event Prize</h2>

      <div class="uis-margin-medium-top">

        <form class="uis-form-stacked" id="prize-form" enctype="multipart/form-data" v-on:submit.prevent="submitPrize">

          <div class="uis-margin">
            <label class="uis-form-label">
              Particular
            </label>
            <input type="text" class="uis-input" v-model="formData.particulars" name="particulars">

            <small v-if="formErrors['particulars']" class="uis-text-danger form-error">
              @{{ formErrors['particulars'][0] }}
            </small>
          </div>

          <div class="uis-margin">
            <label class="uis-form-label">
              Prize Type
            </label>
            <select class="uis-select" v-model="formData.prize_type" name="prize_type">
              <option disabled value="">Please select prize type</option>
              <option value="Consolation Prize">Consolation Prize</option>
              <option value="Major Prize">Major Prize</option>

            </select>

            <small v-if="formErrors['prize_type']" class="uis-text-danger form-error">
              @{{ formErrors['prize_type'][0] }}
            </small>
          </div>

          <div class="uis-margin">
            <label class="uis-form-label">
              Branch
            </label>
            <select class="uis-select" v-model="formData.branch">
              <option disabled value="">Please select branch</option>
              <option value="All">All</option>
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

          <div class="uis-margin">
            <label class="uis-form-label">
              Quantity
            </label>
            <input type="text" class="uis-input" v-model="formData.quantity" name="quantity">

            <small v-if="formErrors['quantity']" class="uis-text-danger form-error">
              @{{ formErrors['quantity'][0] }}
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