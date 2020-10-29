new Vue({
  el: '#member-index',
  data: {
    members: [],
    pagination: {},
    offset: 4,
    formErrors: {},
    isNew: true,
     searchText: "",
    formData: {
      id: "",
      client_code: "",
      full_name: "",
      branch: "",
      address: "",
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
  mounted() {
  },
  created() {
    this.getMembers(1);
  },
  methods: {
    getMembers: function(page) {
      this.$http.get('/api/administration/members?page='+page + '&search='+this.searchText).then((response) => {
        this.members = response.data.data;
        this.pagination = response.data;
      });
    },
    searchMembers() {
      this.$http.get('/api/administration/members?search='+this.searchText).then((response) => {
         this.members = response.data.data;
        this.pagination = response.data;

      });

    },
    showMemberModal() {
      this.isNew = true;
      this.clearForm();
      
      Modal.show("#member-form-modal");
    },
    submit(e) {
      e.preventDefault();
      if (this.isNew) {
        this.createMember();
      } else {
        this.updateMember(this.formData.id);
      }
    },
    createMember: function() {
      var input = this.formData;
      this.$http.post('/api/administration/members',input).then((response) => {
        this.changePage(this.pagination.current_page);
        Modal.hide("#member-form-modal");

        toastr.success('Created Successfully.', 'Success Alert', {timeOut: 5000});
      }).catch((response) => {
        this.formErrors = response.data.errors
        console.log(this.formErrors);
       
      });
    },
    deleteMember: function(member) {
      this.$http.delete('/api/administration/members/'+member.id).then((response) => {
        this.changePage(this.pagination.current_page);
        toastr.success('Deleted Successfully.', 'Delete', {timeOut: 5000});
      });
    },
    editMember: function(item) {
      this.clearForm();
      this.isNew = false;
      this.formData.full_name = item.full_name;
      this.formData.client_code = item.client_code;
      this.formData.branch = item.branch;
      this.formData.address = item.address;
      this.formData.id = item.id;
      Modal.show("#member-form-modal");


    },
    updateMember: function(id) {
      var input = this.formData;
      this.$http.put('/api/administration/members/'+id,input).then((response) => {
        this.getMembers(1);
        Modal.hide("#member-form-modal");


        toastr.success('Updated Successfully.', 'Update', {timeOut: 5000});
      }).catch(({response}) => {
        this.formErrors = response.data.errors
      });

    },
    changePage: function(page) {
      this.pagination.current_page = page;
      this.getMembers(page);
    },
    clearForm: function() {
      this.formErrors = {};
      this.formData = {
      id: "",
      client_code: "",
      full_name: "",
      branch: "",
      address: "",
    }}

  }
})