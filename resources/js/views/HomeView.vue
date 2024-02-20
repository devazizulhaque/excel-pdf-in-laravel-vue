<template>
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="p-4 border rounded">
                <form @submit.prevent="fileupload" enctype="multipart/form-data">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0">Import Excel file</h5>
                    </div>
                    <hr/>

                    <div class="row mb-3">
                        <label for="inputPhoto" class="col-sm-3 col-form-label">Excel File</label>
                        <div class="col-sm-5">
                            <small class="text-danger" v-if="errors.excelfile">{{ errors.excelfile[0] }}</small>
                            <input type="file" class="form-control" id="inputPhoto" placeholder="Choose Photo" @change="onFileSelected">
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary px-5">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive mt-3">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0">Attendance Details</h5>
                    <div class="p-3">
                        <button class="btn btn-sm btn-info" @click="getattendancepdf">pdf</button>
                    </div>
                    <form class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                        <input class="form-control ps-5" v-model="search" type="text" placeholder="search">
                    </form>
                </div>
            <table class="table align-middle">
              <thead class="table-secondary">
                <tr>
                 <th>Month</th>
                 <th>Date</th>
                 <th>Day</th>
                 <th>Id</th>
                 <th>Employee Name</th>
                 <th>Department</th>
                 <th>First In Time</th>
                 <th>First Out Time</th>
                 <th>Hours Of work</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(attendance) in filteredAttendance" :key="attendance.id" :style="getRowColor(attendance)">
                  <td>{{ attendance.month }}</td>
                  <td>{{ attendance.date }}</td>
                  <td>{{ attendance.day }}</td>
                  <td>{{ attendance.employee_id }}</td>
                  <td>{{ attendance.employee_name }}</td>
                  <td>{{ attendance.department }}</td>
                  <td>{{ attendance.first_in_time }}</td>
                  <td>{{ attendance.last_out_time }}</td>
                  <td>{{ attendance.hours_of_work }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'HomeView',
    data() {
        return {
            title: 'Your New Title',
            form: {
                excelfile: '',
            },
            errors: {},
            search: '',
            attendances: [],
            inTimeThreshold: '08:00',
            outTimeThreshold: '17:00',
        }
    },
    methods: {
        getRowColor(attendance) {
            let backgroundColor = '';
            if (attendance.first_in_time > this.inTimeThreshold) {
                backgroundColor = 'red';
            }
            if (attendance.last_out_time < this.outTimeThreshold) {
                backgroundColor = 'yellow';
            }
            return { backgroundColor };
        },
        onFileSelected(e) {
            this.form.excelfile = e.target.files[0];
            console.log(this.form.excelfile);
        },
        fileupload() {
            let formData = new FormData();
            formData.append('excelfile', this.form.excelfile);
            axios.post('/api/attendance', formData)
            .then(response => {
                this.getattendance();
                this.form.excelfile = '';
                Toast.fire({
                    icon: 'success',
                    title: 'Attendance Uploaded Successfully!!!',
                });
            }).catch(error => {
                this.errors = error;
            });
        },
        getattendance() {
            axios.get('/api/attendance/')
            .then((response) => {
                this.attendances = response.data;
            })
            .catch((error) => {
                Toast.fire({
                    icon: 'error',
                    title: 'Attendance Not Found!!!',
                });
            })
        },

        getattendancepdf() {
            let formData = new FormData();
            formData.append('attendance', JSON.stringify(this.attendances));

            axios.post('/api/attendance-pdf', formData, { responseType: 'blob' })
            .then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'attendance_report.pdf');
                document.body.appendChild(link);
                link.click();
            })
            .catch((error) => {
                Toast.fire({
                    icon: 'error',
                    title: 'Error generating PDF',
                });
            });
        }
    },
    computed: {
        filteredAttendance() {
            return this.attendances.filter((attendance) => {
                return attendance.employee_id.toLowerCase().includes(this.search.toLowerCase());
            })
        }
    },
    created() {
        this.getattendance();
    },
}
</script>

<style scoped>
.search-icon {
    left: 0;
    z-index: 1;
}
</style>
