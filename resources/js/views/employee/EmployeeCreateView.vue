<template>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Employee</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}"><i class="bx bx-home-alt"></i></router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Employee Create</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="p-4 border rounded">
                <form @submit.prevent="employee" enctype="multipart/form-data">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0">Employee Add</h5>
                    </div>
                    <hr/>
                    <div class="row mb-3">
                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Enter Your Name</label>
                        <div class="col-sm-9">
                            <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                            <input type="text" class="form-control" id="inputEnterYourName" placeholder="Enter Your Name" v-model="form.name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Phone No</label>
                        <div class="col-sm-9">
                            <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                            <input type="text" class="form-control" id="inputPhoneNo2" placeholder="Phone No" v-model="form.phone">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Email Address</label>
                        <div class="col-sm-9">
                            <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                            <input type="email" class="form-control" id="inputEmailAddress2" placeholder="Email Address" v-model="form.email">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputChoosePassword" class="col-sm-3 col-form-label">Choose Password</label>
                        <div class="col-sm-9">
                            <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                            <input type="password" class="form-control" id="inputChoosePassword" placeholder="Choose Password" v-model="form.password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputConfirmPassword2" class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <small class="text-danger" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</small>
                            <input type="password" class="form-control" id="inputConfirmPassword2" placeholder="Confirm Password" v-model="form.password_confirmation">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputAddress4" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                            <textarea class="form-control" id="inputAddress4" rows="3" placeholder="Address" v-model="form.address"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputSalary" class="col-sm-3 col-form-label">Salary</label>
                        <div class="col-sm-9">
                            <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                            <input type="text" class="form-control" id="inputSalary" placeholder="Enter Salary" v-model="form.salary">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPosition" class="col-sm-3 col-form-label">Position</label>
                        <div class="col-sm-9">
                            <small class="text-danger" v-if="errors.position">{{ errors.position[0] }}</small>
                            <input type="text" class="form-control" id="inputPosition" placeholder="Enter Position" v-model="form.position">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputPhoto" class="col-sm-3 col-form-label">Photo</label>
                        <div class="col-sm-5">
                            <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                            <input type="file" class="form-control" id="inputPhoto" placeholder="Choose Photo" @change="onFileSelected">
                        </div>
                        <div class="col-sm-4">
                            <img :src="form.newPhoto" alt="" width="100">
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary px-5">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "EmployeeCreateView",
    data() {
        return {
            form: {
                name: '',
                phone: '',
                email: '',
                password: '',
                password_confirmation: '',
                address: '',
                salary: '',
                position: '',
                photo: '',
                newPhoto: '',
            },
            errors: {},
        }
    },
    methods: {
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048576) {
                Toast.fire({
                    icon: 'error',
                    title: 'File size should be less than 1 MB.',
                })
            }
            else{
                this.form.newPhoto = URL.createObjectURL(file);
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.form.newPhoto = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },

        employee() {
            axios.post('/api/employee', this.form)
                .then(res => {
                    this.$router.push({name: 'employee'});
                    Toast.fire({
                        icon: 'success',
                        title: 'Employee created successfully.',
                    });
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                })
        },
    },
    mounted() {
        //
    }
}
</script>

<style>

</style>
