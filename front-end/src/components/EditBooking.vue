<template>
    <div>
        <h3 class="text-center">Booking</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateBooking">
                    <div class="form-group">
                        <label for="employee">Employee</label>
                        <select class="form-select" v-model="booking.employee_id">
                            <option :selected="employee.id === booking.employee_id" id="employee" v-for="employee in response.employees" v-bind:value="employee.id">
                                {{employee.name}}
                            </option>
                        </select>

                        <label for="client">Client</label>
                        <select class="form-select mt-2" v-model="booking.client_id">
                            <option :selected="client.id === this.booking.client_id" id="client" v-for="client in response.clients" v-bind:value="client.id">
                                {{client.name}}
                            </option>
                        </select>

                        <label for="rent">Rent</label>
                        <select id="rent" class="form-select mt-2 mb-2" v-model="booking.rent_id">
                            <option :selected="rent.id === booking.rent_id" v-for="rent in response.rents" v-bind:value="rent.id">
                                {{rent.name}}
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Booking</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "EditBooking",
        data() {
            return {
                response: {
                    clients: null,
                    employees: null,
                    rents: null
                },
                booking: {
                    client_id: null,
                    employee_id: null,
                    rent_id: null
                }
            }
        },
        created() {
            axios.get('http://localhost:8000/api/edit/booking/' + this.$route.params.id).then(
                response => (
                    (console.log(response)),
                    (this.response.clients = response.data.clients, this.booking.client_id = response.data.clients[0].id),
                        (this.response.employees = response.data.employees, this.booking.employee_id = response.data.employees[0].id),
                        this.response.rents = response.data.rents, this.booking.rent_id = response.data.rents[0].id
                )
            )
        },
        methods: {
            updateBooking() {
                axios.patch('http://localhost:8000/api/update/booking/' + this.$route.params.id, this.booking)
                    .then(
                        // this.$router.go()
                        console.log(response.data)
                    ).catch(error => console.log(error))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>

<style scoped>

</style>