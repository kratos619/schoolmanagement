<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">Stdent Component</div>
          <button
            class="btn mb-3 btn-primary"
            data-toggle="modal"
            data-target=".bd-example-modal-lg"
          >
            <i class="fas fa-plus"></i> Add Student
          </button>
          <div class="card-body">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Roll Number</th>
                  <th>DOB</th>
                  <th>Course</th>
                  <th>Address</th>
                  <th>Edite</th>
                  <th>Delete</th>
                </tr>
                <tr v-for="student in students" :key="student.id">
                  <td>{{student.id}}</td>
                  <td>{{student.name}}</td>
                  <td>{{student.gender}}</td>
                  <td>{{student.rollnumber}}</td>
                  <td>{{student.dob}}</td>
                  <td>{{student.course}}</td>
                  <td>{{student.address}}.</td>
                  <td>
                    <a href="#" v-on:click="updateModalOpen(student)" class="btn btn-warning">Edit</a>
                  </td>
                  <td>
                    <a href class="btn btn-danger">Delete</a>
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
          <form @submit.prevent="isUpdate ? updateStudent() : createStudents()">
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
                <label for="rollnumber">Roll Number</label>
                <input
                  v-model="form.rollnumber"
                  type="text"
                  name="rollnumber"
                  class="form-control"
                  placeholder="rollnumber"
                  :class="{ 'is-invalid': form.errors.has('rollnumber') }"
                >
                <has-error :form="form" field="rollnumber"></has-error>
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
                <div class="col-md-4">
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
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="DOB">DoB</label>
                    <input
                      v-model="form.dob"
                      type="date"
                      name="dob"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('dob') }"
                    >
                    <has-error :form="form" field="dob"></has-error>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="course">Course</label>
                    <input
                      v-model="form.course"
                      class="form-control"
                      type="text"
                      name="course"
                      :class="{ 'is-invalid': form.errors.has('course') }"
                    >
                    <has-error :form="form" field="course"></has-error>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <textarea
                  class="form-control"
                  name="address"
                  rows="10"
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
      students: {},
      form: new Form({
        id: "",
        name: "",
        rollnumber: "",
        address: "",
        dob: "",
        gender: "",
        rollnumber: "",
        mobile: "",
        course: ""
      })
    };
  },

  methods: {
    loadUser() {
      axios.get("api/students").then(({ data }) => {
        this.students = data.data;
      });
    },
    updateModalOpen(student) {
      this.isUpdate = true;
      this.form.reset();
      $(".bd-example-modal-lg").modal("show");
      this.form.fill(student);
    },
    updateStudent(id) {
      this.form
        .put("api/students/" + this.form.id)
        .then(() => {
          //success
          toast({
            type: "success",
            title: "Student Update successfully"
          });
          $(".bd-example-modal-lg").modal("hide");
          this.loadUser();
        })
        .catch(e => {
          console.log(e);
        });
    },
    createStudents() {
      this.form
        .post("api/students")
        .then(({ data }) => {
          $(".bd-example-modal-lg").modal("hide");
          toast({
            type: "success",
            title: "Studnet Created successfully"
          });

          this.loadUser();
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
  }
};
</script>
