<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">Department Details</div>
          <button
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#exampleModal"
          >add New Department</button>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th>Edite</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="department in departments" :key="department.id">
                  <th scope="row">{{department.id}}</th>
                  <td>{{department.name}}</td>
                  <td>
                    <a
                      href="#"
                      v-on:click="updateModalOpen(department)"
                      class="btn btn-warning"
                    >Edite</a>
                  </td>
                  <td>
                    <a
                      href="#"
                      v-on:click="deleteDepartment(department.id)"
                      class="btn btn-danger"
                    >Delete</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Departments</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="isEdit? upddateDepartment() : createDepartment()">
            <div class="modal-body">
              <div class="form-group">
                <label for>Name</label>
                <input
                  type="text"
                  name="name"
                  v-model="form.name"
                  class="form-control"
                  placeholder="Department Name.."
                  :class="{ 'is-invalid': form.errors.has('name') }"
                >
                <has-error :form="form" field="name"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isEdit: false,
      departments: {},
      form: new Form({
        id: "",
        name: ""
      })
    };
  },
  methods: {
    upddateDepartment(id) {
      this.form
        .put("api/department/" + this.form.id)
        .then(() => {
          toast({
            type: "success",
            title: "Department Update successfully"
          });
          $("#exampleModal").modal("hide");
          this.loadDepartment();
        })
        .catch(e => {
          console.log(e);
        });
    },
    updateModalOpen(department) {
      this.isEdit = true;
      this.form.reset();
      $("#exampleModal").modal("show");
      this.form.fill(department);
    },
    createDepartment() {
      this.form
        .post("api/department")
        .then(({ data }) => {
          toast({
            type: "success",
            title: "Department Created successfully"
          });
          $("#exampleModal").modal("hide");

          this.loadDepartment();
        })
        .catch(e => {
          console.log(e);
        });
    },
    deleteDepartment(id) {
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
            this.form.delete("api/department/" + id).then(() => {
              swal("Deleted!", "Your file has been deleted.", "success");
              // This is relode page after event perform
              this.loadDepartment();
            });
          }
        })
        .catch(e => {
          console.log(e);
        });
    },
    loadDepartment() {
      axios
        .get("api/department")
        .then(({ data }) => {
          this.departments = data;
          console.log(this.departments);
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    console.log("Component mounted.");
  },
  created() {
    this.loadDepartment();
  }
};
</script>
