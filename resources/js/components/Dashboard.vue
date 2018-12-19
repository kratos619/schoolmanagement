<template>
  <div class="container">
    <div class="row pt-3">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{totalStudents}}</h3>

            <p>Number Of Students</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="/students" class="small-box-footer">
            More info
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{totalTeachers}}</h3>

            <p>Total Teachers</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="/teachers" class="small-box-footer">
            More info
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{totalDepartment}}</h3>

            <p>Total Departments</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="/departments" class="small-box-footer">
            All Departments
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{totalCourses}}</h3>

            <p>Total Courses</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="/courses" class="small-box-footer">
            All Courses
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      totalStudents: "",
      totalTeachers: "",
      totalDepartment: "",
      totalCourses: ""
    };
  },
  methods: {
    allStudents() {
      axios
        .get("api/studentall")
        .then(({ data }) => {
          this.totalStudents = data;
          console.log(this.totalStudents);
        })
        .catch();
    },
    allTeachers() {
      axios
        .get("api/teachersall")
        .then(({ data }) => {
          this.totalTeachers = data;
        })
        .catch();
    },
    allDepartments() {
      axios
        .get("api/departmentall")
        .then(({ data }) => {
          this.totalDepartment = data;
        })
        .catch();
    },
    allCourses() {
      axios
        .get("api/coursesall")
        .then(({ data }) => {
          this.totalCourses = data;
        })
        .catch();
    }
  },
  created() {
    this.allStudents();
    this.allTeachers();
    this.allDepartments();
    this.allCourses();
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
