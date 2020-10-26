import axios from 'axios'
import Modal from './modal';

new Vue({
  el: '#member-index',
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
    prizeForm: {
      id: "",
      event_id: "",
      particulars: "",
      quantity: "",
      prize_type: "",
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
      Modal.show("#event-prize-modal");
    },
    getPrizes: function(id) {
      axios.get('/api/administration/prizes?event_id=' + id).then((response) => {
        this.prizes = response.data.data
      });
    },
    
    submit(e) {
      e.preventDefault();
      if (this.isNew) {
        this.createPrize();
      } else {
        this.updatePrize(this.prizeForm.id);
      }
    },
    createPrize: function() {
      this.prizeForm = this.event_id;
      var input = this.prizeForm;
      axios.post('/api/administration/prizes',input).then((response) => {
        this.prizes.unshift(response.data.data);
        Modal.hide('#fevent-prize-modal');
        toastr.success('Post Created Successfully.', 'Success Alert', {timeOut: 5000});
      }).catch(({response}) => {
        this.formErrors = response.data.errors
      });
    },
    deletePrize: function(prize) {
      axios.delete('/api/administration/prizes/'+prize.id).then((response) => {
        toastr.success('Deleted Successfully.', 'Delete', {timeOut: 5000});
      });
    },
    editPrize: function(item) {
      this.isNew = false;
      this.prizeForm.event_id = this.event_id;
      this.prizeForm.particulars = item.particulars;
      this.prizeForm.quantity = item.quantity;
      this.prizeForm.prize_type = item.prize_type;
      this.prizeForm.id = item.id;
      Modal.show('#event-prize-modal');

    },
    updatePrize: function(id) {
      var input = this.prizeForm;
      axios.put('/api/administration/prizes/'+id,input).then((response) => {

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