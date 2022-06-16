<template>
    <div>
        <h3 class="text-center">Booking</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addBooking">
                    <div class="form-group">
                        <label for="employee">Employee</label>
                        <select class="form-select" v-model="booking.employee_id">
                            <option id="employee" v-for="employee in response.employees" v-bind:value="employee.id">
                                {{employee.name}}
                            </option>
                        </select>

                        <label for="client">Client</label>
                        <select class="form-select mt-2" v-model="booking.client_id">
                            <option id="client" v-for="client in response.clients" v-bind:value="client.id">
                                {{client.name}}
                            </option>
                        </select>

                        <label for="rent">Rent</label>
                        <select id="rent" class="form-select mt-2 mb-2" v-model="booking.rent_id">
                            <option v-for="rent in response.rents" v-bind:value="rent.id">
                                {{rent.name}}
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Booking</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "BookingComp",
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
            axios.get('http://localhost:8000/api/get-all-tables').then(
                response => (
                    (this.response.clients = response.data.clients),
                        (this.response.employees = response.data.employees),
                        this.response.rents = response.data.rents
                )
            )
        },
        methods: {
            addBooking() {
                axios.post('http://localhost:8000/api/add-booking', this.booking)
                    .then(
                        alert('Забронивано!'),
                        this.$router.go()
                        // console.log(response.data)
                    ).catch(error => console.log(error))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>

<style scoped>

</style>