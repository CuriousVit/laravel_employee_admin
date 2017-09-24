<style scoped>
    .action-link {
        cursor: pointer;
    }

    .m-b-none {
        margin-bottom: 0;
    }
</style>

<template>
    <div>
        <div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h1>Employees</h1>

                        <a class="action-link" @click="showCreateEmployeeForm">
                            Create Employee
                        </a>

                    </div>
                </div>

                <div class="panel-body">
                    <!-- No Employees Notice -->
                    <p class="m-b-none" v-if="employees.length === 0">
                        You have not created any employees.
                    </p>

                    <!-- Employees -->
                    <table class="table table-inverse table-bordered table-hover" v-if="employees.length > 0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Date Of Birth</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="employee in employees">
                            <th scope="row">{{ employee.id }}</th>
                            <td>{{ employee.name }}</td>
                            <td>{{ employee.date_of_birth }}</td>
                            <td>{{ employee.address }}</td>
                            <td>
                                <a class="action-link text-danger" @click="editEmployee(employee)">
                                    Edit
                                </a>
                                <a class="action-link text-danger" @click="removeEmployee(employee)">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <!-- Create Employee Modal -->
        <div class="modal fade" id="modal-create-employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ form.id ? 'Update' : 'Create' }} Employee
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="form.errors.length > 0">
                            <p><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in form.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Create Employee Form -->
                        <form class="form-horizontal" role="form" @submit.prevent="validateAddressAndSave">
                            <input id="create-employee-id" type="hidden" class="form-control" name="id" v-model="form.id">

                            <!-- Name -->
                            <div class="form-group">
                                <label for="create-employee-name" class="form-control-label">Name:</label>
                                <input type="text" class="form-control" id="create-employee-name" name="name" v-model="form.name">
                            </div>

                            <!-- Date Of Birth -->
                            <div class="form-group">
                                <label for="create-employee-data_of_birth" class="form-control-label">Date Of Birth:</label>
                                <input type="text" class="form-control" id="create-employee-data_of_birth" name="date_of_birth" v-model="form.date_of_birth">
                            </div>

                            <!-- Address -->
                            <div class="form-group">
                                <label for="create-employee-address" class="form-control-label">Address:</label>
                                <input type="text" class="form-control" id="create-employee-address" name="address" v-model="form.address">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="validateAddressAndSave">
                            {{ form.id ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Employee Modal -->
        <div class="modal fade" id="modal-employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Success</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            New employee was created
                        </p>
                        <pre v-if="employee"><code>{{ employee.name }}</code></pre>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        /*
         * The component's data.
         */
        data() {
            return {
                employee: null,
                employees: [],

                form: {
                    id: 0,
                    name: '',
                    date_of_birth: '',
                    address: '',
                    errors: []
                }
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getEmployees();
                $('#modal-create-employee').on('shown.bs.modal', () => {
                    $('#create-employee-name').focus();
                });
            },

            /**
             * Get all of the personal access tokens for the user.
             */
            getEmployees() {
                axios.get('/api/employees')
                    .then(response => {
                        this.employees = response.data;
                    });
            },

            /**
             * Show the form for creating new tokens.
             */
            showCreateEmployeeForm() {
                this.clearFormData();
                $('#modal-create-employee').modal('show');
            },

            /**
             * Show the given access token to the user.
             */
            showEmployee(employee) {
                $('#modal-create-employee').modal('hide');
                this.employee = employee;
                $('#modal-employee').modal('show');
            },

            /**
             * Clear form data
             */
            clearFormData() {
                this.form.id = 0;
                this.form.name = '';
                this.form.date_of_birth = '';
                this.form.address = '';
            },

            /**
             * Get employee object from axios response
             */
            getEmployeeFromResponse(response) {
                return {
                    id: response.data.id,
                    name: response.data.name,
                    date_of_birth: response.data.date_of_birth,
                    address: response.data.address
                };
            },

            /**
             * Create a new employee
             */
            save() {
                console.log('Saving');
                console.log(this.form);
                if (this.form.id) {
                    axios.put('/api/employees/' + this.form.id, this.form)
                        .then(response => {
                            this.clearFormData();

                            this.form.errors = [];

                            var employee = this.getEmployeeFromResponse(response);
                            var indexToUpdate = this.employees.findIndex(function(iEmployee) { return iEmployee.id == employee.id; });
                            this.employees[indexToUpdate] = employee;

                            $('#modal-create-employee').modal('hide');
                        })
                        .catch(error => {
                            this.form.errors = ['Something went wrong. Please try again.'];
                        });

                } else {
                    axios.post('/api/employees', this.form)
                        .then(response => {
                            this.clearFormData();

                            this.form.errors = [];

                            var employee = this.getEmployeeFromResponse(response);
                            this.employees.push(employee);
                            this.showEmployee(employee);
                        })
                        .catch(error => {
                            this.form.errors = ['Something went wrong. Please try again.'];
                        });
                }
            },

            /**
             * Edit the given employee.
             */
            editEmployee(employee) {
                this.form.id = employee.id;
                this.form.name = employee.name;
                this.form.date_of_birth = employee.date_of_birth;
                this.form.address = employee.address;

                $('#modal-create-employee').modal('show');
            },

            /**
             * Delete the given employee.
             */
            removeEmployee(employee) {
                axios.delete('/api/employees/' + employee.id)
                    .then(response => {
                        this.getEmployees();
                    });
            },

            /**
             * Validate address and save
             */
            validateAddressAndSave() {
                var address = this.form.address;

                var googleMapsClient = require('@google/maps').createClient({
                    key: 'AIzaSyANdqNhQ-9vI665YcOrlEsnynyomOn7VFE'
                });

                var self = this;
                // Geocode an address.
                googleMapsClient.geocode({
                    address: address
                }, function(err, response) {
                    console.log(err);
                    console.log(response);
                    if (!err && response.json.status == 'OK' && response.json.results.length > 0) {
                        console.log(response.json.results);
                        self.save();
                    } else {
                        alert('Please check address');
                    }
                });
            }
        }
    }
</script>
