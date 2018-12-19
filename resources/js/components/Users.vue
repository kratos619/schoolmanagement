<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card card-default">
          <div class="card-header">All Users</div>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Type</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for=" user in allUsers" :key="user.id">
                  <th scope="row">{{user.id}}</th>
                  <td>{{user.name}}</td>
                  <td>{{user.type}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      allUsers: {},
      form: new Form({
        id: ""
      })
    };
  },

  methods: {
    loadUsers() {
      axios
        .get("api/allUsers")
        .then(({ data }) => {
          this.allUsers = data;
        })
        .catch(e => {
          console.log(e);
        });
    },
    deleteUser(id) {
      swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      })
        .then(result => {
          if (result.value) {
            this.form.delete("api/userDelete/" + id).then(() => {
              swal("Deleted!", "Your file has been deleted.", "success");
              // This is relode page after event perform
              this.loadUsers();
            });
          }
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  created() {
    this.loadUsers();
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
