<template>
    <ul id="v_user_list" class="list-group">
        <li class="list-group-item" v-for="user in user_list" :key="user.id">{{ user.name }}</li>
    </ul>
</template>

<script>
    export default {
        data: () => {
            return {
                user_list: null
            }
        },
        mounted() {
            axios.get('/user/list')
            .then(response => {
                this.user_list = response.data;
            }).catch(error => {
                alert('通信に失敗しました');
                console.log(error);
            })
        }
    }
</script>
