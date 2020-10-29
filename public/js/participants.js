
new Vue({
  el: '#app',
  data: {
    participants: [],
    pagination: {
      total: 0,
      per_page: 20,
      from: 1,
      to: 0,
      current_page: 1
    },
    offset: 4,
    formErrors: {},
    isNew: true,
    event_id: null,
    formData: {
      id: "",
      event_id: "",
      member_id: "",
      ticket_count: "",
    },
    
  },
  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + (this.offset * 2);
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  created() {
     this.event_id = document.getElementById("new-prize").getAttribute('data-id');
     this.getParticipants(this.event_id);
  },
  methods: {

    showPartipicantModal() {
      this.isNew = true;
      Modal.show("#event-participants-modal");
    },
    getParticipants: function(id) {
      this.$http.get('/api/administration/participants?event_id=' + id).then((response) => {
        this.participants = response.data.data
      });
    },
    
    submit(e) {
      e.preventDefault();
      this.formErrors = {}
      this.formData.event_id = this.event_id;

      if (this.isNew) {
        this.createParticipant();
      } else {
        this.updateParticipant(this.formData.id);
      }
    },
    createParticipant: function() {
      var input = this.formData;
      this.$http.post('/api/administration/participants',input).then((response) => {
        this.participants.unshift(response.data.data);
        Modal.hide('#event-participants-modal');
        toastr.success('Created Successfully.', 'Create', {timeOut: 5000});
      }).catch((response) => {
        this.formErrors = response.data.errors
      });
    },
    deleteParticipant: function(prize) {
      this.$http.delete('/api/administration/participants/'+prize.id).then((response) => {
        toastr.success('Deleted Successfully.', 'Delete', {timeOut: 5000});
      });
    },

    setSelected(data) {
      this.formData.member_id = data.id;
      this.searchText = data.full_name;
    },
    editParticipant: function(item) {
      this.isNew = false;
      this.formData.event_id = this.event_id;
      this.formData.member_id = item.member_id;
      this.formData.id = item.id;
      Modal.show('#event-participants-modal');

    },
    updateParticipant: function(id) {
      var input = this.formData;
      this.$http.put('/api/administration/participants/'+id,input).then((response) => {

        this.getParticipants(this.event_id);
        Modal.hide('#event-participants-modal');

        toastr.success('Updated Successfully.', 'Update', {timeOut: 5000});
      }).catch(({response}) => {
        this.formErrors = response.data.errors
      });

    },
    changePage: function(page) {
      this.pagination.current_page = page;
      this.getParticipants(page);
    }
  }
})