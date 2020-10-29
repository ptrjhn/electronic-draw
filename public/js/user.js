
new Vue({
  el: '#app',
  data: {
    users: [],
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
    formData: {
      id: "",
      username: "",
      first_name: "",
      last_name: "",
      user_type: "user",
      is_enabled: true,
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
     this.getUsers();
  },
  methods: {

    showModal() {
      this.isNew = true;
      this.formErrors = {};
      Modal.show("#user-form-modal");
    },
    getUsers: function() {
      this.$http.get(`/api/administration/user`).then((response) => {
        console.log(response);
        this.users = response.data
      });
    },
    
    submit(e) {
      e.preventDefault();
      this.formErrors = {};
      
      if (this.isNew) {
        this.createUser();
      } else {
        this.updateUser(this.formData.id);
      }
    },  
    createUser: function() {
      var input = this.formData;
      this.$http.post('/api/administration/user',input).then((response) => {
        this.users.unshift(response.data);
        Modal.hide('#event-form-modal');
        toastr.success('Created Successfully.', 'Create', {timeOut: 5000});
      }).catch((response) => {
        this.formErrors = response.data.error
      });
    },
    deleteUser: function(user) {
      this.$http.delete('/api/administration/user/'+user.id).then((response) => {
      this.getUsers();
      Modal.hide("#user-form-modal");
      toastr.success('Deleted Successfully.', 'Delete', {timeOut: 5000});
      });
    },
    editUser: function(item) {
      this.isNew = false;
      this.formData.username = this.username;
      this.formData.first_name = item.first_name;
      this.formData.last_name = item.last_name;
      this.formData.id = item.id;
      Modal.show('#user-form-modal');

    },
    updateUser: function(id) {
      var input = this.formData;
      this.$http.put('/api/administration/user/'+id,input).then((response) => {

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