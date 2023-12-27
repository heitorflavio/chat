
<template>
    <AppLayout title="Chat">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex"
                    style="min-height: 500px; max-height: 500px;">

                    <!-- list users -->

                    <div class="w-3/12 bg-gray-200 bg-opacity-25 border-r border-gray-200 overflow-y-scroll">
                        <ul>
                            <li v-for="user in users" :key="user.uuid" @click="() => loadMessages(user.uuid)"
                                :class="(userActive.uuid == user.uuid ? 'bg-gray-200 bg-opacity-50' : '')"
                                class="p-6 text-lg text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-gray-200 hover:bg-opacity-50 hover:cursor-pointer">
                                <a href="#" class="flex items-center">
                                    {{ user.name }}
                                    <span v-if="user.notification" class="ml-2 w-2 h-2 bg-blue-400 rounded-full"></span>
                                </a>
                            </li>

                        </ul>
                    </div>

                    <!-- end  -->

                    <!-- box menssage -->

                    <div class="w-9/12 flex flex-col justify-between">
                        <!-- message -->
                        <div class="w-full p-6 flex flex-col overflow-y-scroll">
                            <div class="w-full mb-3 message" v-for="message in messages" :key="message.uuid"
                                :class="(message.from == $page.props.auth.user.uuid ? 'text-right' : '')">
                                <p class="inline-block p-2 rounded-md"
                                    :class="(message.from == $page.props.auth.user.uuid ? 'messageFromMe' : 'messageToMe')"
                                    style="max-width: 75%;">
                                    {{ message.content }}
                                </p>
                                <span class="block mt-1 text-xs text-gray-500">
                                    {{ date(message.created_at) }}
                                </span>
                            </div>
                        </div>
                        <div v-if="userActive.uuid" class="w-full bg-gray-200 bg-opacity-25 p-6 border-t border-gray-200">
                            <form @submit.prevent="sendMessage()">
                                <div class="flex roudend-md overflow-hidden border border-gray-300">
                                    <input type="text" class="flex-1 px-4 py-2 text-sm focus:outline-none"
                                        v-model="message">
                                    <button type="submit"
                                        class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 ">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end -->
                </div>

            </div>

        </div>





        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome />
                </div>
            </div>
        </div> -->
    </AppLayout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { filterDateTime } from '@/js/moment.js';

export default {
    components: {
        AppLayout,
        Welcome
    },
    data() {
        return {
            users: [],
            messages: [],
            userActive: {},
            message: ''
        }
    },
    methods: {
        getUsers() {
            axios.get('/users').then((response) => {
                this.users = response.data.users;
            }).catch((error) => {
                console.log(error);
            });
        },
        loadMessages: async function (uuid) {

            axios.get(`/users/${uuid}`).then((response) => {
                console.log(response)
                this.userActive = response.data.user;
                const user = this.users.filter((user) => {
                    if (user.uuid == uuid) {
                        return user;
                    }
                })
                if (user) {
                    user[0].notification = false;
                }
            }).catch((error) => {
                console.log(error);
            });

            await axios.get(`/messages/${uuid}`).then((response) => {
                console.log(response)
                this.messages = response.data.messages;

            }).catch((error) => {
                console.log(error);
            });

            this.scrollToBottom();
        },
        async sendMessage() {
            await axios.post(`/messages/store`, {
                message: this.message,
                to: this.userActive.uuid
            }).then((response) => {
                this.messages.push(response.data.message);
                this.message = '';
            }).catch((error) => {
                console.log(error);
            });
            this.scrollToBottom();
        },
        date(date) {
            return filterDateTime(date);
        },
        scrollToBottom() {
            if (this.messages.length > 0) {
                document.querySelector('.message:last-child').scrollIntoView();
            }
        },
        async song() {
            const audio =  new Audio('/assets/songs/song.wav');
            await audio.play();
            
     
        }

    },
    mounted() {

        this.getUsers();

        window.Echo.private(`user.${this.$page.props.auth.user.uuid}`)
            .listen('.SendMessage', async (e) => {
                this.song();
                if (this.userActive && this.userActive.uuid == e.message.from) {
                    await this.messages.push(e.message);
                    await this.scrollToBottom();
                } else {
                    const user = this.users.filter((user) => {
                        if (user.uuid == e.message.from) {
                            return user;
                        }
                    })
                    if (user) {
                        user[0].notification = true;
                    }
                }
            });

    },
}

</script>


<style scoped>
.messageFromMe {
    @apply bg-green-200 border-green-200 text-green-900;
}

.messageToMe {
    @apply bg-blue-200 border-blue-200 text-blue-900;
}
</style>