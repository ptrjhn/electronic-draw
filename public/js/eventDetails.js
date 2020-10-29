
new Vue({
  el: '#app',
  data: {
    participants: [],
    prizes: [],
    members: [],

    pagination: {
      total: 0,
      per_page: 20,
      from: 1,
      to: 0,
      current_page: 1
    },
    searchText: "",
    offset: 4,
    formErrors: {},
    isNew: true,
    event_id: null,
    prizeForm: {
      particulars: "",
      branch: "",
      prize_type: "",
      event_id: "",
      quantity: "",
    },
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
     this.event_id = document.getElementById("event-button").getAttribute('data-id');
     this.getParticipants();
     this.getPrizes(this.event_id);
  },
  methods: {
    
    getParticipants: function(page = 1) {
      this.$http.get(`/api/administration/participants?page=${page}&event_id=${this.event_id}&search=${this.searchText}`).then((response) => {
        this.participants = response.data.data
        this.pagination = response.data;

      });
    },
    
    searchMembers() {
      this.$http.get('/api/administration/members-filter?search='+this.searchText).then((response) => {
         this.members = response.data.data;
  
      });

    },
    submitParticipant(e) {
      e.preventDefault();
      this.formErrors = {}
      this.formData.event_id = this.event_id;

      if (this.isNew) {
        this.createParticipant();
      } else {
        this.updateParticipant(this.formData.id);
      }
    },

    showPrizeModal() {
      this.isNew = true;
      this.formErrors = {};
      Modal.show("#event-prize-modal");
    },

    showPartipicantModal() {
      this.isNew = true;
      this.formErrors = {};
      Modal.show("#event-participants-modal");
    },

    getPrizes: function(id) {
      this.$http.get('/api/administration/prizes?event_id='+this.event_id).then((response) => {
        this.prizes = response.data
      });
    },
    
    submitPrize(e) {
      e.preventDefault();
      this.formErrors = {};
      this.formData.event_id = this.event_id;

      if (this.isNew) {
        this.createPrize();
      } else {
        this.updatePrize(this.formData.id);
      }
    },
    createPrize: function() {
      var input = this.formData;
      this.$http.post('/api/administration/prizes',input).then((response) => {
        this.prizes.unshift(response.data);
        Modal.hide('#event-prize-modal');
        toastr.success('Created Successfully.', 'Create', {timeOut: 5000});
      }).catch((response) => {
        this.formErrors = response.data.errors
      });
    },
    deletePrize: function(prize) {
      this.$http.delete('/api/administration/prizes/'+prize.id).then((response) => {
        this.getPrizes(this.event_id);
        toastr.success('Deleted Successfully.', 'Delete', {timeOut: 5000});
      });
    },
    editPrize: function(item) {
      this.formData = {
         id: "",
        event_id: "",
        particulars: "",
        quantity: "",
        prize_type: "",
        branch:  "",
      }
      this.isNew = false;
      this.formData.event_id = this.event_id;
      this.formData.particulars = item.particulars;
      this.formData.quantity = item.quantity;
      this.formData.branch = item.branch;
      this.formData.prize_type = item.prize_type;
      this.formData.id = item.id;
      Modal.show('#event-prize-modal');

    },
    updatePrize: function(id) {
      var input = this.formData;
      this.$http.put('/api/administration/prizes/'+id,input).then((response) => {

        this.getPrizes(this.event_id);
        Modal.hide('#event-prize-modal');

        toastr.success('Updated Successfully.', 'Update', {timeOut: 5000});
      }).catch(({response}) => {
        this.formErrors = response.data.errors
      });

    },

    createParticipant: function() {
      var input = this.formData;
      this.$http.post('/api/administration/participants',input).then((response) => {
        this.getParticipants(this.event_id);
        Modal.hide('#event-participants-modal');
        toastr.success('Created Successfully.', 'Create', {timeOut: 5000});
      }).catch((response) => {
        this.formErrors = response.data.errors
      });
    },
    deleteParticipant: function(ticket) {
      this.$http.delete('/api/administration/participants/'+ticket.id).then((response) => {
        this.getParticipants();
        toastr.success('Deleted Successfully.', 'Delete', {timeOut: 5000});
      });
    },

    setSelected(data) {
      this.formData.member_id = data.id;
      this.searchText = data.full_name;
      this.members = [];
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