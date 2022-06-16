<template>
    <div>
        <h3 class="text-center">All Bookings</h3><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Сотрудник</th>
                <th>Клиент</th>
                <th>Товар</th>
                <th>Статус товара</th>
                <th>Дата бронирования</th>
                <th>Дата окончания бронирования</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="booking in response" :key="booking.id">
                <td>{{ booking.employee_name }}</td>
                <td>{{ booking.client_name }}</td>
                <td>{{ booking.rend_name }}</td>
                <td>
                    <button v-if="booking.rend_status === 'Занят'" class="btn btn-outline-success" type="button"
                            @click="closed(booking.id)">Закрыть
                    </button>
                    <span v-else>Свободен</span>
                </td>
                <td>{{ booking.created_at }}</td>
                <td>{{ booking.deactivated_at }}</td>
                <td id="td-action">
                    <router-link class="btn btn-outline-secondary" :to="{name: 'edit-booking', params: {id: booking.id}}">Редактировать</router-link>
                    <button class="btn btn-outline-danger" @click="deleteBooking(booking.id)">Удалить</button>
                </td>

            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Home",
        data() {
            return {
                response: {}
            }
        },
        methods: {
            closed(id) {
                axios.get('http://localhost:8000/api/close-booking/' + id).then(
                    this.$router.go()
                )
            },
            deleteBooking(id) {
                axios.delete('http://localhost:8000/api/booking/delete/' + id).then(() => {
                        let i = this.response.map(item => item.id).indexOf(id); // find index of your object
                        this.response.splice(i, 1)
                    }
                )
            },
            editBooking(id) {
                axios.get('http://localhost:8000/api/booking/edit/' + id).then(response => {
                    console.log(response)
                })
            },
            getAllTables() {
                axios.get('http://localhost:8000/api/home').then(
                    response => {
                        console.log(response.data)
                        this.response = response.data
                    }
                )
            }
        },
        mounted() {
            this.getAllTables()
        }
    }
</script>

<style scoped>
    #td-action {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
</style>