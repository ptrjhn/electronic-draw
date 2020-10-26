
new Vue({
  el: '#app',
  data: {
    events: [],
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
    searchText: "",
    formData: {
      id: "",
      name: "",
      prize: "",
      location: "",
      event_date: "",
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
     this.getEvents();
  },
  methods: {

    showEventFormModal() {
      this.isNew = true;
      this.formErrors = {};
      Modal.show("#event-form-modal");
    },
    getEvents: function() {
      this.$http.get(`/api/administration/events`).then((response) => {
        this.events = response.data
      });
    },
    
    submit(e) {
      e.preventDefault();
      this.formErrors = {};
      
      if (this.isNew) {
        this.createEvent();
      } else {
        this.updateEvent(this.formData.id);
      }
    },
    createEvent: function() {
      var input = this.formData;
      this.$http.post('/api/administration/event',input).then((response) => {
        location.href = response.data.path;
        toastr.success('Created Successfully.', 'Create', {timeOut: 5000});
      }).catch((response) => {
        this.formErrors = response.data.error
      });
    },
    deleteEvent: function(event) {
      this.$http.delete('/api/administration/events/'+event.id).then((response) => {
      this.getEvents();
      toastr.success('Deleted Successfully.', 'Delete', {timeOut: 5000});
      });
    },
    editEvent: function(item) {
      this.isNew = false;
      this.formData.event_id = this.event_id;
      this.formData.particulars = item.particulars;
      this.formData.quantity = item.quantity;
      this.formData.prize_type = item.prize_type;
      this.formData.branch = item.branch;
      this.formData.id = item.id;
      Modal.show('#event-form-modal');

    },
    updateEvent: function(id) {
      var input = this.formData;
      this.$http.put('/api/administration/events/'+id,input).then((response) => {

        this.getEvents();
        this.formErrors = {};
        Modal.hide('#event-form-modal');

        toastr.success('Updated Successfully.', 'Update', {timeOut: 5000});
      }).catch(({response}) => {
        this.formErrors = response.data.errors
      });

    },
    changePage: function(page) {
      this.pagination.current_page = page;
      this.getEvents();
    }
  }
})