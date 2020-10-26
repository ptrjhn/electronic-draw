
new Vue({
  el: '#app',
  data: {
    prizes: [],
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
    searchText: "",
    formData: {
      id: "",
      event_id: "",
      particulars: "",
      quantity: "",
      prize_type: "",
      branch: "",
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
     this.getPrizes(this.event_id);
  },
  methods: {

    showPrizeModal() {
      this.isNew = true;
      this.formErrors = {};
      Modal.show("#event-prize-modal");
    },
    getPrizes: function(id) {
      this.$http.get('/api/administration/prizes?event_id=' + id).then((response) => {
        this.prizes = response.data
      });
    },
    
    submit(e) {
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
        slug: "",
        prize_type: "",
      }
      this.isNew = false;
      this.formData.event_id = this.event_id;
      this.formData.particulars = item.particulars;
      this.formData.quantity = item.quantity;
      this.formData.prize_type = item.prize_type;
      this.formData.branch = item.branch;
      this.formData.id = item.id;
      Modal.show('#event-prize-modal');

    },
    updatePrize: function(id) {
      var input = this.formData;
      this.$http.put('/api/administration/prizes/'+id,input).then((response) => {

        this.getPrizes(this.event_id);
        Modal.hide('#fevent-prize-modal');

        toastr.success('Updated Successfully.', 'Update', {timeOut: 5000});
      }).catch(({response}) => {
        this.formErrors = response.data.errors
      });

    },
    changePage: function(page) {
      this.pagination.current_page = page;
      this.getPrizes(page);
    }
  }
})