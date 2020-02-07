<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New Form</div>
                    <div class="alert alert-primary" v-if="message">
                        {{ message }}
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                            <div class="col-sm-12 col-md-7">
                                <input v-bind:class="{'is-invalid': errors.name}" type="text" v-model="name" class="form-control" placeholder="Full name of the user.">
                                <div class="invalid-feedback" v-if="errors.name">
                                    <p>{{ errors.name[0] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                            <div class="col-sm-12 col-md-7">
                                <input v-bind:class="{'is-invalid': errors.email}" type="email" v-model="email" class="form-control" placeholder="Email address (should be unique).">
                                <div class="invalid-feedback" v-if="errors.email">
                                    <p>{{ errors.email[0] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>
                            <div class="col-sm-12 col-md-7">
                                <input v-bind:class="{'is-invalid': errors.phone}" type="text" v-model="phone" class="form-control" placeholder="Phone.">
                                <div class="invalid-feedback" v-if="errors.phone">
                                    <p>{{ errors.phone[0] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address</label>
                            <div class="col-sm-12 col-md-7">
                                <input v-bind:class="{'is-invalid': errors.address}" type="text" v-model="address" class="form-control" placeholder="Address.">
                                <div class="invalid-feedback" v-if="errors.address">
                                    <p>{{ errors.address[0] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Zipcode</label>
                            <div class="col-sm-12 col-md-7">
                                <input v-bind:class="{'is-invalid': errors.zipcode}" type="text" v-model="zipcode" class="form-control" placeholder="zipcode.">
                                <div class="invalid-feedback" v-if="errors.zipcode">
                                    <p>{{ errors.zipcode[0] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Images</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="file" id="img" ref="img" v-on:change="onChangeImageUpload()"/>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">License</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="file" id="file" ref="file" v-on:change="onChangeFileUpload()"/>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button v-bind:disabled="loading" @click="addUser" class="btn btn-primary"><span v-if="loading">Adding</span><span v-else>Add</span></button>
                            </div>
                        </div>
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
            name: '',
            email: '',
            phone:'',
            zipcode:'',
            address:'',
            img:'',
            file:'',
            errors: [],
            message: '',
            loading: false
        }
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        addUser() {
            let _this = this;
            _this.errors = [];
            _this.message = '';
            _this.loading = true;
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('phone', this.phone);
            formData.append('email', this.email);
            formData.append('zipcode', this.zipcode);
            formData.append('address', this.address);
            formData.append('file', this.file);
            formData.append('img', this.file);
            axios.post('http://127.0.0.1:8000/add-form', 
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                ).then((res) => {
                    _this.loading = false;
                    _this.resetForm();
                    _this.message = 'User successfully created!';
                }).catch((err) => {
                    _this.errors = err.response.data.errors;
                    _this.loading = false;
                });
            },
            resetForm() {
                this.name = '';
                this.email = '';
                this.phone = '';
                this.address = '';
                this.zipcode = '';
                this.img = '';
                this.file = '';
            },
            onChangeFileUpload(){
                this.file = this.$refs.file.files[0];
            },
            onChangeImageUpload(){
                this.img = this.$refs.img.files[0];
            }
        }
    }
    </script>
