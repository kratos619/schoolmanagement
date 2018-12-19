<template>
  <div class="container">
    <div class="row justify-content-center">
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#exampleModal"
      >add New Course</button>
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">Course Details</div>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Duration</th>
                  <th>Edite</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="course in courses" :key="course.id">
                  <th scope="row">{{course.id}}</th>
                  <td>{{course.name}}</td>
                  <td>{{course.years}}</td>
                  <td>
                    <a href="#" v-on:click="updateModalOpen(course)" class="btn btn-warning">Edite</a>
                  </td>
                  <td>
                    <a href="#" v-on:click="deleteCourse(course.id)" class="btn btn-danger">Delete</a>
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
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="isEdit? upddateCourse() : createCourse()">
            <div class="modal-body">
              <div class="form-group">
                <label for>Name</label>
                <input
                  type="text"
                  name="name"
                  v-model="form.name"
                  class="form-control"
                  placeholder="Course Name.."
                  :class="{ 'is-invalid': form.errors.has('name') }"
                >
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="form-group">
                <label for="years">Duration</label>
                <input
                  type="text"
                  name="years"
                  v-model="form.years"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('years') }"
                >
                <has-error :form="form" field="years"></has-error>
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
      courses: {},
      form: new Form({
        id: "",
        name: "",
        years: ""
      })
    };
  },
  methods: {
    upddateCourse(id) {
      this.form
        .put("api/courses/" + this.form.id)
        .then(() => {
          toast({
            type: "success",
            title: "Course Update successfully"
          });
          $("#exampleModal").modal("hide");
          this.loadUser();
        })
        .catch(e => {
          console.log(e);
        });
    },
    updateModalOpen(course) {
      this.isEdit = true;
      this.form.reset();
      $("#exampleModal").modal("show");
      this.form.fill(course);
    },
    createCourse() {
      this.form
        .post("api/courses")
        .then(({ data }) => {
          toast({
            type: "success",
            title: "Studnet Created successfully"
          });
          $("#exampleModal").modal("hide");

          this.loadUser();
        })
        .catch(e => {
          console.log(e);
        });
    },
    deleteCourse(id) {
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
            this.form.delete("api/courses/" + id).then(() => {
              swal("Deleted!", "Your file has been deleted.", "success");
              // This is relode page after event perform
              this.loadCourses();
            });
          }
        })
        .catch(e => {
          console.log(e);
        });
    },
    loadCourses() {
      axios
        .get("api/courses")
        .then(({ data }) => {
          this.courses = data;
          console.log(this.courses);
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
    this.loadCourses();
  }
};
</script>
