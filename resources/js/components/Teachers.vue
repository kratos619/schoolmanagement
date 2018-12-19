<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">Teachers Component</div>
          <button
            class="btn mb-3 btn-primary"
            data-toggle="modal"
            data-target=".bd-example-modal-lg"
          >
            <i class="fas fa-plus"></i> Add Teachers
          </button>
          <div class="card-body">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Gender</th>
                  <th>Department</th>
                  <th>Address</th>
                  <th>Edite</th>
                  <th>Delete</th>
                </tr>

                <tr v-for="teacher in teachers,data" :key="teacher.id">
                  <td>{{teacher.id}}</td>
                  <td>{{teacher.name}}</td>
                  <td>{{teacher.mobile}}</td>
                  <td>{{teacher.gender}}</td>
                  <td>{{teacher.department_id}}</td>
                  <td>{{teacher.address}}</td>
                  <td>
                    <a href="#" v-on:click="updateModalOpen(teacher)" class="btn btn-warning">Edit</a>
                  </td>
                  <td>
                    <a href="#" v-on:click="deleteTeacher(teacher.id)" class="btn btn-danger">Delete</a>
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
      class="modal fade bd-example-modal-lg"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="isUpdate ? updateTeacher() : createTeacher()">
            <div class="modal-body">
              <div class="form-group">
                <label for>Name</label>
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  placeholder="Name"
                  aria-describedby="helpId"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                >
                <has-error :form="form" field="name"></has-error>
              </div>

              <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input
                  v-model="form.mobile"
                  type="text"
                  name="mobile"
                  class="form-control"
                  placeholder="Mobile/Phone"
                  :class="{ 'is-invalid': form.errors.has('mobile') }"
                >
                <has-error :form="form" field="mobile"></has-error>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="gender">Gender</label>
                    <select
                      v-model="form.gender"
                      class="form-control"
                      name="gender"
                      :class="{ 'is-invalid': form.errors.has('gender') }"
                    >
                      <has-error :form="form" field="gender"></has-error>
                      <option></option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="course">Department</label>
                    <select
                      v-model="form.department_id"
                      class="form-control"
                      name="department_id"
                      :class="{ 'is-invalid': form.errors.has('department_id') }"
                    >
                      <has-error :form="form" field="department_id"></has-error>
                      <option></option>
                      <option
                        v-for="department in departments"
                        :key="department.id"
                        v-bind:value="department.id"
                      >{{department.name}}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <textarea
                  class="form-control"
                  name="address"
                  rows="5"
                  v-model="form.address"
                  :class="{ 'is-invalid': form.errors.has('address') }"
                ></textarea>
                <has-error :form="form" field="address"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="sumbmit" class="btn btn-primary">Save changes</button>
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
      isUpdate: false,
      teachers: {},
      departments: {},
      form: new Form({
        id: "",
        name: "",
        address: "",
        dob: "",
        gender: "",
        mobile: "",
        department_id: ""
      })
    };
  },

  methods: {
    loadUser() {
      axios.get("api/teachers").then(({ data }) => {
        this.teachers = data.data;
      });
    },
    updateModalOpen(teacher) {
      this.isUpdate = true;
      this.form.reset();
      $(".bd-example-modal-lg").modal("show");
      this.form.fill(teacher);
    },
    updateTeacher(id) {
      this.form
        .put("api/teachers/" + this.form.id)
        .then(() => {
          //success
          toast({
            type: "success",
            title: "Data Update successfully"
          });
          $(".bd-example-modal-lg").modal("hide");
          this.loadUser();
        })
        .catch(e => {
          console.log(e);
        });
    },
    createTeacher() {
      this.form
        .post("api/teachers")
        .then(({ data }) => {
          $(".bd-example-modal-lg").modal("hide");
          toast({
            type: "success",
            title: "Teachers Created successfully"
          });

          this.loadUser();
        })
        .catch(e => {
          console.log(e);
        });
    },

    deleteTeacher(id) {
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
            this.form.delete("api/teachers/" + id).then(() => {
              swal("Deleted!", "Your file has been deleted.", "success");
              // This is relode page after event perform
              this.loadUser();
            });
          }
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
    this.loadUser();
    this.loadDepartment();
  }
};
</script>
