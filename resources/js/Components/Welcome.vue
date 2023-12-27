<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        <div
            class="flex items-end justify-end flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <button data-modal-target="default-modal" data-modal-toggle="default-modal" type="button"
                class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">

                Procurar Usuários

            </button>
            <!-- Main modal -->
            <div id="default-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(50%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">

                            <div class="w-full">
                                <input type="text" id="search" placeholder="Buscar" @keyup="search()" v-model="info"
                                    class="w-full px-4 py-2 border rounded-lg text-gray-900 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">

                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Position
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            -
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="result in results" :key="result.name"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <img class="w-10 h-10 rounded-full"
                                                src="" alt="Jese image">
                                            <div class="ps-3">
                                                <div class="text-base font-semibold">{{ result.name }}</div>
                                                <div class="font-normal text-gray-500">{{ result.email }}</div>
                                            </div>
                                        </th>
                                        <td class="px-6 py-4">
                                            React Developer
                                        </td>
                                        <td class="px-6 py-4">
                                            <button type="button" @click="newChat(result.email)"
                                                class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Conversar</button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-hide="default-modal" type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                                accept</button>
                            <button data-modal-hide="default-modal" type="button" ref="closeButton"
                                class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Position
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr  v-for="contact in contacts" :key="contact.name" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" > 
                    
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-10 h-10 rounded-full" src=""
                            alt="Jese image">
                        <div class="ps-3">
                            <div class="text-base font-semibold">{{ contact.name }}</div>
                            <div class="font-normal text-gray-500">{{ contact.email }}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        React Developer
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>
import axios from 'axios';
export default {
    name: 'Welcome',
    props: {
        title: String,
    },
    data() {
        return {
          
            info: null,
            results: [],
            contacts: [],

        }
    },
    methods: {
        search() {
            axios.get('/search', {
                params: {
                    info: this.info
                }
            }).then(response => {
                this.results = response.data;
            }).catch(error => {
                console.log(error);
            });
        },
        newChat(email) {
            axios.post('/chat', {
                email: email
            }).then(response => {
                this.contacts = response.data;
                // cloase modal
                this.$refs.closeButton.click();
            }).catch(error => {
                console.log(error);
            });
        },
        getContacts() {
            axios.get('/contacts').then(response => {
                this.contacts = response.data;
            }).catch(error => {
                console.log(error);
            });
        }

    },
    created() {

        this.getContacts();

        const $targetEl = document.getElementById('modalEl');

        // options with default values
        const options = {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            backdropClasses:
                'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
            closable: true,
            onHide: () => {
                console.log('modal is hidden');
            },
            onShow: () => {
                console.log('modal is shown');
            },
            onToggle: () => {
                console.log('modal has been toggled');
            },
        };

        // instance options object
        const instanceOptions = {
            id: 'modalEl',
            override: true
        };
    },
}
</script>

<style></style>
